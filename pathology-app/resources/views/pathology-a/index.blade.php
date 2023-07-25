<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pathology report</title>
    <link rel="stylesheet" href="/js/jquery/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pathology-a.css">
</head>
<body>
    @include('pathology-a.image1')
    @include('pathology-a.image2')
    @include('pathology-a.image3')
    @include('pathology-a.image4')
    @include('pathology-a.image5')

    <button id="release" style="position: fixed; top:0; left:0; z-index:100">Release</button>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/pathology-a.js')}}"></script>
    <script>
        let canPass = false;
        $(function(){            
            // กำหนดให้ element id ทุกตัวเป็น autocomplete โดยใช้ each function
            $("[id='hn']").each(function(){
                    $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url:"{{route('findorder')}}",
                            dataType: "json",
                            data: {
                                term:request.term
                            },
                            success: function(data){
                                // console.log(data);
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function( event, ui ) {
                        // console.log(ui.item.hn);  
                        // this.value = ui.item.hn;                    
                        $('[id="hn"]').each(function() {                        
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
                        $('[id="cdate"]').each(function() {                        
                            $(this).text(ui.item.rdate);
                        });
                        $('[id="rcdate"]').each(function() {                        
                            $(this).text(ui.item.srdate);
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
                    .append("<div'> <p>" + item.fname + " " + item.lname + "</p>"  + "<h4>" + item.hn + "</h4> </div>")
                    .appendTo(card);
                };
            });
           
        });

        
    </script>

    
</body>
</html>