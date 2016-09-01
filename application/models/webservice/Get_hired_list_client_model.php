<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Get_hired_list_client_model extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('webservice/review_model','review_model');
		$this->load->model('webservice/talent_model','talent_model');		
		$this->load->model('webservice/hired_info_model','hired_info_model');		
		$this->load->model('webservice/event_model','event_model');		
	}
	
	
	
	function index()
	{		
		
	
			$this->db->select('*');		
			$this->db->where('client_id',$_POST['client_id']);
			$this->db->where('event_id',$_POST['event_id']);
			$this->db->where('status','3');
			$this->db->from('invite_talent_to_event');
			$query = $this->db->get(); 
			$result = $query->result_array();
			$event_id = $_POST['event_id'];
			$result = $this->review_model->review_count($result);			
			$result = $this->talent_model->talentdetails($result);			
			$hired_info = $this->hired_info_model->index();
			$hired_info = $this->hired_info_model->index();
			$event_detail = $this->event_model->first_name($event_id);
			$result = array('get_hiredlist'=>$result,'hired_info'=>$hired_info,'event_detail'=>$event_detail);
			
			return $result;	
		
	}
	
}
	