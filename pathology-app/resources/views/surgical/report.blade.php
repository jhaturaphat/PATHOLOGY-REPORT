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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}
    <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/ckeditor.css">    
    <link rel="stylesheet" href="/css/surgical/style.css">
    <link rel="stylesheet" href="/css/surgical/header.css">
    <link rel="stylesheet" href="/css/surgical/image1.css">
    <link rel="stylesheet" href="/css/surgical/image2.css">
    <style>
        .c{
            display: flex;
            flex-direction: column;
            width: 100%;
            border:1px solid darkblue;
            border-radius: 2px;
            padding: 5px;
        }
        .c > .c-t{
            display: flex;    
            flex-direction: row; 
            text-align: center;
            /* border: 1px solid black; */
            padding: 2px;
        }
        .c > .c-t >div{
            display: flex;
            flex-direction: column;   
            
        }         
        .c > .c-t >div:first-child{            
            border-right: 1px solid;
            padding-right: 11px;
            width: 100%;
        } 
        .c > .c-t >div:last-child{   
            padding-left: 11px;
            width: 100%;
        }       
        .c >.c-t b{
            color: rgb(52, 57, 57);
        }
        .c >.c-t label{
            font-size: 11px;
           color: rgb(92, 114, 114);
        }
        .c > .c-dt{
            font-size: 13px;
        }

        /* Jquery Overide */
                
        .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
            background: #6693bc !important;
            font-weight: bold !important;
            color: #ffffff !important;
        } 
    </style>
</head>
<body>
    <div class="layout">
        <div id="">
            @include('surgical.image1')  
            @include('surgical.image2')
            @include('surgical.image3')
            @include('surgical.image4')
            @include('surgical.image5')
        </div>
   
        {{-- ปุ่มบันทึก --}}
        <div class="menu-left" data-html2canvas-ignore> 
            <form action="{{route('surgical.index')}}" method="GET">
                <button id="home" type="submit"><i class="fa-3x fa-solid fa-house"></i> HOME</button>
            </form>
            <button id="release" class="disable" data-toggle="toggle" disabled><i class="fa-3x fa-regular fa-floppy-disk"></i> SAVE</button>
            <button id="preview" data-toggle="toggle"><i class="fa-3x fa-regular fa-eye"></i> preview</button>
            <button id="udo" class="disable" data-toggle="toggle" disabled><i class="fa-3x fa-solid fa-lock-open"></i> Undo</button>
            <button id="update" class="disable" data-toggle="toggle" disabled><i class="fa-3x fa-regular fa-pen-to-square"></i> update</button>
            <br>
            {{-- จัดการหน้า 1 2 3 4 5 --}}        
            <label for="cpage1">
                <input type="checkbox" name="cpage1" id="cpage1" onclick="CKE.Choose(this, 'image1')" checked>1            
            </label>
            <label for="cpage2">
                <input type="checkbox" name="cpage2" id="cpage2" onclick="CKE.Choose(this, 'image2')" checked>2 
            </label>
            <label for="cpage3">
                <input type="checkbox" name="cpage3" id="cpage3" onclick="CKE.Choose(this, 'image3')" checked>3 
            </label>
            <label for="cpage4">
                <input type="checkbox" name="cpage4" id="cpage4" onclick="CKE.Choose(this, 'image4')" checked>4 
            </label>
            <label for="cpage5">
                <input type="checkbox" name="cpage5" id="cpage5" onclick="CKE.Choose(this, 'image5')" checked>5 
            </label> 
            
        </div>
    </div>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/i18n/datepicker-th.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/plugins/html2canvas.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>
    <script src="{{asset('js/surgical.js')}}"></script>

    @if(isset($id))
        <script>
            
            let _release = null;
            setTimeout(() => {                
                _release = document.getElementById('release').disabled = true;            
                edit();                
            },500);

        function edit(){
                $.ajax({
                    type: "GET",
                    // contentType: "text/html; charset=UTF-8",
                    url:"{{route('find-id')}}",
                    dataType: "json",     
                    data:{id:'{{$id}}'},
                    success:function(data, textStatus,status){
                        $('input[id="lab_order_number"]').each(function() {                        
                            $(this).val(data.lab_order_number).prop('disabled', true);
                        }); 
                        $('input[id="outid"]').each(function() {                        
                            $(this).val(data.id).prop('disabled', true);
                        });                
                        $('input[id="hn"]').each(function() {                        
                            $(this).val(data.hn).prop('disabled', true);
                        });
                        $('[id="fname"]').each(function() {                        
                            $(this).text(data.fname);
                        });
                        $('[id="lname"]').each(function() {                        
                            $(this).text(data.lname);
                        });
                        $('[id="age"]').each(function() {                        
                            $(this).text(data.age);
                        });
                        $('[id="gender"]').each(function() {                        
                            $(this).text(data.gender);
                        });
                        $('[id="speci_collected_at"]').each(function(index, ele) {                                                   
                            $(ele).text(Utils.DDMMYYYY(data.speci_collected_at.split(' ')[0]));
                        });                        
                        $('[id="physician"]').each(function(index, ele) {                        
                            $(ele).text(data.physician);
                        });    
                        $('[id="date_of_report"]').each(function() {   
                            $(this).datepicker('setDate', Utils.DDMMYYYY(data.date_of_report.split(' ')[0])); 
                        });    
                        $('[id="speci_received_at"]').each(function() {                      
                            $(this).datepicker('setDate', Utils.DDMMYYYY(data.speci_received_at.split(' ')[0]));
                        }); 
                        $('[id="clinical_history"]').each(function() {                      
                            $(this).val(data.clinical_history);
                        }); 
                        $('[id="clinical_diagnosis"]').each(function() {                      
                            $(this).val(data.clinical_diagnosis);
                        }); 
                        $('[id="pathologist"]').each(function() {                      
                            $(this).val(data.pathologist);
                        });
                        $('[id="gross_examination"]').each(function() {                      
                            $(this).val(data.gross_examination);
                        });                        
                        $('[id="gross_examiner"]').each(function() {                      
                            $(this).val(data.gross_examiner);
                        });                        
                        // console.log(data.phatology_diag_2);
                        // ตรวจสอบการแสดงหน้า Page 1,2,3,4,5
                        CKEDITOR.instances['txt_image1'].setData(data.txt_image_1);
                        CKEDITOR.instances['txt_image2'].setData(data.txt_image_2);
                        CKEDITOR.instances['txt_image3'].setData(data.txt_image_3);
                        CKEDITOR.instances['txt_image4'].setData(data.txt_image_4);
                        CKEDITOR.instances['txt_image5'].setData(data.txt_image_5);
                        
                        
                    },
                    error:function(data, textStatus, status){
                        console.log(data.responseJSON.message.errorInfo);                        
                        if (data.status === 500){                            
                            Alert.error('Eror', data.responseJSON.message.errorInfo);
                        }else if(data.status === 501){
                            Alert.error('Eror', data.responseJSON.message.errorInfo);
                            setTimeout(() => {
                                window.location.replace("/surgical/index");
                            }, 2000);
                        }
                    }
                });
            }
        </script>
    @endif

    <script> 
    
            const preview = document.getElementById('preview');
            const release = document.getElementById('release');
            const update = document.getElementById('update');
            const udo = document.getElementById('udo');            

            preview.addEventListener("click", function(){
                this.disabled = !this.disabled;
                this.style.cursor = 'not-allowed';                
                if(typeof _release !== 'undefined'){
                    release.style.cursor = 'not-allowed';
                    update.style.cursor = 'pointer';
                    release.disabled = true; 
                    update.disabled = false;
                }else{
                    release.style.cursor = 'pointer';
                    update.style.cursor = 'not-allowed';                    
                    release.disabled = false; 
                    update.disabled = true;
                }  
                udo.disabled = false;                
                udo.style.cursor = 'pointer';
                CKE.Preview(); 
            });
            
            udo.addEventListener("click", function(){  
                this.disabled = !this.disabled;
                this.style.cursor = 'not-allowed'; 

                release.disabled = true;
                update.disabled = true;
                preview.disabled = false;  
                release.style.cursor = 'not-allowed';
                preview.style.cursor = 'pointer';
                update.style.cursor = 'not-allowed'; 
                CKE.Undo();
            });
