<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .c{
            display: flex;
            flex-direction: row;
        }
        .c > .c-t{
            display: flex;    
            flex-direction: column; 
            text-align: center;
            /* border: 1px solid black; */
            padding: 2px;
        }
        .c >.c-t b{
            color: rgb(52, 57, 57);
        }
        .c >.c-t label{
            font-size: 10px;
           color: rgb(92, 114, 114);
        }
    </style>
</head>
<body>
    <div class="c">
        <div class="c-t">
            <b>123456</b>
            <label>lab order number</label>
        </div>
        <div class="c-t">
            <b>000088973</b>
            <label>HN</label>
        </div>
    </div>
</body>
</html>