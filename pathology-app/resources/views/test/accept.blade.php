<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/js/jquery/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/fontawesome/css/all.min.css">
</head>
<body>
  <div id="old_drag">
    <div id="" class="draggable-item">Element 1 ที่คุณต้องการลาก</div>
    <div id="" class="draggable-item">Element 2 ที่คุณต้องการลาก</div>
    <div id="" class="draggable-item">Element 3 ที่คุณต้องการลาก</div>
  </div>
  <div id="droppable" style="position: relative;">Element ที่คุณต้องการให้ลากมาวาง</div>

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery/jquery-ui/jquery-ui.min.js')}}"></script>
</body>
</html>

<script>
    $( function() {
      $("#draggable").draggable({
        cursor: "move",
        stop: function (event, ui) {          
          $(this).remove();
        },        
      });

      $(".draggable-item").draggable({
        helper: "clone",
      });

      $("#droppable").droppable({
        // tolerance: "touch",
        classes: {
          "ui-droppable-active": "ui-state-highlight"
        },
        // drop: function (event, ui) {                 
        //   var clonedElement = $("#draggable").clone(); 
        // },
        deactivate: function( event, ui ) {
          ui.draggable.appendTo("#droppable");    
        }
      });
    } );
    </script>