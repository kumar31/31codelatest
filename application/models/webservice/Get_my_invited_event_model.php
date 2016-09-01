<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Get_my_invited_event_model extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('webservice/client_model','client_model');
		$this->load->model('webservice/event_model','event_model');
	}
	
	
	
	function index()
	{		
		
	
		$this->db->select('*');		
		$this->db->where('talent_id',$_POST['talent_id']);
		$this->db->where('status','0');
		$this->db->from('invite_talent_to_event');
		$query = $this->db->get(); 
		$result = $query->result_array();
		$result = $this->event_model->event_details($result);
		$result = $this->client_model->client_details($result);
		
		return $result;	
		
	}
	
	
	
	
	
}
	