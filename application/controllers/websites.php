<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Websites extends CI_Controller {

 	public function __construct()	{
  	
  	parent::__construct();
    
    $this->load->model("Website_model", "Website");
 		$this->load->helper("form");
		$this->load->library('form_validation');
		$this->load->library("session");
 	
 	}

 	/**
 	 * Page to list all Websites
 	 * @return [type] [description]
 	 */
 	public function show_list() 	{

 		$data["main_content"] 	= 	"websites/show_list";
 		$data["items"] 					=		$this->Website->get_all_items();

 		$notify = $this->input->get("st", TRUE);

 		$this->load->view("template", $data);

 	}


	/**
	 * Page for creating new Website Entries
	 * @return [type] [description]
	 */
 	public function create(){

 		$data["main_content"]		=		"websites/create";

 		$this->load->view("template", $data);

 	}

 	public function update() {

 		$content 	=	$this->input->post(NULL, TRUE);

 		if(! $this->Website->update_entry($content)) {
 			$this->session->set_flashdata("alert", "<p> Error doing your request. </p>");
 			exit();
 		}

 		$this->session->set_flashdata("alert", "<p> Successfully updated the content. </p>");

		redirect("websites/show_list" );

 	}

 	/**
 	 * [register_website description]
 	 * @return [type] [description]
 	 */
 	public function register_website() {
 		
 		$content = $this->input->post(NULL, TRUE);

 		if(! $this->Website->insert_entry($content)){

 			$this->session->set_flashdata("alert", "<p> Error doing your request. </p>");

 			exit();

 		}

 		$token_key = $this->Website->get_token_key($this->db->insert_id());
 		
 		redirect("/websites/show_access_url/" . $token_key->row()->token_key,"location");

 	}


 	/**
 	 * Page for editing specific website information
 	 * @param  string $website_id [description]
 	 * @return [type]             [description]
 	 */
 	public function edit($token_key = "") {

 		$model 	= 	$this->Website->find_by_token($token_key);

		$data["main_content"] = "websites/edit";
		$data["item"]         =	$model;

 		$this->load->view("template", $data);

 	}


 	public function delete($token_key) {
 		
 		$model  = 	$this->Website->delete_by_token($token_key);

 		if ($model) {
 			$this->session->set_flashdata("alert", "<p> 1 record deleted! </p>");
 			redirect("websites/show_list" . "?st=ok");
 			exit();
 		}

 		$this->session->set_flashdata("alert", "<p> Error doing your request. </p>");
 		redirect("websites/show_list");

 	}


 	/**
 	 * Shows the Page Access link after saving new item
 	 * @return [type] [description]
 	 */
 	public function show_access_url($token_key){

		$data["main_content"] =		"websites/show_access_url";
		$data["url"]          =		$this->config->site_url() . "requests/send/" . $token_key;

		$this->load->view("template", $data);

 	}

}
/* End of file websites.php */
/* Location: ./application/controllers/websites.php */