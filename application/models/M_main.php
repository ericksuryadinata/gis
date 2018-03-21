<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_main extends CI_Model {

    public function selectData($column,$tablename,$where){
        $query = 'select '.$column.' from '.$tablename.' '.$where;
        $data = $this->db->query($query);
        return $data;
    }

	public function insertData($tablename,$data){
		$res = $this->db->insert($tablename,$data);
		return $res;
	}

	public function updateData($tablename,$data,$where){
		$res = $this->db->update($tablename,$data,$where);
		return $res;
	}

	public function deleteData($tablename,$where){
		$res = $this->db->delete($tablename,$where);
		return $res;
    }

}