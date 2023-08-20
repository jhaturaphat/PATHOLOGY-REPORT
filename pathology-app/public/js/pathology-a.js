"use strict";
// import { Utils } from "./utils.js";
// แปลง html เป็นรูปภาพ png
let pngObj = [];
document.getElementById('release').onclick = async function(){
    pngObj = [];
    let phatology_diag_obj = [];
    let data_item = {};

    // data items
    data_item['id'] = $('#id').val();
    data_item['lab_order_number'] = $('#lab_order_number').val();
    data_item['hn'] = $('#hn').val();
    data_item['fname'] = $('#fname').text();
    data_item['lanme'] = $('#lname').text();
    data_item['age'] = $('#age').text();
    data_item['gendeer'] = $('#gender').text();
    data_item['speci_collected_at'] = $('#speci_collected_at').text();
    data_item['speci_received_at'] = $('#speci_received_at').val();
    data_item['date_of_report'] = $('#date_of_report').val();
    data_item['physician'] = $('#physician').text();
    data_item['clinical_history'] = $('#clinical_history').val();
    data_item['clinical_diagnosis'] = $('#clinical_diagnosis').val();
    data_item['gross_examination'] = $('#gross_examination').val();
    data_item['gross_examiner'] = $('#gross_examiner').val();
    data_item['gross_date'] = $('#gross_date').val();
    data_item['microscopic_description'] = $('#microscopic_description').val();
    data_item['pathologist'] = $('#pathologist').val();

    const screenshotTarget = document.getElementsByTagName('page');
    const inputele = document.getElementsByTagName('input');

    const hn = document.getElementById('hn');  
    hn.style.border = 'none';  
    screenshotTarget[0].style.boxShadow = 'none';  

    for(var i =0;i<inputele.length; i++){
        inputele[i].style.border = 'none';
    }

    const phatologys_diag = document.querySelectorAll('#phatology_diag');
    phatologys_diag.forEach(function(ele, index){       
        const parent = ele.closest('page'); //ย้อนกลับขึ้นไปที่ element แม่
        let cssObj = window.getComputedStyle(parent);
        if(cssObj.getPropertyValue('display') !== 'none'){  //ดูก่อนว่าได้กำหนดค่าให้แสดงไหม
            phatology_diag_obj.push(ele.value);
        }
    });

    data_item['phatology_diag'] = phatology_diag_obj;
    
    for(var i=0; i<screenshotTarget.length; i++){ 
        let cssObj = window.getComputedStyle(screenshotTarget[i]);
        if(cssObj.getPropertyValue('display') !== 'none'){
            screenshotTarget[i].style.boxShadow = 'none';
            screenshotTarget[i].classList.remove('animate__animated');      
            await convertpng(screenshotTarget[i]); //แปลงรูปภาพ
            screenshotTarget[i].classList.add('animate__animated');
            screenshotTarget[i].style.boxShadow = '0 0 0.5cm rgba(0,0,0,0.5)';
        }      
    }
    console.log(JSON.stringify(pngObj));
    console.log(data_item);
if(data_item < 5){

}
// return;
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
            data: {items: JSON.stringify(data_item)/*, report: JSON.stringify(pngObj)*/},
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
// เพิ่มหน้าสำหรับกรอกข้อมูล <i class="fa-solid fa-circle-xmark"></i>
const addpage = document.getElementById('add');
addpage.addEventListener("mouseup", function(){
    const blank_page = document.querySelectorAll('#blank_page');  
    for(let i=0; i< blank_page.length; i++){
        blank_page[i].querySelector('.eraser')
        .innerHTML = '<i id="eraser-'+i+'" class="fa-solid fa-circle-xmark" onclick="return PageControl.FnEraser(\'eraser-'+i+'\')"></i>';
        blank_page[i].style.display = 'block';
    }
    this.style.display = "none"; 
    document.getElementById('del').style.display = 'block';
    setTimeout(() => {
        PageControl.FnCalPage();
    }, 100);
});
// ลบหน้าที่เพิ่มมา
const delpage = document.getElementById('del');
delpage.addEventListener("mouseup", function(){
    const blank_page = document.querySelectorAll('#blank_page'); 
    for(let i=0; i< blank_page.length; i++){ 
        blank_page[i].classList.remove('animate__fadeInLeft');
        blank_page[i].classList.add('animate__backOutUp');
        setTimeout(() => {        
            blank_page[i].classList.remove('animate__backOutUp');
            blank_page[i].classList.add('animate__fadeInLeft');
            blank_page[i].style.display = 'none'; 
        }, 200);
    }
    this.style.display = "none";     
    document.getElementById('add').style.display = 'block';
    PageControl.FnCalPage();
});

// PATHOLOGIST




