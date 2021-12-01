<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signa extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('signa_m');
	}

	public function index()
	{
		$data['signa'] = $this->signa_m->getAllData();

		$this->load->view('templates/header');
		$this->load->view('signa/index', $data);
		$this->load->view('templates/footer');
	}

	public function getSigna()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) show_404();
		if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') show_404();
		
		$result = $this->signa_m->getSigna();
		echo $result;
	}
}
