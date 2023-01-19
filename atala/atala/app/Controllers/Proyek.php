<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Proyek extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$data['data'] = $dbm->ambil("proyek");
			return view('admin/proyek',$data);
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function simpandata(){
		$dbm = new Databasemodel();
		$ada = true;
		$id = "";
		while ($ada) {
			$id = "P".date('dm').rand(10,99).date('y');
			$cek = $dbm->pilihsemua("proyek",["kodeproyek" => $id]);
			if(count($cek) == 0){
				$ada = false;
			}
		}
		$data = array(
			'kodeproyek' => $id,
			'proyek' => $this->request->getPost('proyek'),
			'deskripsi' => $this->request->getPost('deskripsi'),
			'biaya' => $this->request->getPost('biaya'),
			'status' => "1"
		);
		$dbm->simpan("proyek",$data);
		return redirect()->to(base_url('proyek'));
	}

	public function ubahdata(){
		$dbm = new Databasemodel();
		$id = $this->request->getPost('id');
		$data = array(
			'proyek' => $this->request->getPost('proyek'),
			'deskripsi' => $this->request->getPost('deskripsi'),
			'biaya' => $this->request->getPost('biaya'),
			'status' => $this->request->getPost('status')
		);
		$dbm->ubah("proyek",$data,['kodeproyek' => $id]);
		return redirect()->to(base_url('proyek'));
	}

	public function tampilskema(){
		$dbm = new Databasemodel();
		$data['proyek'] = "";
		$data['data'] = $dbm->ambil("proyek");
		$data['kriteria'] = $dbm->ambil("kriteria");
		return view('admin/skema',$data);
	}

	public function tampilskemaproyek(){
		$dbm = new Databasemodel();
		$data['proyek'] = $this->request->getPost('proyek');
		$data['data'] = $dbm->ambil("proyek");
		$data['kriteria'] = $dbm->ambil("kriteria");
		return view('admin/skema',$data);
	}

	public function simpanskema(){
		$dbm = new Databasemodel();
		$proyek = $this->request->getPost('proyek');
		$data = $dbm->ambil("kriteria");
		foreach ($data as $d) {
			$x = "bobot".$d['kodekriteria'];
			$x = $this->request->getPost($x);
			if($x == 0){
				$dbm->hapus("skema",['kodekriteria' => $d['kodekriteria'],'kodeproyek' => $proyek]);
			}else{
				$cek = $dbm->pilihsemua("skema",['kodekriteria' => $d['kodekriteria'],'kodeproyek' => $proyek]);
				if(count($cek) > 0){
					$id = $cek[0]['kodeskema'];
					$dbm->ubah("skema",['bobot' => $x],['kodeskema' => $id]);
				}else{
					$data = array(
						'kodeskema' => null,
						'bobot' => $x,
						'kodekriteria' => $d['kodekriteria'],
						'kodeproyek' => $proyek
					);
					$dbm->simpan("skema",$data);
				}
			}
		}
		$data['proyek'] = $this->request->getPost('proyek');
		$data['data'] = $dbm->ambil("proyek");
		$data['kriteria'] = $dbm->ambil("kriteria");
		return view('admin/skema',$data);
	}
}
?>