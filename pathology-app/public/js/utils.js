const Utils = {
    DDMMYYYY: function(val = ""){
        const items = val.split("-");
        return items[2]+"-"+items[1]+"-"+items[0];
    },  
    YYYYMMDD: function(val =''){
        const items = val.split("-");
        return items[2]+"-"+items[1]+"-"+items[0];
    }
};

const Alert = {
    success: function(msg = "สำเร็จ"){
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 1500
        });
    },
    error: function(msg = 'Eror'){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: msg,
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
    ExportPNG: async function(ele){
        await html2canvas(ele, {scale: 1.2, removeContainer:false}).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            pngObj.push(imgData);
        });
    }
}


const CKE = {
    Use :function(id, h = 400){
        CKEDITOR.replace(id,{
            contentsCss: ['../ckeditor/style.css'],                
            height: h,            
            /*toolbar: [
                { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
                //{ name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'tools', items: ['Maximize']},
                { name: 'basicstyles', items: ['Bold','Italic','Strike','-','RemoveFormat']},
                { name: 'paragraph', items: ['NumberedList','BulletedList','-','JustifyLeft']},
                               
            ],*/
        })
    },
    Preview:function(){
        // CKEDITOR.instances.phatology_diag.getData();
        CKE.Default();
        const diag = document.querySelectorAll('[id^=phatology_diag]')
        const tx  = document.querySelectorAll("[id^=tx_]");
        const rx_phatology_diag  = document.querySelectorAll("#rx_phatology_diag");        
        const rx_microscopic_description  = document.getElementById("rx_microscopic_description");
        
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