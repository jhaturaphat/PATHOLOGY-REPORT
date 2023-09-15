<div class="header-logo">
    <img src="{{URL::asset('/images/logo.png')}}" width="65px" alt="logo">
    <p>Det udom Crown Prince Hospital <br>
        Mueang Det subdistrict, Det Udom district, <br>
        Ubonratchathani 34160, Thailand <br>
        Tel: 045-36238, 045-361133-4, 045-361971 <br>
        Fax:0-4536-2099</p>    
</div> 
<hr style="border: 1px solid gainsboro;">
<div style="text-align: center; margin-top: -10px; letter-spacing: 4px;">
    <h3>SURGICAL PHATOLOGY REPORT</h3>
</div>
<div class="pt-detail">

    <input type="hidden" id="lab_order_number">  
     
    <div class="pt-left" style="width: 50%">
        <div><label>Surgical number:</label>
            <span id="out_id" class="rx"></span>
            <input class="hn-input tx" type="text" id="out_id" value="LAB-123456" style="width: 180px;" autocomplete="off">            
        </div>
        <div><label>Name:</label><b id="fname">Ms.TAYUWEEN</b></div>
        <div><label>Age:</label><b id="age">30</b></div>
        <div><label>Date of specimen collected:</label> <b id="speci_collected_at">07-08-2023</b></div>
        <div><label>Date of reported:</label> <input type="text" id="date_of_report" data-calendar='1' style="width: 120px;" autocomplete="off"></div>
    </div>       
    <div class="pt-right" style="width: 50%">
        <div><label>HN:</label>
            <span id="out_hn" class="rx"></span>
            <input class="hn-input tx" id="hn" type="text" pattern="[0-9]{9}" value="000136217">
        </div>
        <div><label>Last name:</label><b id="lname">GOLASTSAIHJUOII</b></div>
        <div><label>Gender:</label><b id="gender">FEMALE</b></div>
        <div><label>Date of specimen received:</label> <input type="text" id="speci_received_at" data-calendar='1' style="width: 100px;" autocomplete="off"></div>
        <div><label>Requesting Physician:</label> <b id="physician">Dr. Kendrick Mcelravy</b></div>
    </div>       
</div>

<hr style="border: 1px solid gainsboro;">