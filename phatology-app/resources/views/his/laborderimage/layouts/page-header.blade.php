<page size="A4" id="page1">
    <div class="header-logo">
        <img src="{{URL::asset('/images/logo.png')}}" alt="logo">
    
        <p>Det udom Crown Prince Hospital <br>
            Mueang Det subdistrict, Det Udom district, <br>
            Ubonratchathani 34160, Thailand <br>
            Tel: 045-36238, 045-361133-4, 045-361971 <br>
            Fax:0-4536-2099</p>
    </div> 
    <div style="text-align: center; margin-top: -10px">
        <h3>SURGICAL PHATOLOGY REPORT</h3>
    </div>
    <div class="pt-detail">
        <table style="width: 100%; padding: 0 45px 0 45px;">
            <tr>
                <td>Surgical number:<b>LAB-569585</b></td>
                <td>HN: <input class="hn-input" type="text"></td>
            </tr>
            <tr>
                <td>Name:<b>Ms.TAYUWEEN</b></td>
                <td>Last name:<b>GOLASTSAIHJUOII</b></td>
            </tr>
            <tr>
                <td>Age:<b>30</b></td>
                <td>Gender:<b>FEMALE</b></td>
            </tr>
            <tr>
                <td>Date of specimen collected: <b>2023-08-07</b></td>
                <td>Date of specimen received: <b>2023-08-07</b></td>
            </tr>
            <tr>
                <td>Date of reported: <b>2023-08-07</b></td>
                <td>Requesting Physician: <b>Dr. Kendrick Mcelravy</b></td>
            </tr>
        </table>        
    </div>
    <hr style="margin: 5px 50px 10px 50px">
    <button id="downloadpng" data-html2canvas-ignore>Download PNG</button>
    @yield('report-a')
    
</page>

<script src="{{asset('/js/plugins/html2canvas.js')}}"></script>
    <script>
        document.getElementById("downloadpng").onclick = function(){            
            let screenshotTarget = document.getElementById("page1");
            const oldShadow = screenshotTarget.style.boxShadow;
            screenshotTarget.style.boxShadow = "none";
            screenshotTarget = document.getElementById("page1");
            
            html2canvas(screenshotTarget,{
                allowTaint: false, imageTimeout:30000
            }).then((canvas)=>{
                const base64image = canvas.toDataURL("image/png");
                var anchor = document.createElement('a');                
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download","my-image.png");
                anchor.click();
                anchor.remove();
                screenshotTarget.style.boxShadow = oldShadow;
            })
        }
        
    </script>

