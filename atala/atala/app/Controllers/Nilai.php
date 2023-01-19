<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Nilai extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$dbm = new Databasemodel();
			$data['proyek'] = "";
			$data['data'] = $dbm->ambil("proyek");
			$data['kriteria'] = "";
			$data['supplier'] = "";
			return view('admin/nilai',$data);
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function tampildata(){
		$dbm = new Databasemodel();
		$db = db_connect();
		$data['proyek'] = $this->request->getPost('proyek');
		$data['data'] = $dbm->ambil("proyek");
		$data['supplier'] = $db->query("select pengguna.* from register join pengguna on register.kodepengguna = pengguna.kodepengguna where register.kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray();
		$data['kriteria'] = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray();
		return view('admin/nilai',$data);
	}


}
?>