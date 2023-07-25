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
        $(function(){
            $("#hn").autocomplete({
                source: function(request, response){
                    $.ajax({
                        url:"{{route('findorder')}}",
                        dataType: "json",
                        data: {
                            term:request.term
                        },
                        success: function(data){
                            console.error(data);
                            response(data);
                        }
                    });
                },
                minLength: 2,
                select: function( event, ui ) {
                    console.log(ui);
                    // console.log( "Selected: " + ui.item.fname + " aka " + ui.item.lname );
                }
            }).autocomplete("instance")._renderItem = function (table, item) {
                return $("<li>")
                .data("item.autocomplete", item)
                .append("<div class='listFullName'>" + item.fname + "</div>" + "<div class='listEmployeeID'>" + item.lname + "</div>"  + "<div class='listJobTitle'>" + item.hn + "</div>")
                .appendTo(table);
            };
           
        });
    </script>

    
</body>
</html>