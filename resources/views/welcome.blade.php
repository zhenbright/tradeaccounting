@extends('layouts.app')
@section('content')
<div class="mainBody">

        <div style="position:fixed;" >
            <img src="./assets/img/logo/Vector.png"/>
        </div>

            <div class="nav-left">
                <div class="nav-left-container">
                    <a class="btn btn-primary" href="/dashboard">Invoice Bill</a>
                    <a class="btn btn-primary" href="/#">Customised Invoice</a>
                    
                    <a class="btn btn-primary" href="/#">Account Master</a>
                    <a class="btn btn-primary" href="/#">Item Group Master</a>
                    
                    <a class="btn btn-primary" href="/#">Item Master</a>
                    <a class="btn btn-primary" href="/#">Purchase Bill</a>
                    
                    <a class="btn btn-primary" href="/#">Cash Receipt</a>
                    <a class="btn btn-primary" href="/#">Cash Payment</a>
                    
                    <a class="btn btn-primary" href="/#">Cheque Receipt</a>
                    <a class="btn btn-primary" href="/#">Cheque Payment</a>
                    
                    <a class="btn btn-primary" href="/#">Journal</a>
                    <a class="btn btn-primary" href="/#">Purchase Direct</a>
                </div>

                <div class="nav-left-container">
                    
                    <a class="btn btn-primary" href="/#">Ledger</a>
                    <a class="btn btn-primary" href="/#">Balance Slip</a>
                    
                    <a class="btn btn-primary" href="/#">Cash/Credit Sale</a>
                    <a class="btn btn-primary" href="/#">Current Stock</a>
                </div>

                <div class="nav-left-container">
                    <a class="btn btn-primary" href="/#">Bill Due List</a>
                </div>
                
            </div>

            <div class="nav-center">
                
                <div class="nav-logo-img">
                    <img src="./assets/img/logo/logo_img.png"  width="100%;center"/>
                </div>
                
                <div class="nav-logo">
                    <img src="./assets/img/logo/logo_text.png"  width="100%"/>

                </div>

                <div class="nav-logo-text">
                    Ekta Enterprises A/C Year 2023 - 2024
                </div>
            </div>

            <div class="nav-right">
            
                <div class="nav-right-container">
                    <div class="nav-right-container-text">Version: R10-AUG-23-A</div>
                    <div class="nav-right-container-text">Ekta Enterprises</div>
                    <div class="nav-right-container-text">A/C Year 2023 - 2024</div>
                    <div class="nav-right-container-text">Current User:A</div>
                    <div class="nav-right-container-text">Logged at:09:42:12</div>
                </div>
 
                <div class="nav-right-container">
                    <a class="btn btn-primary" href="/#">Compact & DB Update:07.01.2024</a>
                </div>
                <div class="nav-right-container">
                    <a class="btn btn-primary" href="/#">Compact & DB Update:07.01.2024</a>
                </div>
                <div class="nav-right-container">
                    <a class="btn btn-primary" href="/#">Compact & DB Update:07.01.2024</a>
                </div>
                <div class="nav-right-container">
                    <a class="btn btn-primary" href="/#">Compact & DB Update:07.01.2024</a>
                </div>
                <div class="nav-right-container-link">
                    Your Whatsapp validity upto 31.03.2024
                </div>

                <div class="nav-right-container">
                    <div class="nav-right-container-first"> Designed & Developed by</div>
                    <div class="nav-right-container-second"> Valley System & Software</div>
                    <div class="nav-right-container-third">  
                        
                            113 samaj Bhushan Society<br/>
                            Near Navjivan Colony, Wardha Road<br/>
                            NAGPUR 440 015 (M.S)<br/>
                            Contact-89644042507/9422128427
                    </div>
                </div>
            </div>

</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>

        $(document).ready(function() {

            $("#transferbtn").on("click",function() {z
                history.pushState(null, null, '/dashboard');
            });
        });
                
        </script>

@endsection