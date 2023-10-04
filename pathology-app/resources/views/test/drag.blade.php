<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST Dragable</title>
    <link rel="stylesheet" href="/js/jquery/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
</head>
<body>
    
    <div id="draggable" class="ui-state-highlight">Drag me down</div>
    <div id="sortable">
        <div class="ui-state-default">Item 1</div>
        <div class="ui-state-default">Item 2</div>
        <div class="ui-state-default">Item 3</div>
        <div class="ui-state-default">Item 4</div>
        <div class="ui-state-default">Item 5</div>
    </div>
    <div>
        <button id="cmdTest">Test</button>
    </div>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/jquery-ui.min.js')}}"></script>
</body>
</html>

<script>
    $( function() {
      $( "#sortable" ).sortable({
        revert: true
      });
      $( "#draggable" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
      $( "div[id='sortable'], div[class='ui-state-default']" ).disableSelection();

      $('#cmdTest').click(function(){
        let eleList = document.querySelectorAll(".ui-state-default");
        console.log(eleList);
      });

    } );
    </script>