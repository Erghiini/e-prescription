<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signa_m extends CI_Model{
    public function getAllData(){
        return $this->db->query("SELECT * FROM signa_m")->result_array();
    }

    public function getSigna(){
		$search = "%". trim($_GET['search']) . "%";
        $result = $this->db->query("
        	SELECT  signa_id
        		,	signa_kode
        		,	signa_nama
        	FROM signa_m 
        	WHERE 	signa_kode LIKE '%". $search ."%' 
        		OR 	signa_nama LIKE '%". $search ."%' 
        	ORDER BY signa_nama ASC
        	LIMIT 15
        ")->result_array();
		
		$value = array();
		foreach ($result as $data) {			
            $signa_id   = trim($data['signa_id']);
            $signa_kode = trim($data['signa_kode']);
            $signa_nama = trim($data['signa_nama']);

		  	array_push($value, array(
		  		'id'   => $signa_id,
		  		'text' => $signa_nama .' | '. $signa_kode
		  	));
		}
		return json_encode($value);
    }
}
?>