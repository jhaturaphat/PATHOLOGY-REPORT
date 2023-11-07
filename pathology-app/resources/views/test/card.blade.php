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
            flex-direction: column;
            width: 210px;
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
            padding-right: 10px;
            width: 100%;
        } 
        .c > .c-t >div:last-child{   
            padding-left: 10px;
            width: 100%;
        }       
        .c >.c-t b{
            color: rgb(52, 57, 57);
        }
        .c >.c-t label{
            font-size: 10px;
           color: rgb(92, 114, 114);
        }
        .c > .c-dt{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="c">
        <div class="c-t">
            <div>
                <b>123456</b>
                <label>lab order number</label>
            </div>
            <div>
                <b>000088973</b>
                <label>HN</label>
            </div>
        </div>        
        <div class="c-dt">
            <strong>ชื่อ</strong> ทดสอบ โปรแกรมเด้อ <strong>เพศ</strong> ชาย<br>
            <strong>อายุ</strong> 42 ปี 8 เดือน 22 วัน
        </div>
        <div class="c-dt">
            Biopsy ไม่เกิน 2 cm
            <strong>วันที่สั่ง</strong> 01-09-2023   <br>         
            <strong>แพทย์ผู้สั่ง</strong> นพ.ทดสอบ ทดสอบโปรแกรม            
        </div>
    </div>
</body>
</html>