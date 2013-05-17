<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

 	public function __construct()	{
  	
  	parent::__construct();
    // Your own constructor code
   
 	}

	public function index() {
		
		$data["title"] 					= "Dashboard";
		$data["main_content"]		= "dashboard/index";

		$this->load->view('template', $data);

	}

	public function form() {

		$this->load->helper("form");

		$data["main_content"] 	= "dashboard/form";

		$this->load->view("template", $data);

	}

}