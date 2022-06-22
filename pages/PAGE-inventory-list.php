<?php
// (A) GET ITEMS
$items = $_CORE->autoCall("Inventory", "getAll");

// (B) DRAW ITEMS LIST
if (is_array($items["data"])) { foreach ($items["data"] as $sku=>$i) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="p-2" style="max-width: 100px;">
    <img style="border-radius: 5px; border: 1px solid black;" alt="event-thumbnail" src="<?= $i['stock_pic'] ? './images/product/'.$i['stock_pic'] : './images/product/default-product.png' ?>" loading="lazy" width="64" height="64" />
  </div>
  <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
    <strong>SKU: </strong> <?=$sku?>
  </div>
  <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
    <strong>Name: </strong> <?=$i["stock_name"]?><br>
    <strong>Description: </strong><?=$i["stock_desc"]?>
  </div>
  <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
    <strong>Quantity: </strong><?=$i["stock_qty"]?>
  </div>
  <div class="p-2 flex-fill">
    <strong>Unit: </strong> <?=$i["stock_unit"]?>
  </div>
  <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
    <strong>Cost: </strong> RM<?=$i["stock_cost"]?>
  </div>
  <div class="p-2 flex-fill ">
    <button title="Delete" class="btn btn-danger btn-sm mi" onclick="inv.del('<?=$sku?>')">
      delete
    </button>
    <button title="Edit" class="btn btn-primary btn-sm mi" onclick="inv.addEdit('<?=$sku?>')">
      edit
    </button>
    <button title="QR Code" class="btn btn-primary btn-sm mi" onclick="inv.qrcode('<?=$sku?>', '<?=$i['stock_name']?>','<?=$i['stock_desc']?>', '<?=$i['stock_unit']?>', '<?=$i['stock_qty']?>', '<?=$i['stock_cost']?>')">
      qr_code
    </button>
    <button title="History" class="btn btn-warning btn-sm mi" onclick="check.load('<?=$sku?>')">
      history
    </button>
  </div>
</div>
<?php }} else { ?>
<div class="d-flex align-items-center border p-2">No items found.</div>
<?php }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($items["page"], "inv.goToPage");
