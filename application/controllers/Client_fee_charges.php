<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
class Client_fee_charges extends CI_Controller {

public function __construct()
	{
	
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->library('form_validation');
			$this->load->library('form_validation', 'session');
	
	}
	public function index()
	{
		$myuser_id = $this->session->userdata('client_id');
		if($myuser_id == ''){
			$myuser_id = $this->input->cookie('client',true);
		}
		if($myuser_id!="") {		
			$client_id = $myuser_id;
			$this->load->view('client_fee_charges');
		}
		else {
			redirect('login');
		}
	}
	
}
