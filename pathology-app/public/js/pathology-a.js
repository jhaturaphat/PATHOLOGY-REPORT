"use strict";
// import { Utils } from "./utils.js";
// แปลง html เป็นรูปภาพ png
var pngObj = [];
document.getElementById('release').onclick = async function(e){
    e.preventDefault();
    CKE.Preview(); 
    var pngObj = [];    
    var phatology_diag_obj = [];
    var data_item = {};

    // data items
    data_item.id = $('#id').val();
    data_item.lab_order_number = $('#lab_order_number').val();
    data_item.hn = $('#hn').val();
    data_item.fname = $('#fname').text();
    data_item.lname = $('#lname').text();
    data_item.age = $('#age').text();
    data_item.gender = $('#gender').text();
    data_item.speci_collected_at = Utils.YYYYMMDD($('#speci_collected_at').text());
    data_item.speci_received_at = Utils.YYYYMMDD($('#speci_received_at').val());
    data_item.date_of_report = Utils.YYYYMMDD($('#date_of_report').val());
    data_item.physician = $('#physician').text();
    data_item.clinical_history = $('#clinical_history').val();
    data_item.clinical_diagnosis = $('#clinical_diagnosis').val();
    data_item.gross_examination = $('#gross_examination').val();
    data_item.gross_examiner = $('#gross_examiner').val();
    data_item.gross_date = Utils.YYYYMMDD($('#gross_date').val());
    data_item.microscopic_description = CKEDITOR.instances['microscopic_description'].getData();
    data_item.pathologist = $('#pathologist').val();
    data_item.phatology_diag_1 = "";
    data_item.phatology_diag_2 = "";
    data_item.phatology_diag_3 = "";
    data_item.phatology_diag_4 = "";

    const screenshotTarget = document.getElementsByTagName('page');
    const inputele = document.getElementsByTagName('input');

    for(var i =0;i<inputele.length; i++){
        inputele[i].style.border = 'none';
    }

    const phatologys_diag = document.querySelectorAll('[id^=phatology_diag]');
    
    phatologys_diag.forEach(function(ele, index){       
        const parent = ele.closest('page'); //ย้อนกลับขึ้นไปที่ element แม่
        let cssObj = window.getComputedStyle(parent);
        if(cssObj.getPropertyValue('display') !== 'none'){  //ดูก่อนว่าได้กำหนดค่าให้แสดงไหม  
            switch(ele.id){
                case 'phatology_diag_1':
                    data_item.phatology_diag_1 = CKEDITOR.instances['phatology_diag_1'].getData();
                break;
                case 'phatology_diag_2':
                    data_item.phatology_diag_2 = CKEDITOR.instances['phatology_diag_2'].getData();
                break;
                case 'phatology_diag_3':
                    data_item.phatology_diag_3 = CKEDITOR.instances['phatology_diag_3'].getData();
                break;
                case 'phatology_diag_4':
                    data_item.phatology_diag_4 = CKEDITOR.instances['phatology_diag_4'].getData();
                break;
                default:
                    break;
            }            
        }
    });
    
    //จัดการ style สำหรับส่งออกเป็นรูปภาพ
    for(var i=0; i<screenshotTarget.length; i++){ 
        let cssObj = window.getComputedStyle(screenshotTarget[i]);
        if(cssObj.getPropertyValue('display') !== 'none'){
            screenshotTarget[i].style.boxShadow = 'none';
            screenshotTarget[i].classList.remove('animate__animated');   
            let image64 = await PageControl.ExportPNG(screenshotTarget[i]); 
            pngObj.push(image64); //แปลงรูปภาพ
            screenshotTarget[i].classList.add('animate__animated');
            screenshotTarget[i].style.boxShadow = '0 0 0.5cm rgba(0,0,0,0.5)';
        }      
    }
    // console.log(JSON.stringify(pngObj));
    // let newhtml = data_item.phatology_diag_1+data_item.phatology_diag_2+data_item.phatology_diag_3+data_item.phatology_diag_4;
    // CKEDITOR.instances['phatology_diag_4'].setData(newhtml);
    // console.log(data_item);
 
    setTimeout(() => {
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
        $.ajax({
            type: "POST",
            dataType: 'json',   
            contentType: "application/json; charset=utf-8",         
            url: '/pathology-a',
            data: JSON.stringify({item: data_item, image: pngObj}),
            success: function(data, textStatus,jqXHR){
                Alert.success(data.message);
            },
            error: function (jqXHR, textStatus, err){
                if (jqXHR.status != 200){
                    console.log(jqXHR.responseJSON);
                    Alert.error(err, jqXHR.responseJSON.message.errorInfo);
                }
            }          
          });
    }, 100);
   
};

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


// CKEDITOR
const diag = document.querySelectorAll('[id^=phatology_diag]');  //เลือก ทุก Element ที่ขึ้นต้นด้วย phatology_diag
diag.forEach(function(ele, index){
    CKE.Use(ele, 450);
});

CKE.Use("microscopic_description", 450);




