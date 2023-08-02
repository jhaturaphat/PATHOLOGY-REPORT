"use strict";
// แปลง html เป็นรูปภาพ png
document.getElementById('release').onclick = async function(){
    const screenshotTarget = document.getElementsByTagName('page');
    const inputele = document.getElementsByTagName('input');


    const hn = document.getElementById('hn');
    const watermark = document.getElementById('watermark');
    watermark.style.display = 'inline-block';
    hn.style.border = 'none';

    for(var i =0;i<inputele.length; i++){
        inputele[i].style.border = 'none';
    }
    
    for(var i=0; i<screenshotTarget.length; i++){       
      await convertpng(screenshotTarget[i]);
    }

    setTimeout(() => {
        watermark.style.display = 'none';
    }, 3000);
   
};

// html2canvas
async function convertpng(ele){
    await html2canvas(ele).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            console.log(imgData);
        });
}

// เมือลากเปลี่ยนขนาด textarea 
let resizeInt = null;
const diag = document.getElementById('diag');
var resizeEvent = function() {    
    console.log(diag.outerHeight);
    document.getElementById('text_dx').rows = '9';
};

diag.addEventListener("mousedown", function(e) {
    resizeInt = setInterval(resizeEvent, 1000/15);
    console.log(e);
});

$(window).on("mouseup", function(e) {
    if (resizeInt !== null) {
        clearInterval(resizeInt);
    }
    // resizeEvent();
});


