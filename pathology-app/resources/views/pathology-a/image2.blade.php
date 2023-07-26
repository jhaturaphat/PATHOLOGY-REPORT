<page size="A4" id="image2">
    <div class="container">
        <div class="page-number">2/2</div>
        <div class="container">
            @include('pathology-a.header')
        </div>

        
        <section id="editor_gross">
            <div style="text-align: left; margin:20px 0 0 45px;"><b>GROSS EXAMINTION </b></div>
            <textarea></textarea>    
            <div class="gross_footer">
                <label for="">Gross examiner:</label>
                <input type="text">
                <label for="">Date:</label>
                <input type="text">
            </div>
        </section>
        <section id="microscropic">
            <div>MICROSCOPIC DESCRIPTION </div>
            <textarea></textarea>
        </section>
        <div class="image2-footer">
            @include('pathology-a.footer')
        </div>
        
    </div>
    
</page>