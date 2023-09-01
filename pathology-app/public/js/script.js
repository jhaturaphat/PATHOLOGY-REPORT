"use strict";
const CKE = {
    Use :function(id, h = 400){
        CKEDITOR.replace(id,{
            contentsCss: ['../ckeditor/style.css'],                
            height: h,
            toolbar: [
                { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
                //{ name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'tools', items: ['Maximize']},
                { name: 'basicstyles', items: ['Bold','Italic','Strike','-','RemoveFormat']},
                { name: 'paragraph', items: ['NumberedList','BulletedList']}
            ],
        })
    }
} ;

const diag = document.querySelectorAll('#phatology_diag');
diag.forEach(function(ele, index){
    CKE.Use(ele, 450);
});

CKE.Use("microscopic_description", 450);
