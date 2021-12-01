<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obatalkes extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('obatalkes_m');
        // $this->load->helper('url');
	}

	public function index()
	{
		$data['obatalkes'] = $this->obatalkes_m->getAllData();

		$this->load->view('templates/header');
		$this->load->view('obatalkes/index', $data);
		$this->load->view('templates/footer');
	}

	public function getObat()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) show_404();
		if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') show_404();

		$result = $this->obatalkes_m->getObat();
		echo $result;
	}
}
