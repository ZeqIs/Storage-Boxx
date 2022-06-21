<?php
// (A) GET ITEM
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

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text mi">attach_money</span>
      </div>
      <input type="number" id="inv-cost" class="form-control" value="<?=$edit?$item["stock_cost"]:""?>" placeholder="Cost (RM per piece)"/>
    </div>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text mi">straighten</span>
      </div>
      <input type="text" class="form-control" id="inv-unit" required value="<?=$edit?$item["stock_unit"]:""?>" placeholder="Unit of Measurement"/>
    </div>
    <div class="p-1">
      <span onclick="inv.unit('PC')">[PC]</span>
      <span onclick="inv.unit('EA')">[EA]</span>
      <span onclick="inv.unit('BX')">[BX]</span>
      <span onclick="inv.unit('CS')">[CS]</span>
      <span onclick="inv.unit('PL')">[PL]</span>
    </div>
  </div>

  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</form>
