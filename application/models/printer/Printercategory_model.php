<?php

class Printercategory_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }




           public function Update($data)
        {


$where = array(
        'owner_id' => $_SESSION['owner_id'],
        'product_category_id'  => $data['product_category_id']
);

$this->db->where($where);
if ($this->db->update("wh_product_category", $data)){
        return true;
    }

}







           public function Get()
        {

$query = $this->db->query('SELECT product_category_id,product_category_name,printer_ip FROM wh_product_category WHERE owner_id="'.$_SESSION['owner_id'].'" ORDER BY product_category_id DESC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


   public function Getcashier()
        {

$query = $this->db->query('SELECT cashier_printer_ip,printer_type,printer_ul,printer_name FROM owner WHERE owner_id="'.$_SESSION['owner_id'].'"');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }




   public function Cashierprinteripupdate($data)
        {


$where = array(
        'owner_id' => $_SESSION['owner_id']
);


$newdata = array(
  'printer_type' => $data['printer_type'],
  'printer_ul' => $data['printer_ul'],
  'printer_name' => $data['printer_name']
);

$this->session->set_userdata($newdata);



$this->db->where($where);
if ($this->db->update("owner", $data)){
        return true;
    }

}




    }
