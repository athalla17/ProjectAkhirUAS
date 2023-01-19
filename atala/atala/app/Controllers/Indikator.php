<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Indikator extends BaseController{

	public function index(){
		$db = db_connect();
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$data['data'] = $db->query("select indikator.*, kriteria.kriteria, kriteria.kategori from indikator join kriteria on indikator.kodekriteria = kriteria.kodekriteria order by kriteria.kriteria asc, indikator.nilai asc")->getResultArray();
			$data['kriteria'] = $dbm->ambil("kriteria");
			return view('admin/indikator',$data);
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
				$id = "IDK00000".$n;
			}else if($n < 100){
				$id = "IDK0000".$n;
			}else if($n < 1000){
				$id = "IDK000".$n;
			}else if($n < 10000){
				$id = "IDK00".$n;
			}else if($n < 100000){
				$id = "IDK0".$n;
			}else{
				$id = "IDK".$n;
			}
			$cek = $dbm->pilihsemua("indikator",["kodeindikator" => $id]);
			if(count($cek) == 0){
				$ada = false;
			}
		}
		$data = array(
			'kodeindikator' => $id,
			'indikator' => $this->request->getPost('indikator'),
			'nilai' => $this->request->getPost('nilai'),
			'kodekriteria' => $this->request->getPost('kriteria')
		);
		$dbm->simpan("indikator",$data);
		return redirect()->to(base_url('indikator'));
	}

	public function detaildata($x){
		$dbm = new Databasemodel();
		$data['data'] = $dbm->pilih("indikator",['kodeindikator' => $x]);
		return view('indikatordetail',$data);
	}

	public function ubahdata(){
		$dbm = new Databasemodel();
		$id = $this->request->getPost('id');
		$data = array(
			'indikator' => $this->request->getPost('indikator'),
			'nilai' => $this->request->getPost('nilai'),
			'kodekriteria' => $this->request->getPost('kriteria')
		);
		$dbm->ubah("indikator",$data,['kodeindikator' => $id]);
		return redirect()->to(base_url('indikator'));
	}
}
?>