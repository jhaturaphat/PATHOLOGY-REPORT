<page size="A4" id="image1">
    <div class="container">
        <div class="page-number">1/2</div>
        @include('pathology-a.header')         
            <section>
                <span><b>CLINICAL HISTORY:</b></span>
                <textarea name="" id="" cols="30" rows="5" >                  </textarea>
            <section>
                <span><b>CLINICAL DIAGNOSIS:</b></span>
                <textarea name="" id="" cols="30" rows="5">                    </textarea>
            </section>
            
        <div style="text-align: center"><b>PATHOLOGICAL DIAGNOSIS</b></div>
        <div id="editor_dx">
            <textarea></textarea>    
        </div>   
        @include('pathology-a.footer')
    </div>  
</page>