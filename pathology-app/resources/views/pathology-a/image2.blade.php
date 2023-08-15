<page size="A4" id="image2" >
    <div class="container">
    <img id="watermark" src="{{URL::asset('/images/logo.png')}}" alt="logo">
        <div class="page-number">2/2</div>        
        @include('pathology-a.header')
        
        <section id="editor_gross" style="border-bottom: 1px solid rgb(205, 201, 201); padding-bottom:15px">
            <div style="text-align: left; margin:20px 0 0 0;"><b>GROSS EXAMINTION </b></div>
            <textarea id="gross_examination"></textarea>    
            <div class="gross_footer">
                <label for=""><b>Gross examiner:</b></label>
                <input type="text">
                <label for=""><b>Date:</b></label>
                <input type="text" id="img2_date" data-calendar='1'>
            </div>
        </section>
        <section id="microscropic">
            <div><b>MICROSCOPIC DESCRIPTION</b> </div>
            <textarea id="microscopic_description"></textarea> MICROSCOPIC DESCRIPTION
        </section>
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
        
    </div>
    
</page>