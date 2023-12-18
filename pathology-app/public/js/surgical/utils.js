const Utils = {
    DDMMYYYY: function(val = ""){
        const items = val.split("-");
        return items[2]+"-"+items[1]+"-"+items[0];
    },  
    YYYYMMDD: function(val =''){
        const items = val.split("-");
        return items[2]+"-"+items[1]+"-"+items[0];
    },
    Calendar: function(element) { 
            // return $( "input[data-calendar='1']" ).each(function(){
                return element.each(function(){
                $(this).datepicker({
                    timepicker:false,
                    lang:'th',
                    yearOffset:543,
                    dateFormat:'dd-mm-yy',
                    showAnim: 'clip',
                    // changeMonth: true,
                    // changeYear: true,
                    minDate: '-120',
                    maxDate: "+0D",   
                    onSelect: function(date, datepicker){
                        $("input[id="+this.id+"]").each(function(){
                            $(this).val(date);
                        });
                    }
                });               
            });
    }
};

const Alert = {
    success: function(msg = "สำเร็จ"){
        return Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    },
    error: function(msg = 'Eror', txt = 'เกิดข้อผิดพลาด'){
        return Swal.fire({
            position: 'center',
            icon: 'error',
            title: msg,
            text: txt,
            showConfirmButton: true            
        });
    },
    warning: function(msg = 'warning'){
        return Swal.fire({
            position: 'center',
            icon: 'warning',
            title: msg,
            showConfirmButton: true            
        });
    },
    info: function(msg = 'info'){
        return Swal.fire({
            position: 'center',
            icon: 'info',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    },
    question: function(msg = 'question'){
        return Swal.fire({
            position: 'center',
            icon: 'question',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    },
    loading: function(timer = 1000){
        let timerInterval
        return Swal.fire({
            title: 'กำลังประมวลผม',
            html: 'ฉันจะปิดภายใน <b></b> วินาที่.',
            timer: 155000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval);
                return true;
            }
            });
    }
};

const PageControl = {
    FnEraser: function(id = ''){
        const current = document.querySelector('#'+id); //ต่อ String กับ id เข้าด้วยกัน
        const parent = current.closest('page');                
        setTimeout(() => {                    
            parent.style.display = 'none'; 
            PageControl.FnCalPage();
        }, 500);
        
    },
    FnCalPage: function(){
        const page = document.querySelectorAll('page');
        setTimeout(() => {
            let pn = 0;            
            page.forEach(function(ele, index){ 
            let cssObj = window.getComputedStyle(ele);            
                if(cssObj.getPropertyValue('display') !== 'none') pn++;                
            });
            let pc = 1;
            page.forEach(function(ele, index){  
                let cssObj = window.getComputedStyle(ele);       
                if(cssObj.getPropertyValue('display') !== 'none'){     
                    ele.querySelector('.page-number').innerHTML = "page ".concat(pc,' of ',pn);
                    pc++; 
                }
            }); 
        }, 300);
    },  
    ExportPNG:async function(ele){
        let image64 = "";
        await html2canvas(ele, {scale: 1.5, removeContainer:false}).then(function (canvas) {
            image64 = canvas.toDataURL('image/png');
        });
        return image64;
    },

    SaveTolocal:function(ele){     //ส่งค่า string image1,image2, image3, image4, image5
        const eledownload = document.querySelector('#'+ele); 
        console.log(ele);
        if($('#dow-'+ele).hasClass('fa-download')){
            html2canvas(eledownload, {scale: 1.5, removeContainer:false}).then(function(canvas) {
                    const link = document.createElement('a');
                    const alias = $("#lab_order_number").val();
                    link.download = alias+"-"+ele+'.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
        }
    },

    CountImage: function(lab_order_number){
        $.ajax({
            url:"/laborderimage/countImage",
            dataType: "json",
            data: {
                lab_order_number:lab_order_number
            },
            success: function(data){
                switch (data.count) {
                    case 1:
                        $('#cpage5').trigger('click').off('click').prop( "disabled", true ); 
                        $("#image5").css("display","none");
                        $("#dow-image5").removeClass('fa-download').addClass('fa-eye');
                        break;
                    case 2:
                        $('#cpage4, #cpage5').trigger('click').off('click').prop( "disabled", true );  
                        $("#image4, #image5").css("display","none");
                        $("#dow-image4, #dow-image5").removeClass('fa-download').addClass('fa-eye');
                        break;
                    case 3:
                        $('#cpage3, #cpage4, #cpage5').trigger('click').off('click').prop( "disabled", true );  
                        $("#image3, #image4, #image5").css("display","none");
                        $("#dow-image3, #dow-image4, #dow-image5").removeClass('fa-download').addClass('fa-eye');
                        break;
                    case 4:
                        $('#cpage2, #cpage3, #cpage4, #cpage5').trigger('click').off('click').prop( "disabled", true );  
                        $("#image2, #image3, #image4, #image5").css("display","none");
                        $("#dow-image2, #dow-image3, #dow-image4, #dow-image5").removeClass('fa-download').addClass('fa-eye');
                        break;
                    case 5:
                        $('[id^="cpage"],#release,#update').trigger('click').off('click').prop( "disabled", true );  
                        $('page').css("display","none");
                        $('[id^="#dow-image"]').removeClass('fa-download').addClass('fa-eye');
                        break;
                    default:
                        break;
                };
            },
            error: function (jqXHR, textStatus, err){
                if (jqXHR.status != 200){
                    Alert.error(err, jqXHR.responseJSON.message);
                }
            }
        });
    }
}


const CKE = {
    Use :function(id, h = 400, txt = ''){
        CKEDITOR.replace(id,{                      
            height: h,
            on: {
                instanceReady: function(ev){
                    var editor = ev.editor;
                    editor.setData(txt);
                }
            }
        });        
    },
    Preview:function(){
        // CKEDITOR.instances.phatology_diag.getData();
        CKE.Default();
        const txt_image = document.querySelectorAll('[id^=txt_image]');
        const tx  = document.querySelectorAll("[id^=tx_]");
        const rx_txt_image  = document.querySelectorAll("[id^=rx_txt_image]");        
        
        tx.forEach((ele)=>ele.style.display = 'none');
        txt_image.forEach((ele, index)=>{            
            let content =  CKEDITOR.instances['txt_image'+(index + 1)].getData();            
            rx_txt_image[index].innerHTML = content;
        });        
        
    },
    Undo:function(){
        const rx  = document.querySelectorAll("[id^=rx_]");
        const tx  = document.querySelectorAll("[id^=tx_]");
        rx.forEach((ele) => ele.style.display = 'none');
        tx.forEach((ele) => ele.style.display = 'block');        
    },
    Default:function(){       
        const rx  = document.querySelectorAll("[id^=rx_]");
        const tx  = document.querySelectorAll("[id^=tx_]");
        tx.forEach((ele)=>ele.style.display = 'none');  
        rx.forEach((ele)=>ele.style.display = 'block');          
    },
    Choose: function(ele, val){        
        const select = document.getElementById(val);        
        switch(ele.checked){
            case true :
                select.style.display = 'block';
                PageControl.FnCalPage(); //คำเลขหน้าใหม่
                break;
            default:
                select.style.display = 'none';
                PageControl.FnCalPage(); //คำเลขหน้าใหม่
        }    
    }
} ;