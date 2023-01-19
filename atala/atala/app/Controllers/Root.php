<?php
namespace App\Controllers;
use CodeIgniter\Config\Services;
use App\Models\Databasemodel;
class Root extends BaseController{

	public function index(){
		session()->setFlashdata('gagal','');
		if(session()->get('admin')){
			return redirect()->to(base_url('admin'));
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return view('landing');
		}
	}

	public function tampildaftar(){
		$db = db_connect();
		session()->setFlashdata('gagal','');
		$data['kota'] = $db->query("select kota from pengguna group by kota asc")->getResultArray();
		$data['provinsi'] = $db->query("select provinsi from pengguna group by provinsi asc")->getResultArray();
		return view('daftar',$data);
	}

	public function prosesregister(){
		$berkas = ['ktp','npwp1','npwp2','cv','akta','skdom','skreg','skrek','siupm','pajak','sppajak'];
		$dbm = new Databasemodel();
		$db = db_connect();
		$ada = true;
		$n = 0;
		$id = "";
		while ($ada) {
			$n++;
			if($n < 10){
				$id = "SUP00000".$n;
			}else if($n < 100){
				$id = "SUP0000".$n;
			}else if($n < 1000){
				$id = "SUP000".$n;
			}else if($n < 10000){
				$id = "SUP00".$n;
			}else if($n < 100000){
				$id = "SUP0".$n;
			}else{
				$id = "SUP".$n;
			}
			$cek = $dbm->pilihsemua("pengguna",["kodepengguna" => $id]);
			if(count($cek) == 0){
				$ada = false;
			}
		}
		$username = explode(" ",$this->request->getPost('nama'))[0];
		$username = strtolower($username).rand(100,999);
		$data = array(
			'kodeberkas' => null,
			'npwp1' => '',
			'npwp2' => '',
			'ktp' => '',
			'cv' => '',
			'skrek' => '',
			'akta' => '',
			'siupm' => '',
			'skdom' => '',
			'skreg' => '',
			'pajak' => '',
			'sppajak' => '',
			'kodepengguna' => $id
		);
		$dbm->simpan('berkas',$data);
		for ($i=0; $i < count($berkas); $i++) {
			$file = $this->request->getFile($berkas[$i]);
			$file->move(WRITEPATH . '../public/assets/berkas/');
			$dbm->ubah('berkas',[$berkas[$i] => $file->getName()],['kodepengguna' => $id]);
		}
		$data = array(
			'kodepengguna' => $id,
			'nama' => $this->request->getPost('nama'),
			'alamat' => $this->request->getPost('alamat'),
			'kota' => $this->request->getPost('kota'),
			'provinsi' => $this->request->getPost('provinsi'),
			'telepon' => $this->request->getPost('telepon'),
			'username' => $username,
			'password' => md5(123456),
			'level' => 'supplier',
			'status' => ''
		);
		$dbm->simpan("pengguna",$data);
		session()->setFlashdata('gagal','Registrasi Berhasil, Administrator akan menghubungi anda jika sudah meverifikasi akun anda');
		$data['kota'] = $db->query("select kota from pengguna group by kota asc")->getResultArray();
		$data['provinsi'] = $db->query("select provinsi from pengguna group by provinsi asc")->getResultArray();
		return view('daftar',$data);
	}

	public function proseslogin(){
		$dbm = new Databasemodel();
		$db = db_connect();
		$username = $this->request->getPost('username');
		$password = md5($this->request->getPost('password'));
		$cek = $db->query("select * from pengguna where username = '".$username."' and password = '".$password."'")->getResultArray();
		if(count($cek) > 0){
			$cek = $db->query("select * from pengguna where username = '".$username."' and password = '".$password."'")->getRowArray();
			if($cek['status'] == '1'){
				$akses = $dbm->pilih("pengguna",['username' => $username, 'password' => $password]);
				session()->set($akses['level'],$akses['kodepengguna']);
				return redirect()->to(base_url(''));
			}else{
				session()->setFlashdata('gagal','Akses anda ditolak!');
				return view('landing');	
			}
		}else{
			session()->setFlashdata('gagal','Kombinasi log in salah!');
			return view('landing');
		}
	}

	public function proseslogout(){
		session_unset();
		if(session()->get('admin')){
			session()->remove('admin');
		}
		if(session()->get('supplier')){
			session()->remove('supplier');
		}
		return redirect()->to(base_url(''));
	}
}
?>