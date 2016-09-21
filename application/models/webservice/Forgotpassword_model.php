<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
date_default_timezone_set("GMT");
require_once APPPATH.'/libraries/variableconfig.php';

class Forgotpassword_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/mail_model','mail_model');
	}
	
	function index(){
		
			$variableconfig = new variableconfig();
			$fpassurl = $variableconfig->fpassurl(); 
			$from_email = $variableconfig->from_email();
			
			$rand_num = rand(000000,999999);
			
			$dateFormat="Y-m-d H:i:s";
			$timeNdate=gmdate($dateFormat, time());	
			if($_POST['type'] == 1) {
				$this->db->select('*');		
				$this->db->where('email',$_POST['email']);		
				$this->db->from('client_details');
				$query = $this->db->get();
				$result = $query->result_array();
				$userid = $result[0]['client_id'];
				
			}
			if($_POST['type'] == 2) {
				$this->db->select('*');		
				$this->db->where('email',$_POST['email']);		
				$this->db->from('talent_details');
				$query = $this->db->get();
				$result = $query->result_array();
				$userid = $result[0]['talent_id'];
				
			}
			
			$data = array(
				'user_id' 				=> $userid,
				'opaque_id' 			=> $rand_num,
				'timestamp' 			=> $timeNdate,
				'type' 					=> $_POST['type'],
			);
			$this->db->insert('password_reset_requests',$data);	
			
			$to_email = $result[0]['email'];
			$firstname = $result[0]['first_name']; 
			$password = $result[0]['password'];
			$subject = "Outfit - Forgot Password Request";
			$message = "<p>Hi ".$firstname.",</p>";
			$message .= "<p>You have requested recovery of your Outfit password.</p> </br>";
			$message .= "<p>Click the button below and reset the password.</p> </br>";
			$message .= "<a href=".$fpassurl.$rand_num"><button>Reset Password</button></a>";
			$message .= "<p>If you did not request recovery of password, please ignore this mail. </br></p>";
			$message .= "<p>Thanks for using Outfit.</p>";
			$message .= "<p>Sincerely,</p>";
			$message .= "<p>Outfit Support</p>";
			$message .= "<p>Disclaimer: This email may contain privileged information and is intended solely for the addressee, 
			and any disclosure &#x2F; misuse of this information is strictly prohibited, and may be unlawful.
			If you have received this mail by mistake, Please delete this mail immediately.</p>";
			
			$this->mail_model->send($to_email,$subject,$message);
			return $to_email;
	}
	

	
	
}