<?php
namespace App\Controllers;
use CodeIgniter\Config\Services;
use App\Models\Databasemodel;
class Admin extends BaseController{

	public function index(){
		if(session()->get('admin')){
			return view('admin/landing');
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function tolakakun($x){
		$db = db_connect();
		$berkas = ['ktp','npwp1','npwp2','cv','akta','skdom','skreg','skrek','siupm','pajak','sppajak'];
		for ($i=0; $i < count($berkas); $i++) {
			$f = './assets/berkas/'.$db->query("select ".$berkas[$i]." from berkas where kodepengguna = '".$x."'")->getRowArray()[$berkas[$i]];
			unlink($f);
		}
		$dbm = new Databasemodel();
		$dbm->hapus('pengguna',['kodepengguna' => $x]);
		$dbm->hapus('berkas',['kodepengguna' => $x]);
		return redirect()->to(base_url(''));
	}

	public function terimaakun($x){
		$dbm = new Databasemodel();
		$dbm->ubah('pengguna',['status' => '1'],['kodepengguna' => $x]);
		return redirect()->to(base_url(''));
	}

	public function tampilprofil(){
		$dbm = new Databasemodel();
		$data['data'] = $dbm->pilih('pengguna',['kodepengguna' => session()->get('admin')]);
		return view('admin/profil',$data);
	}

	public function ubahprofil(){
		$dbm = new Databasemodel();
		$password = $this->request->getPost('password');
		if($password == ''){
			$data = array(
				'nama' => $this->request->getPost('nama'),
				'alamat' => $this->request->getPost('alamat'),
				'telepon' => $this->request->getPost('telepon'),
				'username' => $this->request->getPost('username')
			);
		}else{
			$data = array(
				'nama' => $this->request->getPost('nama'),
				'alamat' => $this->request->getPost('alamat'),
				'telepon' => $this->request->getPost('telepon'),
				'username' => $this->request->getPost('username'),
				'password' => md5($password)
			);
		}
		$dbm->ubah("pengguna",$data,['kodepengguna' => session()->get('admin')]);
		return redirect()->to(base_url('admin/profil'));
	}
}
?>