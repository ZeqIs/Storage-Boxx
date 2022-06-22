<?php
// (A) GET ITEM
$edit = isset($_POST["sku"]) && $_POST["sku"]!="";
if ($edit) {
  $item = $_CORE->autoCall("Inventory", "get");
}
require PATH_PAGES . "TEMPLATE-top.php";
// (B) ITEM FORM ?>
<div id="divToPrint">
<style>
  #qrcode img {
  width : 316px;
  height : 316px;
  margin-left: auto;
  margin-right: auto;
  display: block;
}
</style>
<h3 class="mb-3"><strong>STOCK DETAILS</strong></h3>
  <div class="bg-white border p-4 mb-3">
          <!-- <center><img src="'.$file.'"></center> -->
          <div class="table-responsive">  
            <table class="table table-bordered">
            <tr>  
                <td><label>Stock SKU</label></td>  
                <td><b><?=$_GET["sku"]?></b></td> 
                <td><label>Name</label></td>  
                <td><b><?=$_GET["name"]?></b></td>   
            </tr>  
            <tr>  
                <td><label>Quantity</label></td>  
                <td><b><?=$_GET["qty"]?></b></td> 
                <td><label>Description</label></td>  
                <td><b><?=$_GET["desc"]?></b></td>  
            </tr>   
            <tr>  
                <td><label>Unit</label></td>  
                <td><b><?=$_GET["unit"]?></b></td> 
                <td><label>Cost</label></td>  
                <td><b><?=$_GET["cost"]?></b></td>  
            </tr> 
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <tr>  
                  <td><label>QR Code</label></td>  
              </tr>
              <tr>  
                  <td id="qrcode"></td>
              </tr>
            </table>
          </div>
  </div>
</div>
    <input type="submit" class="col btn btn-primary btn-lg"  onclick="printContent('divToPrint')" value="Print"/>
    
  <script src="<?=HOST_ASSETS?>qrcode.min.js"></script>
  <script>
    new QRCode(document.getElementById("qrcode"), "<?=$_GET["sku"]?>");
  </script>
  <script>
    function printContent(id){
      var printcontent = document.getElementById(id).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      window.close();
    }
  </script>

