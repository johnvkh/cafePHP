<?php
if ($_SESSION['user_type'] == '1') {
    echo '<script>
window.location = "' . $base_url . '/sale/salepic";
	</script>';
}
?>
<?php
if ($_SESSION['user_type'] == '2') {
    echo '<script>
window.location = "' . $base_url . '/warehouse/productlist";
	</script>';
}
?>
<style type="text/css">
    body{
        font-family: Defago Noto Sans;
        background-color: #eee;
    }
    @font-face {
        font-family: Defago Noto Sans;
        src: url("../fonts/Defago Noto Sans Lao v2.3.ttf");
    }
</style>
<div class="container text-center">
    <div class="col-md-12">
        <div class="col-md-7">
            <div class="col-md-6">
                <a style="text-decoration:none" href="<?php echo $base_url; ?>/sale/salereportshift" title="ຄິກເພ້ອເບີ່ງຍອດຂາຍຕາມກະ">
                    <div class="panel" style="height: 240px;background-color: rgba(0,0,0,.5);color: #fff;">
                        <br />
                        <b>ຍອດຂາຍກະທີ <?php
                            if (isset($_SESSION['shift_id'])) {
                                echo number_format($_SESSION['shift_id']);
                            } else {
                                echo '(ຍັງບໍ່ໄດ້ເປີດກະ)';
                            }
                            ?></b>
                        <br />
                        <?php
                        foreach ($saletoday as $key => $value) {
                            echo '<h3>' . $lang_qty . ': <b>' . number_format($value['sumnum']) . '</b>';
                            echo '<br /><br />';
                            echo '' . $lang_income . ':<b> ' . number_format($value['sumprice'] - $value['sumdiscount'], 2) . '</b></h3>';
                        }
                        ?>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a style="text-decoration:none" href="<?php echo $base_url; ?>/sale/salereport" title="ຄິກເພື່ອເບີ່ງ ສິນຄ້າຂາຍດີ">
                    <div class="panel" style="text-align: left;height: 240px;background-color: rgba(0,0,0,.5);color: #fff;">
                        <br />
                        <center><b>ຂາຍດີກະທີ່ <?php
                                if (isset($_SESSION['shift_id'])) {
                                    echo number_format($_SESSION['shift_id']);
                                } else {
                                    echo '(ຍັງບໍ່ໄດ້ເປີດກະ)';
                                }
                                ?></b>
                            <table width="90%">
                                <?php
                                $i = 1;
                                foreach ($productsaletoday as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $i . '. ' . mb_substr($value['product_name'], 0, 20, 'UTF-8') . '.</td><td align="right">' . number_format($value['product_numall']) . '</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                                ?>
                            </table>

                        </center>

                    </div>
                </a>
            </div>
            <!-- <div class="col-md-4">
            <a href="<?php echo $base_url; ?>/sale/salecustomerreport" title="คลิกเพื่อดู ลูกค้าซื้อดี">
            <div class="panel"  style="text-align: left;height: 240px;background-color: rgba(0,0,0,.5);color: #fff;">
            <br />
            <center><b><?= $lang_cussaletoday ?></b></center>
            <table width="100%">
            <?php
            $i = 1;
            foreach ($customersaletoday as $key => $value) {
                echo '<tr>';
                echo '<td>' . $i . '. ' . $value['name'] . '</td><td align="right">' . number_format($value['sumsale_num']) . '</td>';
                echo '</tr>';

                $i++;
            }
            ?>
             </table>
            </div>
            </a>
            </div> -->
            <div class="col-md-12">
                <a style="text-decoration:none" href="<?php echo $base_url; ?>/warehouse/stock" title="ຄິກເພື່ອເບີ່ງສິນຄ້າ stock">
                    <div class="panel"  style="text-align: left;height: 240px;background-color: rgba(0,0,0,.5);color: #fff;">
                        <br />
                        <center><b>ສິນຄ້າສະຕັອກ</b>
                            <table width="90%">
                                <?php
                                $i = 1;
                                foreach ($productoutofstock as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $i . '. ' . mb_substr($value['product_name'], 0, 20, 'UTF-8') . '.</td><td align="right">' . number_format($value['product_stock_num']) . '</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                                ?>
                            </table>

                        </center>

                    </div>
                </a>
            </div>

            <!--
            <div class="col-md-6">
            <a style="text-decoration:none" href="<?php echo $base_url; ?>/pawn/pawnenddate" title="คลิกเพื่อดู สินค้ารับฝากเลยกำหนด ทั้งหมด">
            <div class="panel"  style="text-align: left;height: 280px;background-color: rgba(0,0,0,.5);color: #fff;">
            <br />
            <center><b>สินค้ารับฝากเลยกำหนด</b>
            <table width="90%">
            
            <?php
            $i = 1;
            foreach ($productpawnenddate as $key => $value) {
                echo '<tr>';
                echo '<td>' . $i . '. ' . mb_substr($value['product_name'], 0, 17, 'UTF-8') . '.</td><td align="right">' . $value['end_date_date'] . '</td>';
                echo '</tr>';

                $i++;
            }
            ?>
             </table>
            
             </center>
            </div>
            </a>
            </div> -->
        </div>
        <div class="col-md-5">
            <a href="<?php echo $base_url; ?>/sale/salepic" class="btn btn-warning"  style="font-size: 18px;font-weight: bold; width: 340px;">
                <span class="glyphicon glyphicon-blackboard" aria-hidden="true" style="font-size: 50px;"></span><br />
                ໜ້າຕາງຂາຍກະເຟ
            </a>
<!-- <a href="<?php echo $base_url; ?>/sale/salepage" class="btn btn-warning"  style="font-size: 18px;font-weight: bold; width: 170px;">
<span class="glyphicon glyphicon-record" aria-hidden="true" style="font-size: 50px;"></span><br /> <?= $lang_salelist ?>
</a> -->
<!-- <p></p>
        <a href="<?php echo $base_url; ?>/sale/salebill" class="btn btn-warning"  style="font-size: 18px;font-weight: bold;width: 170px;">
<span class="glyphicon glyphicon-align-justify" aria-hidden="true" style="font-size: 50px;"></span><br />
            <?= $lang_billreserv ?>
</a>
<a href="<?php echo $base_url; ?>/sale/product_return" class="btn btn-warning"  style="font-size: 18px;font-weight: bold; width: 170px;">
<span class="glyphicon glyphicon-refresh" aria-hidden="true" style="font-size: 50px;"></span><br /> <?= $lang_returnproduct ?>
</a> -->
            <p></p>
            <!--<a href="<?php echo $base_url; ?>/pawn/pawnlist" class="btn btn-warning"  style="font-size: 18px;font-weight: bold;width: 170px;">
                <span class="glyphicon glyphicon-list" aria-hidden="true" style="font-size: 50px;"></span><br />
                รับฝาก
            </a> -->
            <a href="<?php echo $base_url; ?>/warehouse/productlist" class="btn btn-warning"  style="font-size: 18px;font-weight: bold;width: 170px;">
                <span class="glyphicon glyphicon-home" aria-hidden="true" style="font-size: 50px;"></span><br />
                ກາເຟ/ເຂົ້າໜົມ
            </a>
            <a href="<?php echo $base_url; ?>/mycustomer" class="btn btn-warning" style="font-size: 18px;font-weight: bold; width: 170px;">
                <span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 50px;"></span><br /> ລູກຄ້າ
            </a>
            <p></p>
            <a href="<?php echo $base_url; ?>/sale/salelist" class="btn btn-default"  style="font-size: 18px;font-weight: bold; width: 170px;">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="font-size: 50px;"></span><br />
                ລາຍງານການຂາຍ
            </a>
            <a href="<?php echo $base_url; ?>/printer/printercategory" class="btn btn-default"  style="font-size: 18px;font-weight: bold; width: 170px;">
                <span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 50px;"></span><br /> ເຄື່ອງປິ້ນ
            </a>
            <p></p>
            <a href="<?php echo $base_url; ?>/salesetting/discount" class="btn btn-default"  style="font-size: 18px;font-weight: bold; width: 170px;">
                <span class="glyphicon glyphicon-cog" aria-hidden="true" style="font-size: 50px;"></span><br /> <?= $lang_salesetting ?>
            </a>

            <a href="<?php echo $base_url; ?>/storemanager/user_owner" class="btn btn-default"  style="font-size: 18px;font-weight: bold; width: 170px;">
                <span class="glyphicon glyphicon-cog" aria-hidden="true" style="font-size: 50px;"></span><br /> ພະນັກງານ/ຮ້ານ
            </a>
            <p></p>
<!-- <a href="<?php echo $base_url; ?>/marketing/email" class="btn btn-default"  style="font-size: 15px;font-weight: bold; width: 150px;" >
<span class="glyphicon glyphicon-envelope" aria-hidden="true" style="font-size: 50px;"></span><br /> <?= $lang_emailmarketting ?>
</a> -->
            <p></p>
            <a class="btn btn-default btn-lg" href="<?php echo $base_url; ?>/home/showcus2mer" target="_blank"   style="font-size: 18px;font-weight: bold; width: 340px;">
                <span class="glyphicon glyphicon-blackboard" aria-hidden="true" style="font-size: 30px;"></span><br />
                ໜ້າຈໍາສໍາລັບລູກຄ້າ</a>
        </div>
    </div>
</div>
