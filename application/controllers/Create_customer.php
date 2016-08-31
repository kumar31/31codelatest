<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
require APPPATH.'/lib/Stripe.php';

class Create_customer extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation', 'session');

	}
	public function index()
	{

		$result = Stripe_Token::create(
		array(
				   "card" => array(
					"name" => $_POST['firstname'],
					"number" => $_POST['cardnumber'],
					"exp_month" => $_POST['expmonth'],
					"exp_year" => $_POST['expyear'],
					"cvc" => $_POST['cvc']
				)
			)
		);
		echo $token = $result['id'];
		$customer = Stripe_Customer::create(array(
        'source'   => $token,
        'email'    => $_POST['emailid'],
        'description' => "Seller"
         ));
		echo $customerId = $customer->id; 

	}
	
}
