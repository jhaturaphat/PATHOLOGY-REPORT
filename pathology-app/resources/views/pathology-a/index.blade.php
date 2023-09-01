<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>pathology report</title>
    <link rel="stylesheet" href="/js/jquery/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.26/dist/sweetalert2.min.css" integrity="sha256-VJuwjrIWHWsPSEvQV4DiPfnZi7axOaiWwKfXaJnR5tA=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/ckeditor.css">
    <link rel="stylesheet" href="/css/pathology-a/style.css">
    <link rel="stylesheet" href="/css/pathology-a/header.css">
    <link rel="stylesheet" href="/css/pathology-a/image1.css">
    <link rel="stylesheet" href="/css/pathology-a/image2.css">
</head>
<body>
    <form action="{{ route('upload-image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload</button>`1
    </form>
    @include('pathology-a.image1')
    @include('pathology-a.blank')
    @include('pathology-a.blank')    
    @include('pathology-a.image2')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
    {{-- @include('pathology-a.image3') --}}
    {{-- @include('pathology-a.image4') --}}
    {{-- @include('pathology-a.image5') --}}

    <button id="release" style="position: fixed; top:20px; right:0; z-index:100">Release</button>
    <button id="preview" style="position: fixed; top:20px; right:20; z-index:100">preview</button>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/i18n/datepicker-th.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/plugins/html2canvas.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>
    <script src="{{asset('js/pathology-a.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script>

                    
            // const preview = document.getElementById('preview');
            // preview.addEventListener("click", function(){
            //     var editorData = CKEDITOR.instances.phatology_diag.getData();
            //     $("#cke_wow").hide();
            //     document.getElementById("diag_content").innerHTML = editorData;
            // });

        let canPass = false;
        let lab_order = [];
        $(function(){    
            PageControl.FnCalPage(); //คำนวณ หน้า Page           
            
            $("input[id='hn']").each(function(){ // กำหนดให้ element id="hn" ทุกตัวเป็น autocomplete โดยใช้ each function
                    $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url:"{{route('findlaborder')}}",
                            dataType: "json",
                            data: {
                                term:request.term
                            },
                            success: function(data){
                                if(data.length == 0){
                                    Alert.info('ไม่พบข้อมูลที่ต้องการ');
                                }
                            }
                        });
                    },
                    minLength: 1,
                    select: function( event, ui ) {
                        ui.item.lis_id = $('#id').val();
                        lab_order = ui.item; 

                        $('input[id="lab_order_number"]').each(function() {                        
                            $(this).val(ui.item.lab_order_number);
                        });                
                        $('input[id="hn"]').each(function() {                        
                            $(this).val(ui.item.hn);
                        });
                        $('[id="fname"]').each(function() {                        
                            $(this).text(ui.item.fname);
                        });
                        $('[id="lname"]').each(function() {                        
                            $(this).text(ui.item.lname);
                        });
                        $('[id="age"]').each(function() {                        
                            $(this).text(ui.item.age);
                        });
                        $('[id="gender"]').each(function() {                        
                            $(this).text(ui.item.gender);
                        });
                        $('[id="speci_collected_at"]').each(function() {                        
                            $(this).text(Utils.DDMMYYYY(ui.item.order_date));
                        });                        
                        $('[id="physician"]').each(function() {                        
                            $(this).text(ui.item.doctor_name);
                        });    
                        return false;   //ใส่บรรทัด return false; เพื่อให้สามารถกำหนดค่าให้กับ input ได้            
                        
                    },
                    search:function(event){
                        (!canPass) ? event.preventDefault() : canPass = false;
                    }
                }).keypress(function(e){
                    if (e.keyCode === 13) {
                        canPass = true;
                        $(this).autocomplete("search", $(this).val());
                    }
                }).autocomplete("instance")._renderItem = function (card, item) {
                    return $("<li>")
                    .data("item.autocomplete", item)
                    .append("<div'>" +item.hn +" "+ item.fname + " " + item.lname + "</div>")
                    .append("<div'>" +item.lab_items_name +" แพทย์ผู้สั่ง "+ item.doctor_name + " วันที่สั่ง " + item.order_date + "</div>")
                    .appendTo(card);
                };
            });

            $( "input[data-calendar='1']" ).each(function(){
                $(this).datepicker({
                    timepicker:false,
                    lang:'th',
                    yearOffset:543,
                    dateFormat:'dd-mm-yy',
                    showAnim: 'clip',
                    // changeMonth: true,
                    // changeYear: true,
                    minDate: '-120',
                    maxDate: "+0D",   
                    onSelect: function(date, datepicker){
                        $("input[id="+this.id+"]").each(function(){
                            $(this).val(date);
                        });
                    }
                });               
            });

                      
        });


        
        

        
    </script>

    
</body>
</html>