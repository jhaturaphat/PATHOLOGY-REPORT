"use strict";

document.getElementById('release').onclick = async function(){
    const screenshotTarget = document.getElementsByTagName('page');
    const image1 = document.getElementById('image1');
    console.log('XXX', screenshotTarget[0]);
    // console.log(image1);
    

    const watermark = document.getElementById('watermark');
    watermark.style.display = 'inline-block';
    setTimeout(() => {
        watermark.style.display = 'none';
    }, 3000);
    

    for(var i=0; i<screenshotTarget.length; i++){       
      await convertpng(screenshotTarget[i]);
    }
   
};

async function convertpng(ele){
    await html2canvas(ele).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            console.log(imgData);
        });
}


