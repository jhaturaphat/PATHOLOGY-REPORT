<div class="header-logo">
    <img src="{{URL::asset('/images/logo.png')}}" alt="logo">

    <p>Det udom Crown Prince Hospital <br>
        Mueang Det subdistrict, Det Udom district, <br>
        Ubonratchathani 34160, Thailand <br>
        Tel: 045-36238, 045-361133-4, 045-361971 <br>
        Fax:0-4536-2099</p>
</div> 
<div style="text-align: center; margin-top: -30px; letter-spacing: 2px;">
    <h3>SURGICAL PHATOLOGY REPORT</h3>
</div>
<div class="pt-detail">
    <table style="width: 100%;">
        <input type="hidden" id="lab_order_number">
        <tbody>            
            <tr>
                <td>Surgical number:<input class="hn-input" type="text" id="id" value="LAB-123456" style="width: 180px;"></td>
                <td>HN: <input class="hn-input" id="hn" type="text" pattern="[0-9]{9}" value="000136217"></td>
            </tr>
            <tr>
                <td>Name:<b id="fname">Ms.TAYUWEEN</b></td>
                <td>Last name:<b id="lname">GOLASTSAIHJUOII</b></td>
            </tr>
            <tr>
                <td>Age:<b id="age">30</b></td>
                <td>Gender:<b id="gender">FEMALE</b></td>
            </tr>
            <tr>
                <td>Date of specimen collected: <b id="speci_collected_at">2023-08-07</b></td>
                <td>Date of specimen received: <input type="text" id="speci_received_at" data-calendar='1' style="width: 180px;" autocomplete="off"></td>
            </tr>
            <tr>
                <td>Date of reported: <input type="text" id="date_of_report" data-calendar='1' style="width: 120px;" autocomplete="off"></td>
                <td>Requesting Physician: <b id="physician">Dr. Kendrick Mcelravy</b></td>
            </tr>
        </tbody>
    </table>        
</div>
<hr style="border: 1px solid gainsboro;">