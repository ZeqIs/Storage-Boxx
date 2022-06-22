var inv = {
  // (A) LIST () : SHOW ALL ITEMS
  pg : 1, // CURRENT PAGE
  find : "", // CURRENT SEARCH
  list : () => {
    cb.page(1);
    cb.load({
      page : "inventory/list",
      target : "inv-list",
      data : {
        page : inv.pg,
        search : inv.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : page number
  goToPage : (pg) => { if (pg!=inv.pg) {
    inv.pg = pg;
    inv.list();
  }},

  // (C) SEARCH INVENTORY
  search : () => {
    inv.find = document.getElementById("inv-search").value;
    inv.pg = 1;
    inv.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // sku : item SKU, for edit only
  addEdit : (sku) => {
    cb.load({
      page : "inventory/form",
      target : "cb-page-2",
      data : { sku : sku ? sku : "" },
      onload : () => { cb.page(2); }
    });
  },

  // (E) RANDOM SKU
  // Credits : https://stackoverflow.com/questions/1349404/generate-random-string-characters-in-javascript
  randomSKU : () => {
    let length = 8, // SET YOUR OWN
        result = "",
        char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
        clength = char.length;
    for (let i=0; i<length; i++) {
      result += char.charAt(Math.floor(Math.random() * clength));
    }
    document.getElementById("inv-sku").value = result;
  },

  // (F) SET UNIT OF MEASUREMENT
  unit : (u) => {
    document.getElementById("inv-unit").value = u;
  },

  fileUpload: () => {
    inv.imageName = "";
    var fileInput = document.querySelector("#profileimg");
    var prevFile = document.querySelector("#prevFile");
    inv.imageName = prevFile.value;
    console.log(prevFile.value, inv.imageName);
    fileInput.addEventListener("change", function (e) {
      inv.upload = true;
      inv.imageName = e.target.files[0].name;
      const reader = new FileReader();
      reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        inv.imageURL = reader.result.split(",");
        document.querySelector("#preview").src = uploaded_image;
      });
      reader.readAsDataURL(this.files[0]);
    });
  },

  // (G) SAVE ITEM
  save : () => {
    // (G1) GET DATA
    var data = {
      sku : document.getElementById("inv-sku").value,
      name : document.getElementById("inv-name").value,
      unit : document.getElementById("inv-unit").value,
      desc : document.getElementById("inv-desc").value,
      cost : document.getElementById("inv-cost").value,
      image: inv.upload ? inv.imageURL[1] : "",
      imageName: inv.upload
        ? inv.imageName
        : document.getElementById("prevFile").value,
      upload: inv.upload,
    };
    var osku = document.getElementById("inv-osku").value;
    if (osku!="") { data.osku = osku; }

    // (G2) AJAX
    cb.api({
      mod : "inventory",
      req : "save",
      data : data,
      passmsg : "Item saved",
      onpass : inv.list
    });
    return false;
  },

  // (H) DELETE ITEM
  //  sku : item SKU
  //  confirm : boolean, confirmed delete
  del : (sku, confirm) => {
    if (confirm) {
      cb.api({
        mod : "inventory",
        req : "del",
        data : { sku : sku },
        passmsg : "Item Deleted",
        onpass : inv.list
      });
    } else {
      cb.modal("Please confirm", `Delete ${sku}? All movement history will be lost!`, () => {
        inv.del(sku, true);
      });
    }
  },

  // (I) GENERATE QR CODE
  qrcode : (sku, name, desc, unit, qty, cost) => {
    window.open(cbhost.base + "qrcode/?sku="+sku + "&name="+name + "&desc="+desc + "&unit="+unit + "&qty="+qty + "&cost="+cost);
  }
};
window.addEventListener("load", inv.list);
