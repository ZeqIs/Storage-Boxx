<?php
// (A) GET USERS
$users = $_CORE->autoCall("Users", "getAll");

// (B) DRAW USERS LIST
if (is_array($users["data"])) {
  foreach ($users["data"] as $id => $u) { ?>
    <div class="d-flex align-items-center border p-2">
      <div class="p-2" style="max-width: 100px;">
          <img style="border-radius: 5px; border: 1px solid black;" alt="event-thumbnail" src="<?= $u['user_profilepic'] ? './images/profileimg/'.$u['user_profilepic'] : './images/profileimg/default.png' ?>" loading="lazy" width="64" height="64" />
      </div>
      <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
        <strong>Username: </strong><?= $u["user_name"] ?>
      </div>
      <div class="p-2 flex-fill">
        <strong>Email: </strong> <?= $u["user_email"] ?>
      </div>
      <div class="p-2" style="flex-basis: 300px; flex-grow: 0; flex-shrink: 0;">
        <strong>Role: </strong><?= $u["user_role"] ?>
      </div>
      <div class="p-2" style="flex-basis: 200px; flex-grow: 0; flex-shrink: 0;">
      <button class="btn btn-danger btn-sm mi" onclick="usr.del(<?= $id ?>)">
        delete
      </button>
      <button class="btn btn-primary btn-sm mi" onclick="usr.addEdit(<?= $id ?>)">
        edit
      </button>
      </div>
    </div>
  <?php }
} else { ?>
  <div class="d-flex align-items-center border p-2">No users found.</div>
<?php }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($users["page"], "usr.goToPage");
