<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Kriteria extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$data['data'] = $dbm->ambil("kriteria");
			return view('admin/kriteria',$data);
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
				$id = "KRPRY000".$n;
			}else if($n < 100){
				$id = "KRPRY00".$n;
			}else if($n < 1000){
				$id = "KRPRY0".$n;
			}else{
				$id = "KRPRY".$n;
			}
			$cek = $dbm->pilihsemua("kriteria",["kodekriteria" => $id]);
			if(count($cek) == 0){
				$ada = false;
			}
		}
		$data = array(
			'kodekriteria' => $id,
			'kriteria' => $this->request->getPost('kriteria'),
			'kategori' => $this->request->getPost('kategori')
		);
		$dbm->simpan("kriteria",$data);
		return redirect()->to(base_url('kriteria'));
	}

	public function detaildata($x){
		$dbm = new Databasemodel();
		$data['data'] = $dbm->pilih("kriteria",['kodekriteria' => $x]);
		return view('kriteriadetail',$data);
	}

	public function ubahdata(){
		$dbm = new Databasemodel();
		$id = $this->request->getPost('id');
		$data = array(
			'kriteria' => $this->request->getPost('kriteria'),
			'kategori' => $this->request->getPost('kategori')
		);
		$dbm->ubah("kriteria",$data,['kodekriteria' => $id]);
		return redirect()->to(base_url('kriteria'));
	}
}
?>