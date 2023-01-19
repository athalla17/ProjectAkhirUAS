<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Proses extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$dbm = new Databasemodel();
			$data['proyek'] = "";
			$data['data'] = $dbm->ambil("proyek");
			$data['kriteria'] = "";
			$data['supplier'] = "";
			return view('admin/analisa',$data);
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function tampildata(){
		$dbm = new Databasemodel();
		$db = db_connect();
		$a = count($db->query("select * from register where kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray());
		$b = count($db->query("select * from hasil where kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray());
		if($a == $b){
			$data['supplier'] = $db->query("select pengguna.* from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$this->request->getPost('proyek')."' order by hasil.na desc, pengguna.nama asc")->getResultArray();
		}else{
			$data['supplier'] = $db->query("select pengguna.* from register join pengguna on register.kodepengguna = pengguna.kodepengguna where register.kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray();	
		}
		$data['proyek'] = $this->request->getPost('proyek');
		$data['data'] = $dbm->ambil("proyek");
		$data['kriteria'] = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$this->request->getPost('proyek')."'")->getResultArray();
		return view('admin/analisa',$data);
	}

	public function analisadata($x){
		$dbm = new Databasemodel();
		$db = db_connect();
		$supplier = $db->query("select kodepengguna from register where kodeproyek = '".$x."'")->getResultArray();
		$kriteria = $db->query("select skema.*, kriteria.kategori from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$x."'")->getResultArray();
		foreach ($supplier as $s) {
			$na = 0;
			foreach ($kriteria as $k) {
				$nn = 0;
				$ns = 0;
				$nmax = 0;
				$nmin = 0;
				$cek = $dbm->pilihsemua('nilai',['kodeproyek' => $x,'kodepengguna' => $s['kodepengguna'],'kodekriteria' => $k['kodekriteria']]);
				if(count($cek) > 0){
					$ns = $dbm->pilihsemua('nilai',['kodeproyek' => $x,'kodepengguna' => $s['kodepengguna'],'kodekriteria' => $k['kodekriteria']])[0]['nilai'];
				}
				$cek = $dbm->pilihsemua('nilai',['kodeproyek' => $x]);
				if(count($cek) > 0){
					$n = $db->query("select max(nilai) as max, min(nilai) as min from nilai where kodeproyek = '".$x."' and kodekriteria = '".$k['kodekriteria']."'")->getRowArray();
					$nmax = $n['max'];
					$nmin = $n['min'];
				}
				if($k['kategori'] == 'Cost'){
					$nn = ($nmin/$ns) * $k['bobot']/100;
				}else{
					$nn = ($ns/$nmax) * $k['bobot']/100;
				}
				$na += $nn;
			}
			$where = array(
				'kodeproyek' => $x,
				'kodepengguna' => $s['kodepengguna']
			);
			$cek = $dbm->pilihsemua('hasil',$where);
			if(count($cek) > 0){
				$kode = $dbm->pilihsemua('hasil',$where)[0]['kodehasil'];
				$dbm->ubah('hasil',['na' => $na],['kodehasil' => $kode]);
			}else{
				$data = array(
					'kodehasil' => null,
					'na' => $na,
					'kodeproyek' => $x,
					'kodepengguna' => $s['kodepengguna']
				);
				$dbm->simpan('hasil',$data);
			}
		}
		$data['proyek'] = $x;
		$data['data'] = $dbm->ambil("proyek");
		$data['supplier'] = $db->query("select pengguna.* from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$x."' order by hasil.na desc, pengguna.nama asc")->getResultArray();
		$data['kriteria'] = $db->query("select kriteria.* from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$x."'")->getResultArray();
		return view('admin/analisa',$data);
	}
}
?>