<?php

class Salepage_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }

 public function Getrunnolast()
        {

$query = $this->db->query('SELECT sale_runno
    FROM sale_list_header
    WHERE owner_id="'.$_SESSION['owner_id'].'"
    ORDER BY ID DESC LIMIT 1');
$encode_data = $query->result_array();
return $encode_data;


        }




        public function Getnumforcuslast()
               {

       $query = $this->db->query('SELECT number_for_cus
           FROM owner
           WHERE owner_id="'.$_SESSION['owner_id'].'" LIMIT 1');
       $encode_data = $query->result_array();
       return $encode_data;


               }




           public function Getproductlist()
        {

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'"
    ORDER BY wl.product_id DESC LIMIT 9');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


          public function Getproductlistcat($data)
        {

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wc.product_category_id="'.$data['product_category_id'].'"
    ORDER BY wl.product_id DESC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


public function Searchproductlist($data)
        {

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_name LIKE "%'.$data['searchproduct'].'%" OR wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_code LIKE "%'.$data['searchproduct'].'%"
    ORDER BY wl.product_id DESC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }



        public function Findproduct($data)
        {

$query_p_cus = $this->db->query('SELECT *
    FROM product_price_cus
    WHERE owner_id="'.$_SESSION['owner_id'].'" AND cus_id="'.$data['cus_id'].'" AND product_code="'.$data['product_code'].'"
    ORDER BY product_id DESC');




$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'"
    ORDER BY wl.product_id DESC');



$query_p = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    pc.product_price_cus as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl
    LEFT JOIN product_price_cus as pc on pc.product_id=wl.product_id
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'" AND pc.cus_id="'.$data['cus_id'].'"
    ORDER BY wl.product_id DESC');


$query_p_cus_num_rows = $query_p_cus->num_rows();


if($query_p_cus_num_rows > 0){

  $encode_data = json_encode($query_p->result(),JSON_UNESCAPED_UNICODE );

}else{
   $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );

}



return $encode_data;

        }





  public function Customer($data)
        {

$query = $this->db->query('SELECT  co.cus_id as cus_id,co.cus_name as cus_name, co.cus_tel as cus_tel,co.cus_address as cus_address, co.cus_address_postcode as cus_address_postcode, co.cus_add_time as cus_add_time
    FROM customer_owner as co
    LEFT JOIN owner as ow on ow.owner_id=co.owner_id
    WHERE ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_name LIKE "%'.$data['cus_name'].'%" OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_add_time LIKE "%'.$data['cus_name'].'%"  ORDER BY co.cus_id DESC LIMIT 5');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }
















        public function Openbillclosedaylista($data)
                {

        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query = $this->db->query('SELECT
            wc.product_category_name as product_category_name2,
            sum((sd.product_price*sd.product_sale_num)-sd.product_price_discount) as product_price2,
            sum(sd.product_sale_num) as product_sale_num2,
            sum(sd.product_price_discount) as product_price_discount2
            FROM wh_product_category  as wc
            LEFT JOIN wh_product_list as wl on wl.product_category_id=wc.product_category_id
            LEFT JOIN sale_list_datail as sd on sd.product_id=wl.product_id

             WHERE sd.shift_id="'.$_SESSION['shift_id_old'].'"
             GROUP BY wc.product_category_name
             ');


        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );

        return $encode_data;

                }




                public function Openbillclosedaylistb($data)
                {
        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query2 = $this->db->query('SELECT
            sum(sumsale_price) as sumsale_price2,
            sum(sumsale_discount) as sumsale_discount2,
            sum(sumsale_num) as sumsale_num2,
            sum(discount_last) as discount_last2
            FROM sale_list_header
        WHERE shift_id="'.$_SESSION['shift_id_old'].'"
             ');

        $encode_data2 = json_encode($query2->result(),JSON_UNESCAPED_UNICODE );
        return $encode_data2;

                }





                public function Openbillclosedaylistc($data)
                {
        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query3 = $this->db->query('SELECT
            pay_type,
            sum(sumsale_price) as sumsale_price2,
            sum(sumsale_discount) as sumsale_discount2,
            sum(sumsale_num) as sumsale_num2,
            sum(discount_last) as discount_last2
            FROM sale_list_header

            WHERE shift_id="'.$_SESSION['shift_id_old'].'"
             GROUP BY pay_type
             ');

        $encode_data3 = json_encode($query3->result(),JSON_UNESCAPED_UNICODE );

        return $encode_data3;

                }








                public function Openbillclosedaylistproduct($data)
                {

              $query4 = $this->db->query('SELECT
              sd.product_id,
              wl.product_name,
              sum(sd.product_sale_num*(sd.product_price-sd.product_price_discount)) as product_sale_price,
              sum(sd.product_sale_num) as product_sale_num
              FROM sale_list_datail as sd
              LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id

              WHERE sd.shift_id="'.$_SESSION['shift_id_old'].'"
              GROUP BY sd.product_id
              ');

              $encode_data4 = json_encode($query4->result(),JSON_UNESCAPED_UNICODE );

              return $encode_data4;

                }














public function Adddetail($data)
        {

$data['owner_id'] = $_SESSION['owner_id'];
$data['user_id'] = $_SESSION['user_id'];
$data['store_id'] = $_SESSION['store_id'];
$data['shift_id'] = $_SESSION['shift_id'];
if ($this->db->insert("sale_list_datail", $data)){

  $query = $this->db->query('DELETE FROM sale_list_cus2mer  WHERE sc_ID="'.$data['sc_ID'].'"'); //delete all from showcus2mer


        return true;
    }

  }


      public function Addheader($data)
        {
$data2['cus_name'] = $data['cus_name'];
    $data2['cus_id'] = $data['cus_id'];
    $data2['cus_address_all'] = $data['cus_address_all'];
    $data2['sumsale_discount'] = $data['sumsale_discount'];
    $data2['sumsale_num '] = $data['sumsale_num'];
    $data2['sumsale_price'] = $data['sumsale_price'];
    $data2['money_from_customer'] =  $data['money_from_customer'];
    $data2['money_changeto_customer'] = $data['money_changeto_customer'];
    $data2['vat'] = $data['vat'];
    $data2['product_score_all'] = $data['product_score_all'];
    $data2['sale_runno'] = $data['sale_runno'];
    $data2['adddate'] = $data['adddate'];

    $data2['sale_type'] = $data['sale_type'];
    $data2['pay_type'] = $data['pay_type'];
    $data2['reserv'] = $data['reserv'];
    $data2['discount_last'] = $data['discount_last'];

$data2['owner_id'] = $_SESSION['owner_id'];
$data2['user_id'] = $_SESSION['user_id'];
$data2['store_id'] = $_SESSION['store_id'];
$data2['shift_id'] = $_SESSION['shift_id'];

$data2['number_for_cus'] = $data['number_for_cus'];

if ($this->db->insert("sale_list_header", $data2)){

$this->db->query('UPDATE customer_owner
    SET product_score_all=product_score_all + '.$data2['product_score_all'].' WHERE cus_id="'.$data2['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');


    $this->db->query('UPDATE owner
        SET number_for_cus=number_for_cus + "1" WHERE owner_id="'.$_SESSION['owner_id'].'"');



$this->db->query('DELETE FROM sale_list_cus2mer WHERE user_id="'.$_SESSION['user_id'].'"');


	}
}






public function Addmoneychange($m,$mc,$pc)
  {

$this->db->query('UPDATE owner
SET money_change_showcus='.$m.',money_from_cus_showcus='.$mc.',price_value_showcus='.$pc.' WHERE owner_id="'.$_SESSION['owner_id'].'"');


}



public function Updatemoneychange()
  {

$this->db->query('UPDATE owner
SET money_change_showcus="0.01" WHERE owner_id="'.$_SESSION['owner_id'].'"');


}




public function Showmoneychange($data)
  {

    $query = $this->db->query('SELECT money_change_showcus,money_from_cus_showcus,price_value_showcus FROM owner
        WHERE owner_id="'.$_SESSION['owner_id'].'" LIMIT 1');

    $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
    return $encode_data;

}







public function Openshiftnow($data)
               {
                 $data['shift_start_time'] = time();
                 $data['user_id'] = $_SESSION['user_id'];
                 $data['user_name'] = $_SESSION['name'];
                 if ($this->db->insert("shift", $data)){

                   $query = $this->db->query('SELECT
                   shift_id,shift_start_time,shift_end_time,user_id
                   FROM shift WHERE shift_start_time="'.$data['shift_start_time'].'" LIMIT 1 ');

                  //print_r($query->result_array());
                  $shift_id = $query->result_array();
//echo $shift_id[0]['shift_id'];

                  $newdata = array(
                    'shift_id' => $shift_id[0]['shift_id'],
                    'shift_start_time' => $shift_id[0]['shift_start_time'],
                    'shift_end_time' => $shift_id[0]['shift_end_time'],
                    'shift_user_id' => $shift_id[0]['user_id']
                  );

                  $this->session->set_userdata($newdata);


                     }


               }







               public function Closeshiftnowconfirm($data)
                            {
                    $query = $this->db->query('UPDATE shift
                        SET shift_end_time='.time().',shift_money_end="'.$data['shift_money_end'].'"
                        WHERE shift_id="'.$_SESSION['shift_id'].'" ');



               $queryshiftend = $this->db->query('SELECT
               shift_id,shift_start_time,shift_end_time,shift_money_start,shift_money_end
              FROM shift WHERE shift_id="'.$_SESSION['shift_id'].'" LIMIT 1 ');
              $shift_end = $queryshiftend->result_array();



                        $newdata = array(
                          'shift_id_old' => $shift_end[0]['shift_id'],
                          'shift_start_time_old' => date('d/m/Y H:i:s', $shift_end[0]['shift_start_time']),
                          'shift_end_time_old' => date('d/m/Y H:i:s', $shift_end[0]['shift_end_time']),
                          'shift_money_start_old' => $shift_end[0]['shift_money_start'],
                          'shift_money_end_old' => $shift_end[0]['shift_money_end'],
                        );

                        $this->session->set_userdata($newdata);


                    $this->session->unset_userdata('shift_id','shift_start_time','shift_end_time');



                    $this->db->query('UPDATE owner
                        SET number_for_cus="0" WHERE owner_id="'.$_SESSION['owner_id'].'"');




                            }






         public function Updateproductdeletestock($data2)
        {
$price_value = $data2['product_sale_num'] * $data2['product_price'];
$query = $this->db->query('UPDATE wh_product_list
    SET product_stock_num=product_stock_num - '.$data2['product_sale_num'].'
    WHERE product_id="'.$data2['product_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');
return true;

        }






 public function Addproductranksave($data)
        {

$query = $this->db->query('UPDATE wh_product_list
    SET product_rank='.$data['product_rank'].'
    WHERE product_id="'.$data['product_id'].'" ');
return true;

        }


 public function Delproductranksave($data)
        {

$query = $this->db->query('UPDATE wh_product_list
    SET product_rank="0"
    WHERE product_id="'.$data['product_id'].'" ');
return true;

        }





public function Gettoday($data)
        {


 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';
            }


            $start = ($page - 1) * $perpage;

$today = date('d-m-Y',time());

$querynum = $this->db->query('SELECT *,
    sh.product_score_all as product_score_all,cw.product_score_all as cus_score, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header as sh
    LEFT JOIN customer_owner as cw on cw.cus_id=sh.cus_id
    WHERE
    sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
    OR sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
    OR sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND cw.cus_name LIKE "%'.$data['searchtext'].'%"
    ORDER BY ID DESC LIMIT 30');


$query = $this->db->query('SELECT *,
    sh.product_score_all as product_score_all,cw.product_score_all as cus_score, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header as sh
    LEFT JOIN customer_owner as cw on cw.cus_id=sh.cus_id
    WHERE
    sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
    OR sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
    OR sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND cw.cus_name LIKE "%'.$data['searchtext'].'%"
    ORDER BY sh.ID DESC LIMIT '.$start.' , '.$perpage.' ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;


        }








        public function Saveshowcus($data)
                {

        $data['owner_id'] = $_SESSION['owner_id'];
        $data['user_id'] = $_SESSION['user_id'];
        $data['store_id'] = $_SESSION['store_id'];
        $data['adddate'] = time();
        if ($this->db->insert("sale_list_cus2mer", $data)){


          $query = $this->db->query('SELECT  sum(product_sale_num) as product_sale_num,
          sc_ID,
		  product_id,
          product_name,
          product_des,
          product_code,
          product_price,
          product_price_discount,
          product_price_discount_percent,
          product_score
              FROM sale_list_cus2mer
              WHERE user_id="'.$_SESSION['user_id'].'"
              GROUP BY product_id
            ORDER BY sc_ID ASC
            ');

          $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
          return $encode_data;



            }





          }








          public function Delshowcus($data)
                  {


$query = $this->db->query('DELETE FROM sale_list_cus2mer  WHERE product_id="'.$data['product_id'].'"');

$query = $this->db->query('SELECT  sum(product_sale_num) as product_sale_num,
sc_ID,
product_id,
product_name,
product_des,
product_code,
product_price,
product_price_discount,
product_price_discount_percent,
product_score
    FROM sale_list_cus2mer
    WHERE user_id="'.$_SESSION['user_id'].'"
    GROUP BY product_id
  ORDER BY sc_ID ASC
  ');

            $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
            return $encode_data;



            }





            public function Showlistorder($data)
                    {

              $query = $this->db->query('SELECT  sum(product_sale_num) as product_sale_num,
			  sc_ID,
              product_id,
              product_name,
              product_des,
              product_code,
              product_price,
              product_price_discount,
              product_price_discount_percent,
              product_score
                  FROM sale_list_cus2mer
                  WHERE user_id="'.$_SESSION['user_id'].'"
                  GROUP BY product_id
                ORDER BY sc_ID ASC
                ');

              $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
              return $encode_data;



              }

////////////////////////////////////////////////////////////



public function Saveshowcusnotsum($data)
        {

$data['owner_id'] = $_SESSION['owner_id'];
$data['user_id'] = $_SESSION['user_id'];
$data['store_id'] = $_SESSION['store_id'];
$data['adddate'] = time();
if ($this->db->insert("sale_list_cus2mer", $data)){


  $query = $this->db->query('SELECT  product_sale_num,
  sc_ID,
product_id,
  product_name,
  product_des,
  product_code,
  product_price,
  product_price_discount,
  product_price_discount_percent,
  product_score
      FROM sale_list_cus2mer
      WHERE user_id="'.$_SESSION['user_id'].'"
    ORDER BY sc_ID ASC
    ');

  $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
  return $encode_data;



    }





  }








  public function Delshowcusnotsum($data)
          {


$query = $this->db->query('DELETE FROM sale_list_cus2mer  WHERE sc_ID="'.$data['sc_ID'].'"');

$query = $this->db->query('SELECT  product_sale_num,
sc_ID,
product_id,
product_name,
product_des,
product_code,
product_price,
product_price_discount,
product_price_discount_percent,
product_score
FROM sale_list_cus2mer
WHERE user_id="'.$_SESSION['user_id'].'"
ORDER BY sc_ID ASC
');

    $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
    return $encode_data;



    }





    public function Showlistordernotsum($data)
            {

      $query = $this->db->query('SELECT  product_sale_num,
sc_ID,
      product_id,
      product_name,
      product_des,
      product_code,
      product_price,
      product_price_discount,
      product_price_discount_percent,
      product_score
          FROM sale_list_cus2mer
          WHERE user_id="'.$_SESSION['user_id'].'"
        ORDER BY sc_ID ASC
        ');

      $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
      return $encode_data;



      }





      public function Updateshowcusnotsum($data)
              {

  $this->db->query('UPDATE sale_list_cus2mer
  SET product_name="'.$data['product_name'].'",
  product_price="'.$data['product_price'].'"
  WHERE sc_ID="'.$data['sc_ID'].'"');



        $query = $this->db->query('SELECT  product_sale_num,
  sc_ID,
        product_id,
        product_name,
        product_des,
        product_code,
        product_price,
        product_price_discount,
        product_price_discount_percent,
        product_score
            FROM sale_list_cus2mer
            WHERE user_id="'.$_SESSION['user_id'].'"
          ORDER BY sc_ID ASC
          ');

        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
        return $encode_data;



        }











    }
