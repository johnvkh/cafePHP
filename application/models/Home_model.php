<?php

class Home_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->library('session');
    }

    public function Getlogo() {

        $query = $this->db->query('SELECT owner_logo,owner_bgimg FROM owner  LIMIT 1  ');
        return $query->result_array();
    }

    public function Saletoday() {
        if (isset($_SESSION['shift_id'])) {
            $shift_id = $_SESSION['shift_id'];
        } else {
            $shift_id = '0';
        }
        $query = $this->db->query('SELECT SUM(sumsale_num) as sumnum,SUM(sumsale_price) as sumprice,SUM(discount_last) as sumdiscount FROM sale_list_header WHERE owner_id="' . $_SESSION['owner_id'] . '" AND shift_id="' . $shift_id . '" ');
        return $query->result_array();
    }

    public function Productsaletoday() {
        if (isset($_SESSION['shift_id'])) {
            $shift_id = $_SESSION['shift_id'];
        } else {
            $shift_id = '0';
        }

        $query = $this->db->query('SELECT wpl.product_code as product_code,
    wpl.product_name as product_name, (SELECT sum(sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id  AND sd.owner_id="' . $_SESSION['owner_id'] . '" AND sd.shift_id="' . $shift_id . '") as product_numall
    FROM wh_product_list as wpl WHERE wpl.owner_id="' . $_SESSION['owner_id'] . '" ORDER BY product_numall DESC LIMIT 9');
        return $query->result_array();
    }

    public function Customersaletoday() {
        $today = date('d-m-Y', time());
        $dayfrom = strtotime($today);
        $dayto = strtotime($today) + 86400;
        $query = $this->db->query('SELECT wpl.cus_name as name,
    (SELECT sum(sd.sumsale_num) FROM sale_list_header as sd WHERE sd.cus_id=wpl.cus_id  AND sd.owner_id="' . $_SESSION['owner_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as sumsale_num
    FROM customer_owner as wpl WHERE wpl.owner_id="' . $_SESSION['owner_id'] . '" ORDER BY sumsale_num DESC LIMIT 9');
        return $query->result_array();
    }

    public function Productoutofstock() {

        $query = $this->db->query('SELECT
    product_name,product_stock_num
    FROM wh_product_list
    WHERE owner_id="' . $_SESSION['owner_id'] . '" AND product_stock_num > "0"
    ORDER BY product_stock_num ASC  LIMIT 9  ');
        return $query->result_array();
    }

    public function Productpawnenddate() {

        $timenow = time();
        $query = $this->db->query('SELECT *,end_date+86400 as end_date,from_unixtime(end_date,"%d-%m-%Y") as end_date_date
    ,from_unixtime(add_time,"%d-%m-%Y") as add_time_date FROM pawn
    WHERE (end_date+86400) < "' . $timenow . '" AND pawn_status="0" ORDER BY end_date ASC  LIMIT 9');
        return $query->result_array();
    }

}
