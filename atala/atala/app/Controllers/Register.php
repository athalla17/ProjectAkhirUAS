<?php
namespace App\Controllers;
use App\Models\Databasemodel;
class Register extends BaseController{

	public function index(){
		$dbm = new Databasemodel();
		if(session()->get('admin')){
			return redirect()->to(base_url('admin'));
		}else if(session()->get('supplier')){
			$data['data'] = $dbm->pilihsemua("proyek",['status' => '1']);
			return view('supplier/register',$data);
		}else{
			return redirect()->to(base_url(''));
		}
	}

	public function simpandata($x){
		$dbm = new Databasemodel();
		$data = array(
			'koderegister' => null,
			'waktu' => date('Y-m-d H:i:s'),
			'status' => '1',
			'kodepengguna' => session()->get('supplier'),
			'kodeproyek' => $x
		);
		$dbm->simpan("register",$data);
		return redirect()->to(base_url('register'));
	}

	public function hapusdata($x){
		$dbm = new Databasemodel();
		$dbm->ubah("register",['status' => '0'],['koderegister' => $x]);
		return redirect()->to(base_url('register'));
	}
}
?>