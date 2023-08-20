<page size="A4" id="image2" class="animate__animated animate__fadeInLeft">
    <div class="container">
        
        <div class="page-number">2/2</div>        
        @include('pathology-a.header')
        
        <section id="editor_gross" style="border-bottom: 1px solid rgb(205, 201, 201); padding-bottom:15px">
            <div style="text-align: left; margin:20px 0 0 0;"><b>GROSS EXAMINTION </b></div>
            <textarea id="gross_examination"></textarea>    
            <div class="gross_footer">
                <label for="gross_examiner"><b>Gross examiner:</b></label>
                <input type="text" id="gross_examiner">
                <label for=""><b>Date:</b></label>
                <input type="text" id="gross_date" data-calendar='1'>
            </div>
        </section>
        <section id="microscropic">
            <div><b>MICROSCOPIC DESCRIPTION</b> </div>
            <textarea id="microscopic_description"></textarea> 
        </section>
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
        
    </div>
    
</page>