<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription_m extends CI_Model{

    public function getPatient(){
        $search = "%". trim($_GET['search']) . "%";
        $result = $this->db->query("
            SELECT  *
            FROM patient_m 
            WHERE   patient_name LIKE '%". $search ."%'
            ORDER BY patient_name ASC
            LIMIT 15
        ")->result_array();
        
        $value = array();
        foreach ($result as $data) {            
            $patient_id      = trim($data['patient_id']);
            $patient_name    = trim($data['patient_name']);
            $patient_address = trim($data['patient_address']);

            array_push($value, array(
                'id'   => $patient_id,
                'text' => $patient_name .' - '. $patient_address
            ));
        }
        return json_encode($value);
    }

    public function getPrescription(){
        $result = $this->db->query("
            SELECT  a.*
                , b.patient_name
                , b.patient_address
                , (SELECT count(*) FROM non_racikan WHERE prescription_id = a.prescription_id) AS non_racikan_total
                , (SELECT count(*) FROM racikan WHERE prescription_id = a.prescription_id) AS racikan_total
            FROM prescription_m AS a
            INNER JOIN patient_m AS b 
                ON b.patient_id = a.patient_id
            ORDER BY created_date DESC
        ")->result_array();

        return $result;
    }

    public function getPrescriptionById($prescription_id){
        $result = $this->db->query("
            SELECT  a.*
                ,   b.patient_name
                ,   b.patient_birthplace
                ,   b.patient_birthdate
                ,   b.patient_address
            FROM prescription_m AS a
            INNER JOIN patient_m AS b 
                ON b.patient_id = a.patient_id
            WHERE a.prescription_id = $prescription_id
            ORDER BY a.created_date DESC
        ")->row_array();

        return $result;
    }

    public function getNonRacikanById($prescription_id){
        $result = $this->db->query("
            SELECT  b.*
                ,   c.obatalkes_nama
                ,   c.obatalkes_kode
                ,   d.signa_nama
                ,   d.signa_kode
            FROM prescription_m     AS a
            INNER JOIN non_racikan  AS b 
                ON b.prescription_id = a.prescription_id
            INNER JOIN obatalkes_m  AS c 
                ON c.obatalkes_id = b.obatalkes_id
            INNER JOIN signa_m      AS d 
                ON d.signa_id = b.signa_id
            WHERE a.prescription_id = $prescription_id
            ORDER BY b.created_date ASC
        ")->result_array();

        return $result;
    }

    public function getRacikanById($prescription_id){
        $result = $this->db->query("
            SELECT  b.*
                ,   c.signa_nama
                ,   c.signa_kode
            FROM prescription_m AS a
            INNER JOIN racikan  AS b 
                ON b.prescription_id = a.prescription_id
            INNER JOIN signa_m  AS c
                ON c.signa_id = b.signa_id
            WHERE a.prescription_id = $prescription_id
            ORDER BY b.created_date ASC
        ")->result_array();

        return $result;
    }

    public function getObatRacikanById($prescription_id){
        $result = $this->db->query("
            SELECT  b.*
                ,   c.qty
                ,   d.obatalkes_nama
                ,   d.obatalkes_kode
            FROM prescription_m AS a
            INNER JOIN racikan  AS b 
                ON b.prescription_id = a.prescription_id
            INNER JOIN racikan_obat  AS c
                ON c.racikan_id = b.racikan_id
            INNER JOIN obatalkes_m  AS d
                ON d.obatalkes_id = c.obatalkes_id
            WHERE a.prescription_id = $prescription_id
            ORDER BY b.created_date ASC
        ")->result_array();

        return $result;
    }

    public function add_process() {
        $patient_id      = $_POST['patient_id'];
        $data            = array(
            'patient_id' => $patient_id, 
            'created_by' => ''
        );
        $result          = $this->db->insert('prescription_m', $data);
        $prescription_id = $this->db->insert_id();

        $non_racik = $_POST['non_racik'];
        for ($i = 0; $i < count($non_racik['obatalkes_id']); $i++) {
            $obatalkes_id = $non_racik['obatalkes_id'][$i];
            $qty          = $non_racik['qty'][$i];
            $signa_id     = $non_racik['signa_id'][$i];

            $data            = array(
                'prescription_id' => $prescription_id,
                'obatalkes_id'    => $obatalkes_id,
                'qty'             => $qty,
                'signa_id'        => $signa_id
            );
            $result         = $this->db->insert('non_racikan', $data);
            $non_racikan_id = $this->db->insert_id();

            $result = $this->db->query("
                UPDATE obatalkes_m SET 
                    stok = stok - $qty,
                    last_modified_date = current_timestamp
                WHERE obatalkes_id = $obatalkes_id
            ");
        }

        $racik = $_POST['racik'];
        for ($i = 0; $i < count($racik['nama_racikan']); $i++) {
            $nama_racikan = $racik['nama_racikan'][$i];
            $signa_id   = $racik['signa_id'][$i];

            $data = array(
                'prescription_id'   => $prescription_id,
                'racikan_nama'      => $nama_racikan,
                'signa_id'          => $signa_id
            );
            $result     = $this->db->insert('racikan', $data);
            $racikan_id = $this->db->insert_id();

            for ($j = 0; $j < count($racik['obatalkes_id'][$i]); $j++) {
                $obatalkes_id = $racik['obatalkes_id'][$i][$j];
                $qty          = $racik['qty'][$i][$j];

                $data = array(
                    'racikan_id'    => $racikan_id,
                    'obatalkes_id'  => $obatalkes_id,
                    'qty'           => $qty
                );
                $result     = $this->db->insert('racikan_obat', $data);
                $racikan_obat_id = $this->db->insert_id();

                $result = $this->db->query("
                    UPDATE obatalkes_m SET 
                        stok = stok - $qty,
                        last_modified_date = current_timestamp
                    WHERE obatalkes_id = $obatalkes_id
                ");

                echo '<br>'.$obatalkes_id . '<br>' . $qty;
            }
        }
    }
}
?>