<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {

	const SALES_FORCE_URL = "http://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8";
	const SALES_FORCE_ID  =	"00DE0000000Iui7";

	public function __construct()	{
		parent::__construct();
	}

	/**
	 * Retrieving requests from forms
	 * @param  string $token_key unique string assign on a registered website
	 * @return [type]            [description]
	 */
	public function send($token_key) {

		$this->load->helper(array("url", "form"));
		$this->load->model("Website_model","Website");


		$model = $this->Website->find_by_token($token_key);

		// Check if a record can be found on the given token key, else, terminate early.
		if(! $model) {
			$this->load->helper("url");
			redirect("/requests/error", "location");
		}

		$content 	=	$this->input->post(NULL, TRUE);
		
		$response = self::_save_to_db($model->row()->id, $content);

		if(! $response){

			echo "Cannot save to database";
			exit();

		}


		// Send email to the website's recepients
		// $response = self::_send_to_email($model, $content);

		// // If email is not successful, terminate the process at once.
		// if (! $response ) { 

		// 	echo "Cannot process the form.";
		// 	exit();

		// } 

		// Send to Salesforce's leads.
		$response = self::_send_to_salesforce($model, $content);

		redirect($this->Website->redirection_url, "location");

	}

	public function error()	{
		
		echo "no key found in the database";

	}


/**------------------------------------------------------
 * Private functions
 */

	private function _save_to_db($website_id, $content) {

		$this->load->model("Email_model", "Email");

		return $this->Email->save_email($website_id, $content);

	}

	private function _send_to_salesforce($model, $content) {

		// Uses CI library for curl. Credits to https://github.com/philsturgeon/codeigniter-curl
		$this->load->library('curl'); 

		// Remove submit array index if present
    if (isset($data["submit"])) unset($data["submit"]);

		$rev_name               = explode(' ', strrev($content["name"]));
		$content["first_name"]  = substr($content["name"],0,-abs(strlen(trim($rev_name[0]))));
		$content['last_name']   = strrev($rev_name[0]);
		$content["lead_source"] =	$model->row()->domain_name;
		$content["oid"]         =	self::SALES_FORCE_ID;
	
		$this->curl->create(self::SALES_FORCE_URL);
		$this->curl->option('buffersize', 10);

		// echo "<pre>" . print_r($content, TRUE) . "</pre>";
		
		// echo "success!";
		
		$this->curl->post($content);

		return $this->curl->execute();

	}

	private function _send_to_email($model, $content) {
		$this->load->library("email");

		// Remove submit array index if present
    if (isset($data["submit"])) unset($data["submit"]);

		$this->email->from('do-not-reply@seop.com', "Leads Form"); 
		$this->email->to($model->row()->recepients); 
		// $this->email->cc('another@another-example.com'); 
		// $this->email->bcc('them@their-example.com'); 

		$this->email->subject("Message from " . $model->row()->domain_name .  " form");
		$this->email->message("<pre>" . print_r($content, TRUE) . "</pre>");	
		$this->email->print_debugger();

		if(! $this->email->send()) {
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file requests.php */
/* Location: ./application/controllers/requests.php */