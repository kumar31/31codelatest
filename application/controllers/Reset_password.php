<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
class Reset_password extends CI_Controller {

	public function __construct()
    {
        
        parent::__construct();
        
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('webservice/mail_model','mail_model');
		$this->load->model('webservice/resetpassword_model','resetpassword_model');
		
        
    }
	public function index()
	{
		
		
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('reset_passwordview');
		}
		else
		{
			$rand_num = $this->uri->segment(2);
			//$type = $this->uri->segment(3);
			
			$this->db->select('*');
			$this->db->where('opaque_id',$rand_num);
			$this->db->from('password_reset_requests');
			$query = $this->db->get();
			$result = $query->result_array();
			$user_id = $result[0]['user_id'];		
			$type = $result[0]['type'];
			
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$repassword = $_POST['passconf'];
			
			$data = array(
				'password' => $password
			);
				
			if($type == 1) {
				$this->db->where('client_id',$user_id);
				$this->db->update('client_details',$data);
			}
			if($type == 2) {
				$this->db->where('talent_id',$user_id);
				$this->db->update('talent_details',$data);
			}
			
			$this->db->where('opaque_id',$rand_num);
			$this->db->delete('password_reset_requests');
			
			$this->email($user_id,$type);
			$this->load->view('password_updated');
		}
		
	}
	
	function email($user_id,$type) {
		
		$rand_num = rand(000000,999999);
			
		$dateFormat="Y-m-d H:i:s";
		$timeNdate=gmdate($dateFormat, time());
			
		if($type == 1) {
			$this->db->select('*');
			$this->db->where('client_id',$user_id);
			$this->db->from('client_details');
			$query = $this->db->get();
			$result = $query->result_array();
			$user_id = $result[0]['client_id'];
		}
		if($type == 2) {
			$this->db->select('*');
			$this->db->where('talent_id',$user_id);
			$this->db->from('talent_details');
			$query = $this->db->get();
			$result = $query->result_array();
			$user_id = $result[0]['talent_id'];
		}	
		
			$data = array(
				'user_id' 				=> $userid,
				'opaque_id' 			=> $rand_num,
				'timestamp' 			=> $timeNdate,
				'type' 					=> $_POST['type']
			);
			$this->db->insert('password_reset_requests',$data);
			
			$email = $result[0]['email'];
			$Password = $result[0]['password'];
			$firstname = $result[0]['first_name']; 
			$subject = "Outfit - Password Reset Confirmation ";
			$messagetext = "<p>Dear ".$firstname.",</p>";
			$messagetext .= "<p>You have reset your Outfit Password on   .If you did not make these changes or if you believe an unauthorised person has accessed your account, you should change your password as soon as possible by clicking on the button below </p> </br>";
			$messagetext .= "<a href=".base_url()."index.php/reset_password/".$rand_num."><button>Reset Password</button></a>";
			$messagetext .= "<p>(Click the above button only if you have not changed your password at the date and time mentioned above).</p> </br>";
			$messagetext .= "<p>Thanks for using Outfit.</p>";
			$messagetext .= "<p>Sincerely,</p>";
			$messagetext .= "<p>Outfit Support</p>";
			$messagetext .= "<p>Disclaimer: This email may contain privileged information and is intended solely for the addressee, 
			and any disclosure &#x2F; misuse of this information is strictly prohibited, and may be unlawful.
			If you have received this mail by mistake, Please delete this mail immediately.</p>";
			
			$this->mail_model->send($email,$subject,$messagetext);
			//$this->sendemail($email,$messagetext,$subject);
			return $email;
	}
	
}