// JSON.stringify
        let canPass = false;
        let lab_order = [];
        $(function(){ 

            PageControl.FnCalPage(); //คำนวณ หน้า Page  "input[data-calendar='1']"
            const eleCalendar = $( "input[data-calendar='1']" );
            Utils.Calendar(eleCalendar);  //ใส่ปฏิทินให้ Input
            $("input[id=hn]").each(function(){ // กำหนดให้ element id="hn" ทุกตัวเป็น autocomplete โดยใช้ each function
            
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
                                    Alert.info('ไม่พบข้อมูลที่ต้องการลง HN ใหม่');
                                }else{
                                    response( data );
                                }
                            },
                            error: function (jqXHR, textStatus, err){
                                if (jqXHR.status != 200){
                                    Alert.error(err, jqXHR.responseJSON.message);
                                }
                            }
                        });
                    },
                    minLength: 1,
                    select: function( event, ui ) {                       
                        
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

                        PageControl.CountImage(ui.item.lab_order_number);

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

                    const cardhtml = `<div class="c">
                                        <div class="c-t">
                                            <div>
                                                <b>${item.lab_order_number}</b>
                                                <label>lab order number</label>
                                            </div>
                                            <div>
                                                <b>${item.hn}</b>
                                                <label>HN</label>
                                            </div>
                                        </div>        
                                        <div class="c-dt">
                                            <strong>ชื่อ</strong> ${item.fname} ${item.lname}<strong>เพศ</strong> ${item.gender}<br>
                                            <strong>อายุ</strong> ${item.age}
                                        </div>
                                        <div class="c-dt">
                                            ${item.lab_items_name}
                                            <strong>วันที่สั่ง</strong> ${item.order_date} <br>         
                                            <strong>แพทย์ผู้สั่ง</strong> ${item.doctor_name}         
                                        </div>
                                    </div>`;

                    return $("<li>")
                    .data("item.autocomplete", item)
                    .append(cardhtml)
                    .appendTo(card);
                };
            });

                                  
        });

    </script>

    
</body>
</html>