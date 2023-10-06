<page size="A4" id="image1" class="">
    <div class="page-container">        
        <div class="page-number">1/5</div>
        @include('pathology-a.header')   
            <div id="tx_clinical_history">
                <div style="width: 130px">
                    <span id="clinical"><b>CLINICAL HISTORY:</b></span> 
                </div>
                <div >
                    <textarea id="clinical_history" cols="30" rows="1" > </textarea> 
                </div>
                
            </div>
            <div id="tx_clinical_diagnosis">
                <div style="width: 145px">
                    <span id="clinical"><b>CLINICAL DIAGNOSIS:</b></span> 
                </div>                
                <div>
                    <textarea id="clinical_diagnosis" cols="0" rows="1"></textarea> 
                </div>
            </div>
            <div id="rx_clinical_history" style="display: none">
                <b>CLINICAL HISTORY:</b>
                <span></span>
            </div>    
            
            <div id="rx_clinical_diagnosis" style="display: none">
                <b>CLINICAL DIAGNOSIS:</b>
                <span></span>
            </div>            
        <div style="text-align: center; margin-top: 10px;letter-spacing: 2px;"><b>CYTOLOGICAL DIAGNOSIS</b></div>
        <div id="tx_phatology_diag" data-html2canvas-ignore>
            <textarea id="phatology_diag_1" rows="20"></textarea>    
        </div> 
        
        <div id="rx_phatology_diag"></div>  
        <div id="drop_image1" >
            <div id="editor_gross" style="border-bottom: 1px solid rgb(205, 201, 201); padding-bottom:15px">
                <div style="text-align: left; margin:20px 0 0 0;"><b>GROSS EXAMINTION </b></div>
                <div id="rx_gross_examination"></div>
                <div id="tx_gross_examination">
                    <textarea id="gross_examination"></textarea>  
                </div>  
                {{-- <div class="gross_footer">
                    <label for="gross_examiner"><b>Gross examiner:</b></label>
                    <input type="text" id="gross_examiner">
                    <label for=""><b>Date:</b></label>
                    <input type="text" id="gross_date" data-calendar='1' autocomplete="off">
                </div> --}}
            </div>
        </div>        
        <div class="image1-footer">
            @include('pathology-a.footer')
        </div>
    </div>     
    
</page>


