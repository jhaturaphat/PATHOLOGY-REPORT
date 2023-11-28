"use strict";
// import { Utils } from "./utils.js";
// แปลง html เป็นรูปภาพ png
var pngObj = [];
document.getElementById('release').onclick = async function(e){
    e.preventDefault();
    save('POST');
};

document.getElementById('update').onclick = async function(e){
    e.preventDefault();
    save('PUT');
};


// *CKEDITOR
const diag = document.querySelectorAll('[id^=phatology_diag]');  //เลือก ทุก Element ที่ขึ้นต้นด้วย phatology_diag
diag.forEach(function(ele, index){
    CKE.Use(ele, 0);
});

const txt_image1 = `<p><strong>CLINICAL HISTORY: </strong></p>
        <p><strong>CLINICAL DIAGNOSIS: </strong></p>
        <p><strong>ORGAN: </strong></p>
        <p><strong>SPECIMEN LATERALITY: </strong></p>
        <p style="text-align: center;">
        <strong>​​​​​​​CYTOLOGICAL DIAGNOSIS</strong></p><br>
        <p><strong></strong></p>`;
CKE.Use('txt_image1', 730, txt_image1);
CKE.Use('txt_image2', 730, "");
CKE.Use('txt_image3', 730, "");
CKE.Use('txt_image4', 730, "");
CKE.Use('txt_image5', 730, "");


async function save(type = 'GET'){    
    CKE.Preview(); 
    var pngObj = [];        
    var data_item = {};

    // data items
    data_item.outid = $('input[id="outid"]').val();
    data_item.lab_order_number = $('#lab_order_number').val();
    data_item.hn = $('#hn').val();
    data_item.fname = $('#fname').text();
    data_item.lname = $('#lname').text();
    data_item.age = $('#age').text();
    data_item.gender = $('#gender').text();
    data_item.speci_collected_at = Utils.YYYYMMDD($('#speci_collected_at').text());
    data_item.speci_received_at = Utils.YYYYMMDD($('#speci_received_at').val());
    data_item.date_of_report = Utils.YYYYMMDD($('#date_of_report').val());
    data_item.physician = $('#physician').text();  //แพทย์ผู้สั่ง    
    data_item.txt_image1 = CKEDITOR.instances['txt_image1'].getData();
    data_item.txt_image2 = CKEDITOR.instances['txt_image2'].getData();
    data_item.txt_image3 = CKEDITOR.instances['txt_image3'].getData();
    data_item.txt_image4 = CKEDITOR.instances['txt_image4'].getData();
    data_item.txt_image5 = CKEDITOR.instances['txt_image5'].getData();  
    data_item.pathologist = $('#pathologist').val();
   

    const screenshotTarget = document.getElementsByTagName('page');
    const inputele = document.getElementsByTagName('input');

    for(var i =0;i<inputele.length; i++){
        inputele[i].style.border = 'none';
    }

    
    //จัดการ style สำหรับส่งออกเป็นรูปภาพ
    for(var i=0; i<screenshotTarget.length; i++){ 
        let cssObj = window.getComputedStyle(screenshotTarget[i]);
        if(cssObj.getPropertyValue('display') !== 'none'){
            screenshotTarget[i].style.boxShadow = 'none';
            // screenshotTarget[i].classList.remove('animate__animated');   
            let image64 = await PageControl.ExportPNG(screenshotTarget[i]); 
            pngObj.push(image64); //แปลงรูปภาพ
            // screenshotTarget[i].classList.add('animate__animated');
            screenshotTarget[i].style.boxShadow = '0 0 0.5cm rgba(0,0,0,0.5)';
        }      
    }
 
    let Statloading = null;
    setTimeout(() => {        
        $.ajax({
            type: type,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',   
            contentType: "application/json; charset=utf-8",         
            url: '/cytological',
            data: JSON.stringify({item: data_item, image: pngObj}),            
            beforeSend: function(){
                Statloading = Alert.loading(0);
                console.log(Statloading);
            },
            complete: function(jqXHR, textStatus){                
                Statloading.close();
                if(jqXHR.status === 200) {
                    Alert.success(jqXHR.responseJSON.message.errorInfo);                    
                }else{
                    Alert.error("Eror", jqXHR.responseJSON.message.errorInfo);
                } 
            },
            error: function (jqXHR, textStatus, err){
                if (jqXHR.status != 200){
                    console.log(jqXHR.responseJSON);
                    Alert.error('Eror', jqXHR.responseJSON.message.errorInfo);
                }
            }          
          });
    }, 100);
}




