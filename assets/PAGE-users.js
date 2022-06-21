var usr = {
  // (A) SHOW ALL USERS
  pg: 1, // CURRENT PAGE
  find: "", // CURRENT SEARCH
  imageURL: "",
  imageName: "",
  upload: false,
  list: () => {
    cb.page(1);
    cb.load({
      page: "users/list",
      target: "user-list",
      data: {
        page: usr.pg,
        search: usr.find,
      },
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage: (pg) => {
    if (pg != usr.pg) {
      usr.pg = pg;
      usr.list();
    }
  },

  // (C) SEARCH USER
  search: () => {
    usr.find = document.getElementById("user-search").value;
    usr.pg = 1;
    usr.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : user ID, for edit only
  addEdit: (id) => {
    cb.load({
      page: "users/form",
      target: "cb-page-2",
      data: { id: id ? id : "" },
      onload: () => {
        cb.page(2);
      },
    });
  },

  fileUpload: () => {
    usr.imageName = "";
    var fileInput = document.querySelector("#profileimg");
    var prevFile = document.querySelector("#prevFile");
    usr.imageName = prevFile.value;
    console.log(prevFile.value, usr.imageName);
    fileInput.addEventListener("change", function (e) {
      usr.upload = true;
      usr.imageName = e.target.files[0].name;
      const reader = new FileReader();
      reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        usr.imageURL = reader.result.split(",");
        document.querySelector("#preview").src = uploaded_image;
      });
      reader.readAsDataURL(this.files[0]);
    });
  },

  // (E) SAVE USER
  save: () => {
    // (E1) GET DATA\

    var data = {
      name: document.getElementById("user_name").value,
      email: document.getElementById("user_email").value,
role: document.getElementById("user_role").value,
      password: document.getElementById("user_password").value,
      image: usr.upload ? usr.imageURL[1] : "",
      imageName: usr.upload
        ? usr.imageName
        : document.getElementById("prevFile").value,
      upload: usr.upload,
    };
    var id = document.getElementById("user_id").value;
    if (id != "") {
      data.id = id;
    }

    // (E2) PASSWORD STRENGTH
    var confPass = document.getElementById("confirm_password").value;
    var password = document.getElementById("user_password").value;
    if (!cb.checker(data.password)) {
      cb.modal("Error", "Password must be at least 8 characters alphanumeric");
      return false;
    } else if(confPass !== password){
      cb.modal("Error", "Password and Confirm Password did not match");
      return false;
    }

    // (E3) AJAX
    cb.api({
      mod: "users",
      req: "save",
      data: data,
      passmsg: "User Saved",
      onpass: usr.list,
    });
    return false;
  },

  // (F) DELETE USER
  //  id : int, user ID
  //  confirm : boolean, confirmed delete
  del: (id, confirm) => {
    if (confirm) {
      cb.api({
        mod: "users",
        req: "del",
        data: { id: id },
        passmsg: "User Deleted",
        onpass: usr.list,
      });
    } else {
      cb.modal("Please confirm", "Delete user?", () => {
        usr.del(id, true);
      });
    }
  },
};
window.addEventListener("load", usr.list);