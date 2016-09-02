<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("GMT");
class Support_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/mail_model','mail_model');
	}
	
	
	
	function index()
	{
		
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$msg = $_POST['message'];
		
		$subject = "Outfit - Need Support";
		$message = "<p>Email: ".$email." <br> First name: ".$fname." <br>Last name: ".$lname." <br> Message: ".$msg."</p>";
		
		$to_email = "tobias@outfitstaff.com";
		$this->mail_model->send($to_email,$subject,$message); 
		
	}
	
}
	