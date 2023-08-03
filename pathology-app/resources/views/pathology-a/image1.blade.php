<page size="A4" id="image1">
    <div class="container">
        <img id="watermark" src="{{URL::asset('/images/logo.png')}}" alt="logo">
        <div class="page-number">1/2</div>
        @include('pathology-a.header')    
          
            <section>
                <span><b>CLINICAL HISTORY:</b></span>
                <textarea name="" id="history" cols="30" rows="5" >                  </textarea>
            </section>
            <section>
                <span><b>CLINICAL DIAGNOSIS:</b></span>
                <textarea name="" id="diag" cols="30" rows="5">                    </textarea>
            </section>
            
        <div style="text-align: center"><b>PATHOLOGICAL DIAGNOSIS</b></div>
        <div id="editor_dx">
            <textarea id="text_dx" rows="20"></textarea>    
        </div>   
        <div class="image1-footer">
            @include('pathology-a.footer')
        </div>
    </div> 
    <span id="add-page">
        <i id="add" class="fa-solid fa-circle-plus"></i>
        <i id="del" class="fa-regular fa-trash-can"></i>
    </span>    

</page>