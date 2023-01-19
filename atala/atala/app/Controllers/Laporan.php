<?php
namespace App\Controllers;
use App\Models\Databasemodel;
use App\Libraries\Fpdf\Fpdf;
class Laporan extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			$data['data'] = $dbm->ambil("proyek");
			return view('admin/laporan',$data);
		}else if(session()->get('supplier')){
			return redirect()->to(base_url('supplier'));
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function cetakdata($x){
		$dbm = new Databasemodel();
		$db = db_connect();
		$proyek = $dbm->pilih('proyek',['kodeproyek' => $x]);
		$kriteria = $db->query("select kriteria.*, skema.bobot from skema join kriteria on skema.kodekriteria = kriteria.kodekriteria where skema.kodeproyek = '".$x."' order by kriteria.kriteria asc")->getResultArray();
		$supplier = $db->query("select pengguna.* from register join pengguna on register.kodepengguna = pengguna.kodepengguna where register.kodeproyek = '".$x."' order by pengguna.nama asc")->getResultArray();
		$hasil = $db->query("select pengguna.*, hasil.na from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$x."' order by hasil.na desc")->getResultArray();
		$terpilih = $db->query("select pengguna.*, hasil.na from hasil join pengguna on hasil.kodepengguna = pengguna.kodepengguna where hasil.kodeproyek = '".$x."' order by hasil.na desc limit 1")->getRowArray();
		$this->pdf = new fpdf('P','mm','A4');

		$this->pdf->AddPage();
		$this->pdf->SetLineWidth(1);
		$this->pdf->Line(10,34,200,34);
		$this->pdf->SetLineWidth(0);
		$this->pdf->SetFont('Times','B',14);
		$this->pdf->Cell(190,6,'PEMERINTAH WILAYAH BANDAR KABUPATEN BATANG',0,1,'C');
		$this->pdf->SetFont('Times','B',16);
		$this->pdf->Cell(190,6,'UNIT PELAKSANA TEKNIS DAERAH',0,1,'C');
		$this->pdf->Cell(190,6,'PEMELIHARAAN PENGAWASAN PEKERJAAN UMUM',0,1,'C');
		$this->pdf->SetFont('Times','',11);
		$this->pdf->Cell(190,4,'Alamat : Bandar, Kec. Bandar, Kabupaten Batang, Jawa Tengah 51254, Telp. : (0285) 689001',0,1,'C');
		$this->pdf->SetFont('Times','BU',12);
		$this->pdf->Ln(9);
		$this->pdf->Cell(190,6,'LAPORAN ANALISA PENILAIAN SUPPLIER MATERIAL PROYEK',0,1,'C');
		$this->pdf->SetFont('Times','',12);
		$this->pdf->Cell(190,6,$proyek['kodeproyek']." ".$proyek['proyek'],0,1,'C');
		$this->pdf->Ln(10);

		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'1. Detail Proyek',0,1);
		$this->pdf->SetFont('Times','',12);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(40,6,'a. Kode Data',0,0);
		$this->pdf->Cell(145,6,': '.$proyek['kodeproyek'],0,1);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(40,6,'b. Proyek',0,0);
		$this->pdf->Cell(145,6,': '.$proyek['proyek'],0,1);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(40,6,'c. Budget',0,0);
		$this->pdf->Cell(145,6,': Rp'.number_format($proyek['biaya'],2),0,1);
		$this->pdf->Ln(2);

		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'2. Kriteria Penilaian',0,1);
		$this->pdf->SetFont('Times','B',11);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(20,6,'Kode',1,0,'C');
		$this->pdf->Cell(100,6,'Kriteria',1,0,'C');
		$this->pdf->Cell(20,6,'Kategori',1,0,'C');
		$this->pdf->Cell(15,6,'Bobot',1,0,'C');
		$this->pdf->Cell(30,6,'Inisial',1,1,'C');
		$this->pdf->SetFont('Times','',9);
		$n = 1;
		foreach ($kriteria as $k) {
			$this->pdf->Cell(5,6,'',0,0);
			$this->pdf->Cell(20,6,$k['kodekriteria'],1,0,'C');
			$this->pdf->Cell(100,6,$k['kriteria'],1,0);
			$this->pdf->Cell(20,6,$k['kategori'],1,0,'C');
			$this->pdf->Cell(15,6,$k['bobot']." %",1,0,'C');
			$this->pdf->Cell(30,6,"K".$n,1,1,'C');
			$n++;
		}
		$this->pdf->Ln(2);
		
		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'3. Data Supplier',0,1);
		$this->pdf->SetFont('Times','B',11);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(20,6,'Kode',1,0,'C');
		$this->pdf->Cell(135,6,'Nama',1,0,'C');
		$this->pdf->Cell(30,6,'Kota',1,1,'C');
		$this->pdf->SetFont('Times','',9);
		foreach ($supplier as $s) {
			$this->pdf->Cell(5,6,'',0,0);
			$this->pdf->Cell(20,6,$s['kodepengguna'],1,0,'C');
			$this->pdf->Cell(135,6,$s['nama'],1,0);
			$this->pdf->Cell(30,6,$s['kota'],1,1,'C');
		}
		$this->pdf->Ln(2);

		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'4. Data Penilaian',0,1);
		$a = (int)135/count($kriteria);
		$b = 185-($a*count($kriteria));
		$c = 50+$b;
		$this->pdf->SetFont('Times','B',11);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell($b,6,'Supplier',1,0,'C');
		for ($i=1; $i <= count($kriteria); $i++) {
			if($i == count($kriteria)){
				$this->pdf->Cell($a,6,'K'.$i,1,1,'C');
			}else{
				$this->pdf->Cell($a,6,'K'.$i,1,0,'C');	
			}
		}
		$this->pdf->SetFont('Times','',9);
		foreach ($supplier as $s) {
			$i = 1;
			$this->pdf->Cell(5,6,'',0,0);
			$this->pdf->Cell($b,6,$s['nama'],1,0);
			foreach ($kriteria as $k) {
				$where = array(
					'kodekriteria' => $k['kodekriteria'],
					'kodeproyek' => $x,
					'kodepengguna' => $s['kodepengguna']
				);
				$nilai = $dbm->pilih('nilai',$where)['nilai'];
				if($i == count($kriteria)){
					$this->pdf->Cell($a,6,$nilai,1,1,'C');
				}else{
					$this->pdf->Cell($a,6,$nilai,1,0,'C');	
				}
				$i++;
			}
		}
		$this->pdf->Ln(2);

		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'5. Nilai Akhir Analisa',0,1);
		$this->pdf->SetFont('Times','B',11);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->Cell(20,6,'Kode',1,0,'C');
		$this->pdf->Cell(120,6,'Nama',1,0,'C');
		$this->pdf->Cell(30,6,'Kota',1,0,'C');
		$this->pdf->Cell(15,6,'NA',1,1,'C');
		$this->pdf->SetFont('Times','',9);
		foreach ($hasil as $h) {
			$this->pdf->Cell(5,6,'',0,0);
			$this->pdf->Cell(20,6,$h['kodepengguna'],1,0,'C');
			$this->pdf->Cell(120,6,$h['nama'],1,0);
			$this->pdf->Cell(30,6,$h['kota'],1,0);
			$this->pdf->Cell(15,6,number_format($h['na']*100,2),1,1,'R');
		}
		$this->pdf->Ln(2);

		$this->pdf->SetFont('Times','B',12);
		$this->pdf->Cell(190,7,'5. Kesimpulan',0,1);
		$this->pdf->SetFont('Times','',11);
		$this->pdf->Cell(5,6,'',0,0);
		$this->pdf->MultiCell(185, 6, "Berdasarkan perhitungan yang telah dilakukan dengan menggunakan algoritma metode Simple Additive Weighting (SAW) pada penilaian Supplier material proyek ".$proyek['proyek'].". Diketahui bahwa dari ".count($supplier)." Supplier, yang direkomendasikan menjadi Supplier Material terbaik pada proyek ".$proyek['proyek']." adalah ".$terpilih['nama']." dengan nilai akhir sebesar : ".number_format($terpilih['na']*100,2),0,'J');

		$this->pdf->Ln(10);
		$this->pdf->SetFont('Times','',12);
		$this->pdf->Cell(95,7,'',0,0,'C');
		$this->pdf->Cell(95,7,'Pekalongan, '.$this->tanggal_indo(date('Y-m-d')),0,1,'C');
		$this->pdf->Ln(20);
		$this->pdf->SetFont('Times','BU',12);
		$this->pdf->Cell(95,7,'',0,0,'C');

		$this->pdf->Output("Hasil Analisa ".$proyek['proyek']." (".date('dmyHi').").pdf", 'D');
	}

	function tanggal_indo($tanggal, $cetak_hari = false){
		$bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$split    = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		return $tgl_indo;
	}
}
?>