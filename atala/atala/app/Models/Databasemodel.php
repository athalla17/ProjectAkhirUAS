<?php
namespace App\Models;
use CodeIgniter\Model;
class Databasemodel extends Model{
	public function ambil($tabel){
		return $this->db->table($tabel)->get()->getResultArray();
	}

	public function pilih($tabel, $kondisi){
		return $this->db->table($tabel)->where($kondisi)->get()->getRowArray();
	}

	public function pilihsemua($tabel, $kondisi){
		return $this->db->table($tabel)->where($kondisi)->get()->getResultArray();
	}

	public function simpan($tabel, $data){
		$this->db->table($tabel)->insert($data);
	}

	public function ubah($tabel, $data, $kondisi){
		$this->db->table($tabel)->where($kondisi)->set($data)->update();
	}

	public function hapus($tabel, $kondisi){
		$this->db->table($tabel)->where($kondisi)->delete();
	}
}
?>