<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salepic extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('sale/salepage_model');

     if(!isset($_SESSION['user_type'])){
            header( "location: ".$this->base_url );
        }

    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{


$data['tab'] = 'salepic';
$data['title'] = 'Sale Pic';
		$this->deshboardlayout('sale/salepic',$data);
}


 function Getproduct()
    {

$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}
echo  $this->salepage_model->Getproduct($data);

}



function Getproductlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Getproductlist($data);

	}





    function Showmoneychange()
        {

    $data = json_decode(file_get_contents("php://input"),true);
    echo  $this->salepage_model->Showmoneychange($data);

    	}




        function Saveshowcus()
            {

        $data = json_decode(file_get_contents("php://input"),true);
        //echo  $this->salepage_model->Saveshowcus($data);
echo  $this->salepage_model->Saveshowcusnotsum($data);
        	}



    function Delshowcus()
        {

    $data = json_decode(file_get_contents("php://input"),true);
    //echo  $this->salepage_model->Delshowcus($data);
  echo  $this->salepage_model->Delshowcusnotsum($data);
      }








      function Openbillclosedaylista()
          {

      $data = json_decode(file_get_contents("php://input"),true);
      echo  $this->salepage_model->Openbillclosedaylista($data);

      	}

      	function Openbillclosedaylistb()
          {

      $data = json_decode(file_get_contents("php://input"),true);
      echo  $this->salepage_model->Openbillclosedaylistb($data);

      	}

      	function Openbillclosedaylistc()
          {

      $data = json_decode(file_get_contents("php://input"),true);
      echo  $this->salepage_model->Openbillclosedaylistc($data);

      	}



        function Openbillclosedaylistproduct()
          {

        $data = json_decode(file_get_contents("php://input"),true);
        echo  $this->salepage_model->Openbillclosedaylistproduct($data);

        }







      function Updateshowcus()
          {

      $data = json_decode(file_get_contents("php://input"),true);
      //echo  $this->salepage_model-> Updateshowcus($data);
      echo  $this->salepage_model-> Updateshowcusnotsum($data);
        }






      function Showlistorder()
          {

      $data = json_decode(file_get_contents("php://input"),true);
    //  echo  $this->salepage_model->Showlistorder($data);
    echo  $this->salepage_model->Showlistordernotsum($data);

        }







        function Openshiftnow()
            {

        $data = json_decode(file_get_contents("php://input"),true);
        echo  $this->salepage_model->Openshiftnow($data);

        	}


          function Closeshiftnowconfirm()
                {

            $data = json_decode(file_get_contents("php://input"),true);
            echo  $this->salepage_model->Closeshiftnowconfirm($data);

            	}







	function Getproductlistcat()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Getproductlistcat($data);

	}



function Searchproductlist()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Searchproductlist($data);

	}



	function Findproduct()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Findproduct($data);

	}


function Addproductranksave()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Addproductranksave($data);

	}


	function Delproductranksave()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Delproductranksave($data);

	}




function Customer()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Customer($data);

	}


	function Gettoday()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->salepage_model->Gettoday($data);

	}


function Savesale()
    {

$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

$header_code = time();

for($i=1;$i<=count($data['listsale']) ;$i++){


$data['sale_runno'] = $header_code;
$data['adddate'] = $header_code;

	if($data['listsale'][$i-1]['product_id']!='' && $data['listsale'][$i-1]['product_sale_num']!='0'){
$data['listsale'][$i-1]['sale_runno'] = $header_code;
$data['listsale'][$i-1]['adddate'] = $header_code;

if($this->salepage_model->Adddetail($data['listsale'][$i-1])){
	$this->salepage_model->Updateproductdeletestock($data['listsale'][$i-1]);
}




if($i==1){
$this->salepage_model->Addheader($data);

}

}

}



	}


	}
