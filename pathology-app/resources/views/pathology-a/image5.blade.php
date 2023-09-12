<page size="A4" id="image5">
    <div class="page-number">5/5</div>
    <div class="page-container">
        @include('pathology-a.header')
        <div id="editor_gross" style="border-bottom: 1px solid rgb(205, 201, 201); padding-bottom:15px">
            <div style="text-align: left; margin:20px 0 0 0;"><b>GROSS EXAMINTION </b></div>
            <div id="rx_gross_examination"></div>
            <div id="tx_gross_examination">
                <textarea id="gross_examination"></textarea>  </div>  
            <div class="gross_footer">
                <label for="gross_examination"><b>Gross examiner:</b></label>
                <input type="text" id="gross_examination">
                <label for=""><b>Date:</b></label>
                <input type="text" id="gross_date" data-calendar='1'>
            </div>
        </div>
        <div id="microscropic">
            <div><b>MICROSCOPIC DESCRIPTION</b> </div>
            <div id="tx_microscopic_description" data-html2canvas-ignore>
                <textarea id="microscopic_description">XXXXXXXXXXXXXXXXXXXXXXmicroscopic_description</textarea> 
            </div>
            <div id="rx_microscopic_description"></div>
        </div>
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
    </div>
</page>