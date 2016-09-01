<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Update_emailnotification_talent_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/talent_model','talent_model');
	}
	
	
	
	function index()
	{
			
		$data = array(
			'email' 						=> $_POST['email'],
			'email_notification' 			=> $_POST['email_notification'],
			'email_frequency' 				=> $_POST['email_frequency']			
		);
		
		$this->db->where('talent_id',$_POST['talent_id']);
		$this->db->update('talent_details',$data);
	
	}
	
}
	