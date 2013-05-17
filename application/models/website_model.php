<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website_model extends CI_Model {

  const TABLE_NAME  = "websites";
  
  public $redirection_url;

  

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Get all Website Item
   * @return [type] [description]
   */
  public function get_all_items()  {

    $model  =   $this->db->get_where(self::TABLE_NAME, array("is_active" => 1));

    if($model->num_rows() < 1 ) return false;

    return $model;
  }

  /**
   * Get all rows corresponding to the id given
   * @param  string $website_id [description] 
   * @return [type]             [description]
   */
  public function find_by_id($website_id = '') {

    // Fail early validation
    if ( $website_id === '') return false;

    $model =  $this->db->get_where(self::TABLE_NAME, array("is_active" => 1, "id" =>  $website_id), 1);

    if ($model->num_rows() < 1 ) return false;

    return $model;

  }

  /**
   * Get all rows corresponding to the token key given
   * @param  string $token_key [description]
   * @return [type]            [description]
   */
  public function find_by_token($token_key = '')  {
    
    if($token_key == '') return false; // Fail early validation

    $model  =   $this->db->get_where(self::TABLE_NAME, array("is_active" => 1, "token_key" => $token_key));
  
    if($model->num_rows() < 1)  return false; 

    $this->redirection_url = self::set_redirection_url($model);

    return $model;
  }


  public function insert_entry($data) {
    
    $model = array(

      "token_key"       =>    sha1(uniqid(mt_rand(), true)),
      "domain_name"     =>    $data["domain_name"],
      "url"             =>    prep_url($data["url"]),
      "recepients"      =>    $data["recepients"],
      "adword_id"       =>    $data["adword_id"],
      "redirection_url" =>    $data["redirection_url"],
      "custom_message"  =>    $data["custom_message"],
      "custom_layout"   =>    $data["custom_layout"],
      "created_by"      =>    1,
      "created_date"    =>    date("Y-m-d H:i:s"),
      "updated_date"    =>    date("Y-m-d H:i:s"),
      "is_active"       =>    1

    );

     return $this->db->insert(self::TABLE_NAME, $model);

  }

  public function update_entry($data) {
    $this->db->where("token_key", $data["token_key"]);

    // Remove submit array index if present
    if (isset($data["submit"])) unset($data["submit"]);

    
    if (! $this->db->update(self::TABLE_NAME, $data) ) {
      return false;
    }

    return true;

  }

  public function delete_by_token($token_key = '') {
    
    if($token_key == '') return false; // Fail early validation

    $this->db->where("token_key", $token_key);

    if (! $this->db->update(self::TABLE_NAME, array("is_active" => 0))) {
      return false;
    }

    return true;

  }


  public function get_token_key($id) {

    $this->db->select("token_key")->from(self::TABLE_NAME)->where("id", $id)->limit(1);

    return $this->db->get();

  }



// PRIVATE FUNCTIONS 
// ------------------------------------------------------------------- 

  private function set_redirection_url($model) {

    if ( !$model->row()->redirection_url ) {
      return $model->row()->url . "?res=ok";
    }

    return $model->row()->redirection_url . "?res=ok";

  }
}
/* End of file website_model.php */
/* Location: ./application/models/websites_model.php */