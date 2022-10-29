<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restore_model extends CI_Model {

	public function dropTable()
	{
		
		$checkingTable = $this->db->query("SHOW TABLES");

		if ($checkingTable->num_rows()>0) {
			$query = $this->db->query('DROP TABLE barang, barang_masuk, barang_keluar, jenis, kcb, satuan, supplier, user');

			return $query;
		}else{
			return true;
		}
	}

}

/* End of file Restore_model.php */
/* Location: ./application/models/Restore_model.php */