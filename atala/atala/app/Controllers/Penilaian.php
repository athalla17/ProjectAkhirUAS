<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Penilaian extends BaseController{

	public function index(){
		$db = db_connect();
		if(session()->get('admin')){
			return redirect()->to(base_url('admin'));
		}else if(session()->get('supplier')){
			$data['data'] = $db->query("select register.*, proyek.* from register join proyek on register.kodeproyek = proyek.kodeproyek where register.kodepengguna = '".session()->get('supplier')."' order by register.waktu desc")->getResultArray();
			return view('supplier/penilaian',$data);
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function simpandata(){
		$dbm = new Databasemodel();
		$db = db_connect();
		$id = $this->request->getPost('id');
		$kriteria = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$id."'")->getResultArray();
		foreach ($kriteria as $k) {
			$x = "k".$k['kodekriteria'];
			$x = $this->request->getPost($x);
			$kodeindikator = $dbm->pilih("indikator",['nilai' => $x,'kodekriteria' => $k['kodekriteria']])['kodeindikator'];
			$data = array(
				'kodenilai' => null,
				'nilai' => $x,
				'kodeindikator' => $kodeindikator,
				'kodekriteria' => $k['kodekriteria'],
				'kodeproyek' => $id,
				'kodepengguna' => session()->get('supplier')
			);
			$dbm->simpan('nilai',$data);
		}
		return redirect()->to(base_url('penilaian'));
	}

	public function tampilhasil(){
		$db = db_connect();
		$data['data'] = $db->query("select register.*, proyek.* from register join proyek on register.kodeproyek = proyek.kodeproyek where register.kodepengguna = '".session()->get('supplier')."' order by register.waktu desc")->getResultArray();
		return view('supplier/hasil',$data);
	}

	public function detailhasil($x){
		$dbm = new Databasemodel();
		$db = db_connect();
		$data['proyek'] = $x;
		$data['data'] = $dbm->pilih('proyek',['kodeproyek' => $x]);
		$data['supplier'] = $db->query("select pengguna.* from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$x."' order by hasil.na desc, pengguna.nama asc")->getResultArray();
		$data['kriteria'] = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$x."'")->getResultArray();
		return view('supplier/detailhasil',$data);
	}
}
?>