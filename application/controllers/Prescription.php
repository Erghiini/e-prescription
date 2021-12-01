<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('prescription_m');
	}

	public function index()
	{
		$data['all_data'] = $this->prescription_m->getPrescription();

		$this->load->view('templates/header');
		$this->load->view('prescription/index', $data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$this->load->view('templates/header');
		$this->load->view('prescription/add');
		$this->load->view('templates/footer');
	}

	public function view($prescription_id = '')
	{
		$data['prescription_id']  	  = $prescription_id;
		$data['prescription'] = $this->prescription_m->getPrescriptionById($prescription_id);
		$data['non_racikan']  = $this->prescription_m->getNonRacikanById($prescription_id);
		$data['racikan']  	  = $this->prescription_m->getRacikanById($prescription_id);
		$racikan_obat  	  	  = $this->prescription_m->getObatRacikanById($prescription_id);

		$data['racikan_obat'] = array();
        foreach ($racikan_obat as $data1) {
            $racikan_id = $data1['racikan_id'];

            $data['racikan_obat'][$racikan_id][] = $data1;
        }

		$this->load->view('templates/header');
		$this->load->view('prescription/view', $data);
		$this->load->view('templates/footer');
	}

	public function getPatient()
	{
		echo $this->prescription_m->getPatient();
	}

	public function add_process()
	{
		$this->prescription_m->add_process();

		header('Location: '. base_url() . 'index.php/prescription', 308);
	}

	public function print($prescription_id = '')
	{
		$data['prescription'] = $this->prescription_m->getPrescriptionById($prescription_id);
		$data['non_racikan']  = $this->prescription_m->getNonRacikanById($prescription_id);
		$data['racikan']  	  = $this->prescription_m->getRacikanById($prescription_id);

		if (!$data['prescription']) show_404();

		$file_nama = $data['prescription']['patient_name'] .' - '. date('Ymd');

		ob_start();

		$this->load->view('prescription/print', $data);

		$html = ob_get_contents();
		ob_end_clean();

		include 'assets/libraries/dompdf/autoload.inc.php';
		$dompdf = new Dompdf\Dompdf();
		// Load HTML data
		$dompdf->loadHtml($html);
		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$dompdf->setPaper('A4', 'potrait');
		// Menjadikan HTML sebagai PDF
		$dompdf->render();
		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$dompdf->stream($file_nama, ["Attachment" => 0]);
	}
}
