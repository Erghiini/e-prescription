<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obatalkes_m extends CI_Model{
    public function getAllData(){
        return $this->db->query("SELECT * FROM obatalkes_m")->result_array();
    }

    public function getObat(){
		$search = "%". trim($_GET['search']) . "%";
        $result = $this->db->query("
        	SELECT  obatalkes_id
        		,	obatalkes_kode
        		,	obatalkes_nama
        		,	stok
        	FROM obatalkes_m 
        	WHERE 	obatalkes_kode LIKE '%". $search ."%' 
        		OR 	obatalkes_nama LIKE '%". $search ."%' 
        	ORDER BY obatalkes_nama ASC
        	LIMIT 15
        ")->result_array();
		
		$value = array();
		foreach ($result as $data) {			
            $obatalkes_id   = trim($data['obatalkes_id']);
            $obatalkes_kode = trim($data['obatalkes_kode']);
            $obatalkes_nama = trim($data['obatalkes_nama']);
            $stok 			= trim($data['stok']) + 0;

		  	array_push($value, array(
		  		'id'   => $obatalkes_id,
		  		'text' => $obatalkes_nama .' | '. $obatalkes_kode,
		  		'stok'   => $stok
		  	));
		}
		return json_encode($value);
    }
}
?>