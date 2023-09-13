<page size="A4" id="image1" class="animate__animated animate__fadeInLeft">
    <div class="page-container">        
        <div class="page-number">1/5</div>
        @include('pathology-a.header')   
            <div id="tx_clinical_history">
                <span id="clinical"><b>CLINICAL HISTORY:</b></span> 
                    <textarea id="clinical_history" cols="30" rows="5" ></textarea>
            </div>
            <div id="tx_clinical_diagnosis">
                <span id="clinical"><b>CLINICAL DIAGNOSIS:</b></span> 
                <textarea id="clinical_diagnosis" cols="30" rows="5"></textarea> 
            </div>
            <div id="rx_clinical_history" style="display: none">
                <b>CLINICAL HISTORY:</b>
                <span></span>
            </div>         
            <div id="rx_clinical_diagnosis" style="display: none">
                <b>CLINICAL DIAGNOSIS:</b>
                <span></span>
            </div>            
        <div style="text-align: center; margin-top: 10px;"><b>PATHOLOGICAL DIAGNOSIS</b></div>
        <div id="tx_phatology_diag" data-html2canvas-ignore>
            <textarea id="phatology_diag_1" rows="20"></textarea>    
        </div> 
        
        <div id="rx_phatology_diag"></div>  
        <div class="image1-footer">
            @include('pathology-a.footer')
        </div>
    </div>     

</page>