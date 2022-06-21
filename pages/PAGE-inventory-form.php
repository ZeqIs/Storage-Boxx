<?php
// (A) GET ITEM
$iv_unit = $_CORE->autoCall("Inventory", "getUnit");
$edit = isset($_POST["sku"]) && $_POST["sku"]!="";
if ($edit) {
  $item = $_CORE->autoCall("Inventory", "get");
}

// (B) ITEM FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> ITEM</h3>

<form onsubmit="return inv.save()">
  <div class="bg-white border p-4 mb-3">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text mi">qr_code</span>
      </div>
      <input type="hidden" id="inv-osku" value="<?=$edit?$item["stock_sku"]:""?>"/>
      <input type="text" class="form-control" id="inv-sku" required value="<?=$edit?$item["stock_sku"]:""?>" placeholder="SKU"/>
    </div>
    <div class="p-1 mb-3" onclick="inv.randomSKU()">[Random SKU]</div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text mi">inventory_2</span>
      </div>
      <input type="text" id="inv-name" class="form-control" required value="<?=$edit?$item["stock_name"]:""?>" placeholder="Item Name"/>
    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text mi">description</span>
      </div>
      <input type="text" id="inv-desc" class="form-control" value="<?=$edit?$item["stock_desc"]:""?>" placeholder="Description"/>
    </div>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text mi">straighten</span>
      </div>
      <select class="form-control" style="border-color: #CED4F4; background-color: #ffffff;" id="inv-unit" required>
        <option value ="">Unit of Measurement</option>
        <?php foreach($iv_unit as $unit){
          if($edit && ($item["stock_unit"]==$unit["code"])){
            echo '<option value="'.$unit['code'].'" selected>'.$unit['description'].' ['.$unit['code'].']</option>';  
          }else{
            echo '<option value="'.$unit['code'].'">'.$unit['description'].' ['.$unit['code'].']</option>';
          }
        } 
        ?> 
      </select>
    </div>
  </div>

  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</form>
