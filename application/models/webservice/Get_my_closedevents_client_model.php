<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Get_my_closedevents_client_model extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('webservice/invite_model','invite_model');
	}
	
	
	
	function index()
	{		
		
	
			$this->db->select('*');		
			$this->db->where('client_id',$_POST['client_id']);		
			$this->db->where('status',1);		
			$this->db->from('event_detail');
			$query = $this->db->get();
			$result = $query->result_array(); 
			$result = $this->invite_model->invite_details($result);
			
			return $result;	
		
	}
	
}
	