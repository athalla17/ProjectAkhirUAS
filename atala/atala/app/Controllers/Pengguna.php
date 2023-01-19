<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Pengguna extends BaseController{
	
	public function index(){
		$dbm = new Databasemodel();
		$db = db_connect();
		if(session()->get('admin')){
			$data['kota'] = $db->query("select kota from pengguna group by kota asc")->getResultArray();
			$data['provinsi'] = $db->query("select provinsi from pengguna group by provinsi asc")->getResultArray();
			$data['data'] = $dbm->pilihsemua("pengguna",['level' => 'supplier']);
			return view('admin/pengguna',$data);
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function simpandata(){
		$dbm = new Databasemodel();
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
			'kodepengguna' => $id,
			'nama' => $this->request->getPost('nama'),
			'alamat' => $this->request->getPost('alamat'),
			'kota' => $this->request->getPost('kota'),
			'provinsi' => $this->request->getPost('provinsi'),
			'telepon' => $this->request->getPost('telepon'),
			'username' => $username,
			'password' => md5(123456),
			'level' => 'supplier',
			'status' => '1'
		);
		$dbm->simpan("pengguna",$data);
		return redirect()->to(base_url('pengguna'));
	}

	public function ubahdata(){
		$dbm = new Databasemodel();
		$id = $this->request->getPost('id');
		$data = array(
			'nama' => $this->request->getPost('nama'),
			'alamat' => $this->request->getPost('alamat'),
			'kota' => $this->request->getPost('kota'),
			'provinsi' => $this->request->getPost('provinsi'),
			'telepon' => $this->request->getPost('telepon'),
			'status' => $this->request->getPost('status')
		);
		$dbm->ubah("pengguna",$data,['kodepengguna' => $id]);
		return redirect()->to(base_url('pengguna'));
	}

	public function detaildata($x){
		$dbm = new Databasemodel();
		$db = db_connect();
		$data['telepon'] = $db->query("select telepon from supplier group by telepon asc")->getResultArray();
		$data['data'] = $dbm->pilih("supplier",['idsupplier' => $x]);
		return view('supplierdetail',$data);
	}
}
?>