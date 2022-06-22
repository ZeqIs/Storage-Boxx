<?php
// GET UNIT OF MEASUREMENT
$unit = $_CORE->autoCall("Inventory", "getUnit");

//UNIT OF MEASUREMENT LIST
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-unit.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B) NAVIGATION -->
<nav class="d-flex align-items-center">
  <div class="flex-grow-1">
    <h3 class="text-uppercase">Unit of Measurement</h3>
  </div>
  <button class="btn btn-success mi me-1" onclick="unit.addEdit()">
    add
  </button>
  <button class="btn btn-danger mi" onclick="location.href = '<?=HOST_BASE?>inventory-setting'">
    undo
  </button>
</nav>

<?php if(is_array($unit)) {?>
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Code</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php if (is_array($unit)) { foreach ($unit as $u) { ?>
      <tr>
        <td><?=$u["id"]?></td>
        <td><?=$u["code"]?></td>
        <td><?=$u["description"]?></td>
        <td>
            <button title="Edit" class="btn btn-primary btn-sm mi" onclick="unit.addEdit('<?=$u?>')">
                edit
            </button>
            <button title="Delete" class="btn btn-danger btn-sm mi" onclick="uom.del('<?=$u['description']?>')">
                delete
            </button>
        </td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
<?php } else {?>
  <div class="d-flex align-items-center border p-2">No unit of measurement.</div>
<?php } ?>
<?php
require PATH_PAGES . "TEMPLATE-bottom.php";


