<page size="A4" id="image1" class="animate__animated animate__fadeInLeft">
    <div class="container">        
        <div class="page-number">1/5</div>
        @include('pathology-a.header')   
            <section>
                <span><b>CLINICAL HISTORY:</b></span>
                <textarea id="clinical_history" cols="30" rows="5" >             </textarea>
            </section>
            <section>
                <span><b>CLINICAL DIAGNOSIS:</b></span>
                <textarea id="clinical_diagnosis" cols="30" rows="5">               </textarea>
            </section>
            
        <div style="text-align: center"><b>PATHOLOGICAL DIAGNOSIS</b></div>
        <div id="tx_phatology_diag">
            <textarea id="phatology_diag_1" rows="20">TEST1</textarea>    
        </div> 
        <div id="rx_phatology_diag"></div>  
        <div class="image1-footer">
            @include('pathology-a.footer')
        </div>
    </div>     

</page>