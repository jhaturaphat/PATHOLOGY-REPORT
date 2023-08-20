<page size="A4" id="blank_page" class="animate__animated animate__fadeInLeft">
    <div class="container"> 
        <div class="eraser" data-html2canvas-ignore></div>   
        <div class="page-number"></div>
        @include('pathology-a.header')   
            <textarea id="phatology_diag" rows="38"></textarea>  
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>

        <div class="add_plus" data-html2canvas-ignore>
            <i class="fa-solid fa-circle-plus"></i>
        </div>   
    </div> 
    
</page>