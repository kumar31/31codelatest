<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Get_talent_profile_model extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('webservice/review_model','review_model');
		$this->load->model('webservice/event_model','event_model');
	}
	
	
	
	function index()
	{		
		
			$this->db->select('*');		
			$this->db->where('talent_id',$_POST['talent_id']);
			$this->db->from('talent_details');
			$query = $this->db->get(); 
			$result = $query->result_array(); 
			$result = $this->event_model->event_count($result);
			$result = $this->review_model->review_details($result);
			
			return $result;	
		
	}

}
	