const Utils = {
    DDMMYYYY: function(val = ""){
        const items = val.split("-");
        return items[2]+"-"+items[1]+"-"+items[0];
    }
};
