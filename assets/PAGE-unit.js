var uom = {
    // (A) LIST () : SHOW ALL ITEMS
    pg : 1, // CURRENT PAGE
    find : "", // CURRENT SEARCH
    list : () => {
        cb.page(1);
        cb.load({
        page : "unit/list",
        target : "cb-page-2",
        data : {
            page : uom.pg,
            search : uom.find
        }
        });
    },
  
    // (H) DELETE ITEM
    //  sku : unit description
    //  confirm : boolean, confirmed delete
    del : (unit, confirm) => {
        if (confirm) {
        cb.api({
            mod : "inventory",
            req : "del",
            data : {sku : unit},
            passmsg : "Item Deleted",
            onpass : uom.list
        });
        } else {
        cb.modal("Please confirm", `Delete Unit: ${unit}?`, () => {
            uom.del(unit, true);
        });
        }
    },
  };
  window.addEventListener("load", uom.list);