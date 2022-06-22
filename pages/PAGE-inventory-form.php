<?php
// (A) GET ITEM
$iv_unit = $_CORE->autoCall("Inventory", "getUnit");
$edit = isset($_POST["sku"]) && $_POST["sku"]!="";
if ($edit) {
  $item = $_CORE->autoCall("Inventory", "get");
}

// (B) ITEM FORM ?>
<style>
.profileimg {
    cursor: pointer;
    background-color: #0d6efd;
    color: #ffffff;
    padding: 10px 20px;
    border-color: #0d6efd;
    border-radius: .3rem;
  }

  #profileimg {
    opacity: 0;
    position: relative;
    z-index: 2;
  }
</style>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> ITEM</h3>

<form onsubmit="return inv.save()">
  <div class="bg-white border p-4 mb-3">
    <div class="center input-group mb-3">
      <div class="input-group-prepend">
        <label for="profileimg" class="profileimg" style="position: absolute; right: 0; top: 75%;">Upload Product Picture</label>
        <img style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;" id="preview" class="img-thumbnail" src="<?= $item['stock_pic'] ? './images/product/' . $item['stock_pic'] : './images/product/default-product.png' ?>" alt="event-thumbnail" />
        <input type="file" name="profileimg" id="profileimg" hidden accept="image/png, image/jpeg" onclick="inv.fileUpload()" />
        <input type="text" name="prevFile" id="prevFile" hidden value="<?= $edit ? $item['stock_pic'] : 'default-product.png' ?>"/>
      </div>
    </div>

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

    <div class="input-group mb-3">
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

  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</form>
