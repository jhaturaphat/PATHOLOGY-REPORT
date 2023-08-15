"use strict";
// import { Utils } from "./utils.js";
// แปลง html เป็นรูปภาพ png
let pngObj = [];
document.getElementById('release').onclick = async function(){
    pngObj = [];
    const screenshotTarget = document.getElementsByTagName('page');
    const inputele = document.getElementsByTagName('input');

    const hn = document.getElementById('hn');  
    hn.style.border = 'none';  
    screenshotTarget[0].style.boxShadow = 'none';    
    
    

    for(var i =0;i<inputele.length; i++){
        inputele[i].style.border = 'none';
    }
    
    for(var i=0; i<screenshotTarget.length; i++){ 
        if(window.getComputedStyle(screenshotTarget[i]).display !== 'none'){
            screenshotTarget[i].style.boxShadow = 'none';
            screenshotTarget[i].classList.remove('animate__animated');      
            await convertpng(screenshotTarget[i]); //แปลงรูปภาพ
            screenshotTarget[i].classList.add('animate__animated');
            screenshotTarget[i].style.boxShadow = '0 0 0.5cm rgba(0,0,0,0.5)';
        }      
    }
    // console.log(pngObj);

    setTimeout(() => {
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
        $.ajax({
            type: "POST",
            dataType: 'json',            
            url: '/pathology-a',
            data: {item: JSON.stringify(lab_order), report: JSON.stringify(pngObj)},
            success: function(data, textStatus,jqXHR){
                console.log(data);
            }            
          });
    }, 100);
   
};

// html2canvas
async function convertpng(ele){
    //scale: 2 ทำให้ภาพชัดขึ้นเวลาขยายรูป
    await html2canvas(ele,{scale: 2}).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            pngObj.push(imgData);
        });
}

// เมือลากเปลี่ยนขนาด textarea 
// let resizeInt = null;
// const diag = document.getElementById('diag');
// var resizeEvent = function() {    
//     console.log(diag.outerHeight);
//     document.getElementById('text_dx').rows = '9';
// };

// diag.addEventListener("mousedown", function(e) {
//     resizeInt = setInterval(resizeEvent, 1000/15);
//     console.log(e);
// });

// $(window).on("mouseup", function(e) {
//     if (resizeInt !== null) {
//         clearInterval(resizeInt);
//     }
//     // resizeEvent();
// });
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
        for(let i = 0; i < page.length; i++){ if(window.getComputedStyle(page[i].display !== 'none')) pn++;}
        let pc = 1;
        for(let i = 0; i < page.length; i++){            
            if(window.getComputedStyle(page[i].display !== 'none')){     
                page[i].querySelector('.page-number').innerHTML = "".concat(pc,'/',pn);
                pc++; 
            }
        }        
    }, 600);
});



