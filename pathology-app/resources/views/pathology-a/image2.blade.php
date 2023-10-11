<page size="A4" id="image2" class="">
    <div class="page-number">5/5</div>
    <div class="page-container">
        @include('pathology-a.header')        
        <div id="drop_image2"> </div>
        <div id="microscropic">
            <div><b>MICROSCOPIC DESCRIPTION</b> </div>
            <div id="tx_microscopic_description" data-html2canvas-ignore >
                <textarea id="microscopic_description"></textarea> 
            </div>
            <div id="rx_microscopic_description" ></div>
        </div>
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
    </div>
</page>