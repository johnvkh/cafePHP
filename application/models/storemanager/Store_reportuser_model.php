<?php

class Store_reportuser_model extends CI_Model {
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->library('session');
    }

    public function Daylist($data) {
        $dayfrom = strtotime($data['dayfrom']);
        $dayto = strtotime($data['dayto']) + 86400;
        $user_id = $data['user_id'];
        $query= $this->db->query('SELECT 
    wpl.product_code as product_code,
    wpl.product_name as product_name,
    (SELECT sum(sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id  AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_numall,
    (SELECT sum(sd.product_price * sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id   AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_pricesaleall,
    (SELECT sum(sd.product_price_discount*sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id   AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_pricediscountall,
    (SELECT sum((sd.product_price - sd.product_price_discount) * sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id  AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_priceall,
    (SELECT wid.product_pricebase FROM wh_product_list as wid WHERE wid.product_id=wpl.product_id AND wid.store_id="' . $_SESSION['store_id'] . '") as product_pricebaseall
    FROM wh_product_list as wpl WHERE wpl.store_id="' . $_SESSION['store_id'] . '" ORDER BY product_priceall DESC');
        $query2 = $this->db->query('SELECT 
    wpl.product_code as product_code,
    wpl.product_name as product_name,
    (SELECT sum(sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id  AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.user_id="' . $user_id . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '" ) as product_numall,
    (SELECT sum(sd.product_price * sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id   AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.user_id="' . $user_id . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_pricesaleall,
    (SELECT sum(sd.product_price_discount*sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id   AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.user_id="' . $user_id . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_pricediscountall,
    (SELECT sum((sd.product_price - sd.product_price_discount) * sd.product_sale_num) FROM sale_list_datail as sd WHERE sd.product_id=wpl.product_id  AND sd.store_id="' . $_SESSION['store_id'] . '" AND sd.user_id="' . $user_id . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '") as product_priceall,
    (SELECT wid.product_pricebase FROM wh_product_list as wid WHERE wid.product_id=wpl.product_id AND wid.store_id="' . $_SESSION['store_id'] . '") as product_pricebaseall
    FROM wh_product_list as wpl WHERE wpl.store_id="' . $_SESSION['store_id'] . '" ORDER BY product_priceall DESC');
        if ($user_id == '0') {
            $query = $query;
        } else {
            $query = $query2;
        }
        $encode_data = json_encode($query->result(), JSON_UNESCAPED_UNICODE);
        return $encode_data;
    }

    public function Exportexcel($data) {
        $dayfrom = strtotime($data['dayfrom']);
        $dayto = strtotime($data['dayto']) + 86400;

        $query = $this->db->query('SELECT 
    sh.cus_name as "???????????????????????????",
    sd.product_code as "?????????????????????????????????",
	sd.product_name as "???????????????????????????",
	sd.product_price as "?????????????????????",
    sd.product_price_discount as "????????????????????????",
	sd.product_sale_num as "?????????????????????????????????",
	(sd.product_price*sd.product_sale_num)-(sd.product_sale_num*sd.product_price_discount) as "??????????????????",
	from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as "???????????????"
FROM sale_list_datail as sd
LEFT JOIN sale_list_header as sh on sh.sale_runno=sd.sale_runno
WHERE sh.store_id="' . $_SESSION['store_id'] . '" AND sd.adddate BETWEEN "' . $dayfrom . '" AND "' . $dayto . '"
order by sd.ID DESC 
 ');
        return $query;
    }

}
