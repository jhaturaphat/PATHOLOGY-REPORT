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
        // $( "input[data-calendar='1']" ).each(function(){
        $( "input[data-calendar='1']" ).each(function(){
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
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    },
    error: function(msg = 'Eror', txt = 'เกิดข้อผิดพลาด'){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: msg,
            text: txt,
            showConfirmButton: true            
        });
    },
    warning: function(msg = 'warning'){
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: msg,
            showConfirmButton: true            
        });
    },
    info: function(msg = 'info'){
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    },
    question: function(msg = 'question'){
        Swal.fire({
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
        // parent.style.display = 'none';
        
        parent.classList.remove('animate__fadeInLeft');
        parent.classList.add('animate__backOutDown');
        
        setTimeout(() => {        
            parent.classList.remove('animate__backOutUp');
            parent.classList.add('animate__fadeInLeft');
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
    }
}


const CKE = {
    Use :function(id, h = 400){
        CKEDITOR.replace(id,{                      
            height: h  
        })
    },
    Preview:function(){
        // CKEDITOR.instances.phatology_diag.getData();
        CKE.Default();
        const diag = document.querySelectorAll('[id^=phatology_diag]');
        const tx  = document.querySelectorAll("[id^=tx_]");
        const rx_phatology_diag  = document.querySelectorAll("#rx_phatology_diag");        
        const rx_microscopic_description  = document.getElementById("rx_microscopic_description");

        // Image1        
        const tx_clinical = document.querySelectorAll("[id^=tx_clinical_]");        
        const rx_clinical = document.querySelectorAll("[id^=rx_clinical_]");
        tx_clinical.forEach((ele, index)=>{
            ele.style.display = 'none';
            let data = ele.getElementsByTagName('textarea')[0];            
            rx_clinical[index].getElementsByTagName('span')[0].textContent = data.value;
        }); 

        // Image5        
        document.getElementById("rx_gross_examination").innerHTML = CKEDITOR.instances['gross_examination'].getData();
        tx.forEach((ele)=>ele.style.display = 'none');
        diag.forEach((ele, index)=>{
            let content =  CKEDITOR.instances['phatology_diag'+'_'+(index + 1)].getData();            
            rx_phatology_diag[index].innerHTML = content;
        });        
        rx_microscopic_description.innerHTML = CKEDITOR.instances['microscopic_description'].getData();
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