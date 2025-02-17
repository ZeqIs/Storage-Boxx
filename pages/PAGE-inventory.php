<?php
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-inventory.js", "defer"],
  ["s", HOST_ASSETS."PAGE-checker.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HEADER -->
<h3 class="mb-3">MANAGE INVENTORY</h3>

<!-- (B) SEARCH BAR -->
<form class="d-flex align-items-stretch bg-white border mb-3 p-2" onsubmit="return inv.search()">
  <input type="text" id="inv-search" placeholder="Search" class="form-control form-control-sm"/>
  <button class="btn btn-primary mi me-1">
    search
  </button>
  <button class="btn btn-success mi" onclick="inv.addEdit()">
    add
  </button>
</form>

<!-- (BC) INVENTORY LIST -->
<div id="inv-list" class="bg-white zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
