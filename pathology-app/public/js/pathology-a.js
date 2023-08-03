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
// เพิ่มหน้าสำหรับกรอกข้อมูล
const addpage = document.getElementById('add');
addpage.addEventListener("mouseup", function(){
    document.getElementById('blank_page').style.display = 'block';  
    this.style.display = "none"; 
    document.getElementById('del').style.display = 'block';
    setTimeout(() => {
        const page = document.querySelectorAll('page');
        for(let i = 0; i < page.length; i++){            
            if(page[i].style.display !== 'none'){                
                page[i].querySelector('.page-number').innerHTML = "".concat(i+1,'/',page.length);
            }
        }        
    }, 100);
});
// ลบหน้าที่เพิ่มมา
const delpage = document.getElementById('del');
delpage.addEventListener("mouseup", function(){
    const blank_page = document.getElementById('blank_page');    
    blank_page.classList.remove('animate__fadeInLeft');
    blank_page.classList.add('animate__backOutUp');
    setTimeout(() => {        
        blank_page.classList.remove('animate__backOutUp');
        blank_page.classList.add('animate__fadeInLeft');
        blank_page.style.display = 'none'; 
    }, 500);
    this.style.display = "none";     
    document.getElementById('add').style.display = 'block';
    setTimeout(() => {        
        const page = document.querySelectorAll('page');        
        let pn = 0;
        for(let i = 0; i < page.length; i++){ if(page[i].style.display !== 'none') pn++;}
        let pc = 1;
        for(let i = 0; i < page.length; i++){            
            if(page[i].style.display !== 'none'){     
                page[i].querySelector('.page-number').innerHTML = "".concat(pc,'/',pn);
                pc++; 
            }
        }        
    }, 600);
});


