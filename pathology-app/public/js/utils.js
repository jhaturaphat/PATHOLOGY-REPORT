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
    Preview :function(){
        
    }
}
