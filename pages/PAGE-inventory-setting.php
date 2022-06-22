<?php
// //UNIT OF MEASUREMENT LIST
// $_PMETA = ["load" => [
//   ["s", HOST_ASSETS."PAGE-unit.js", "defer"]
// ]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-3">INVENTORY SETTINGS</h3>
  <div class="bg-white zebra my-4">
    <div class="d-flex align-items-center border p-2">
      <div class="flex-grow-1">Unit of Measurement</div>
      <div>
        <button title="Edit" class="btn btn-primary btn-sm mi" onclick="location.href = '<?=HOST_BASE?>unit-list'">
        edit
        </button>
      </div>
    </div>
  </div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
