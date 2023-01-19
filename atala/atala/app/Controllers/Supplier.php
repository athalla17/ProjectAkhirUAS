<?php
namespace App\Controllers;
use CodeIgniter\Config\Services;
use App\Models\Databasemodel;
class Supplier extends BaseController{

	public function index(){
		if(session()->get('admin')){
			return redirect()->to(base_url('admin'));
		}else if(session()->get('supplier')){
			return view('supplier/landing');
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function simpanberkas(){
		$berkas = ['ktp','npwp1','npwp2','cv','akta','skdom','skreg','skrek','siupm','pajak','sppajak'];
		$dbm = new Databasemodel();
		$id = $this->request->getPost('id');
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
		return redirect()->to(base_url(''));
	}

	public function tampilprofil(){
		$dbm = new Databasemodel();
		$db = db_connect();
		$data['kota'] = $db->query("select kota from pengguna group by kota asc")->getResultArray();
		$data['provinsi'] = $db->query("select provinsi from pengguna group by provinsi asc")->getResultArray();
		$data['data'] = $dbm->pilih("pengguna",['kodepengguna' => session()->get('supplier')]);
		return view('supplier/profil',$data);
	}

	public function ubahprofil(){
		$dbm = new Databasemodel();
		$password = $this->request->getPost('password');
		if($password == ''){
			$data = array(
				'nama' => $this->request->getPost('nama'),
				'alamat' => $this->request->getPost('alamat'),
				'kota' => $this->request->getPost('kota'),
				'provinsi' => $this->request->getPost('provinsi'),
				'telepon' => $this->request->getPost('telepon'),
				'username' => $this->request->getPost('username')
			);
		}else{
			$data = array(
				'nama' => $this->request->getPost('nama'),
				'alamat' => $this->request->getPost('alamat'),
				'kota' => $this->request->getPost('kota'),
				'provinsi' => $this->request->getPost('provinsi'),
				'telepon' => $this->request->getPost('telepon'),
				'username' => $this->request->getPost('username'),
				'password' => md5($password)
			);
		}
		$dbm->ubah("pengguna",$data,['kodepengguna' => session()->get('supplier')]);
		return redirect()->to(base_url('supplier/profil'));
	}
}
?>