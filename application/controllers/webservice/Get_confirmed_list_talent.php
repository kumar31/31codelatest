<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
/* Error status code
200 - OK
201 - Created
202 - INVALID ACCESS
400 - BAD REQUEST
*/

//error_reporting(E_PARSE);
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
require APPPATH.'/libraries/REST_Controller.php';
require APPPATH.'/libraries/variableconfig.php';
require APPPATH.'/libraries/validationandresult.php'; 

class Get_confirmed_list_talent extends REST_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->library('form_validation');
		$this->load->model('webservice/get_confirmed_list_talent_model','get_confirmed_list_talent_model');
		$this->form_validation->set_error_delimiters('', '');
	}
	
	
	// Function : Code For Login.
	
	public function index_post()
	{
		$validationandresult = new validationandresult();
			if(isset($_POST) != "")
			{
					
					
					// Empty key checking.
					$pre_key = array('talent_id');
					
					$result = $validationandresult->keyvalidation($pre_key);
					
					if($result['message'] != '')
					{
						$this->response($result, 202);

					}
					else
					{
						
						$this->form_validation->set_rules('talent_id', 'talent_id', 'trim|required');
						
						if($this->form_validation->run() == FALSE)
						{ 
							$validation_errors = validation_errors();
							$result = $validationandresult->formvalidation($validation_errors);
							$this->response($result, 202);
						}
						else {
							 
							$result = $this->get_confirmed_list_talent_model->index();	
							
							$result = $validationandresult->successmessagewithresult($result);
							$this->response($result, 200);
						
						}
							
					}
					
			} 
			else
			{ 		$result = $validationandresult->invalidrequest();
					$this->response($result, 202);
					
			}
		
	}
	
}
