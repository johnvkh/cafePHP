<br />
<div class="text-center" style="color: #fff;">
    Support: <a style="color: #fff;" href="https://www.facebook.com/indeeSoftware" target="_blank">
        indeeSoftware.website
    </a> 
</div>

<?php
$modal_enddate = '
<div class="modal fade" id="modal-enddate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-left">
				
				<h4 class="modal-title">หมดอายุการใช้งาน</h4>
			</div>
			<div class="modal-body">
<center>
<h2>
การใช้งานของคุณหมดอายุแล้ว 
			<br /><br />
			กรุณาต่ออายุ เพื่อใช้งาน 
			<br /><br />
			 <a class="btn btn-success btn-lg" target="_blank" href="http://facebook.com/cus2merpage"> ติดต่อผู้ให้บริการ</a>
			 </h2>
			<hr />
			 <br />
			<a href="' . $base_url . '/logout"> ออกจากระบบ</a>
			</center>	
		</div>
			</div>
		</div>
	</div></div>
<script>
$("#modal-enddate").modal({backdrop: "static", keyboard: false});
</script>

';

if (time() > strtotime($_SESSION['owner_end_time'])) {
    //echo $modal_enddate;
}
?>

<script src="<?php echo $base_url; ?>/js/excel-export.js"></script>
</body>
</html>

<?php
if (!isset($_SERVER["HTTP_REFERER"])) {
    echo '<script>
window.location = "' . $base_url . '";
	</script>';
}
?>

<style type="text/css">
    body{
        font-family: Defago Noto Sans;
        background-image: url("<?php echo $base_url . '/' . $_SESSION['owner_bgimg']; ?>");
        background-color: #f5f5f5;
    }
    @font-face {
        font-family: Defago Noto Sans;
        src: url("../fonts/Defago Noto Sans Lao v2.3.ttf");
    }
</style>