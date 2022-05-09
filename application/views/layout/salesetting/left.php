
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
		
	
		<ul class="nav nav-pills nav-sidebar">	


<li style="width: 100%;" <?php if($tab === 'discount'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/salesetting/discount"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> <?=$lang_settingdiscount?> </a></li>

<li style="width: 100%;" <?php if($tab === 'pricebycus'){ echo 'class="active"';} ?> ><a href="<?php echo $base_url; ?>/salesetting/pricebycus"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?=$lang_settingpricecus?> </a></li>



</ul>




</div>

</div>










</div>