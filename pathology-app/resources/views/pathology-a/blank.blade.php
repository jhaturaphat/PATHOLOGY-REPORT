<page size="A4" id="blank_page" class="animate__animated animate__fadeInLeft">
    <div class="container">
    <img id="watermark" src="{{URL::asset('/images/logo.png')}}" alt="logo">
        <div class="page-number"></div>
        @include('pathology-a.header')   
            <textarea id="text_blank" rows="20"></textarea>  
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
    </div> 
    
</page>