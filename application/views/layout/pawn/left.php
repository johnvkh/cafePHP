
<style type="text/css">
	.nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: #fff;
    background-color: #000;
}
a{
	color: #000000;
}
</style>
<div class="col-md-2 col-sm-3">
	

	<div class="panel panel-default">
		<div class="panel-body">
		
		<ul class="nav nav-pills">	
<li style="width: 100%;" <?php if($tab == 'pawnlist'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/pawn/pawnlist">
<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
ຮັບຝາກ/ຕໍ່ດອກ </a></li>

	
<li style="width: 100%;" <?php if($tab == 'pawnenddate'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/pawn/pawnenddate">
<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
ເລີຍກໍານົດ </a></li>



<li style="width: 100%;" <?php if($tab == 'pawnreport'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/pawn/pawnreport">
<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
ລາຍງານຍອດທັ້ງໝົດ </a></li>

	
</ul>


		</div>
	</div>


	<!-- <div class="panel panel-default">
		<div class="panel-body">


<ul class="nav nav-pills">	
<li style="width: 100%;" <?php if($tab == 'showproduct'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/warehouse/showproduct">
<span class="glyphicon glyphicon-link" aria-hidden="true"></span>
<?=$lang_productpagepic?> </a></li>

	
</ul>


</div>
	</div> -->


	</div>


