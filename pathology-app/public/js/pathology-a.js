"use strict";

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

async function convertpng(ele){
    await html2canvas(ele).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            console.log(imgData);
        });
}


