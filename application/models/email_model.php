<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	const TABLE_NAME = "email_messages";

	public function __construct() {
		parent::__construct();
		//Load Dependencies
	}


	public function save_email($website_id, $content) {
		
    $model = array(

			"date"       => date("Y-m-d H:i:s"),
			"website_id" => $website_id,
			"data"       =>	serialize($content)

    );

    return $this->db->insert(self::TABLE_NAME, $model);
	}

}

/* End of file email_model.php */
/* Location: ./application/models/email_model.php */