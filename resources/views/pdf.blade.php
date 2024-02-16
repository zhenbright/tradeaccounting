<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Webpage</title>
    <style>
        /* Add your CSS styles here */
        .left-content{
            position:absolute;
            width:45%;
            left:0px;
            top:0px;
        }
        .header{
            height: 100px;
            width: 98%;
        }
        .header-detail{
            position:absolute;
            left: 280px;
            font-size: 13px;
            top: 0px;
            width: 180px;
        }
        .right-content{
            position:absolute;
            top: 0px;
            left: 500px;
            width: 45%;
        }
        body{
            margin:0px;
            top: 0px;
            width: 1056px;
            height: 816px;
            position: relative;
        }

        .main-info{

            height: 100px;
            font-size: 15px;
            position: relative;
        }
        .main-tbl {
            height: 400px;
            width: 98%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .main-info>div{
            margin:5px;
            height: 30%;
            position: relative;
        }

        tr{
            height:30px;
        }
        table, td, tr {
            border: 1px solid;
            text-align: center;
        }
        table{
            border: 1px solid black;
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .footer{
            border-top: solid 1px black;
            border-bottom: solid 1px black;
            height: 50px;
            position: relative;
            width: 98%;
        }
        /* .footer:last-child{
            right: 0px;
            position: +
        } */
    </style>
</head>
<body>

    <div class = "left-content" style="border-right:3px dotted red;">
        <div class = "header">
            <div style="height: 70%;">
                <div style="position:relative;top: 30px;font-size: 25px; font-family: 'tahoma';">
                    EKTA ENTERPRISES
                </div>
                <div class="header-detail">
                    <div style="margin-bottom:5px">Phone : 9179174888</div>
                    <div style="margin-bottom:5px">Mobile : 9826623188</div>
                    <div style="margin-bottom:5px; font-size: 10px;">GSTN : 23AJBPS6285R1ZF</div>
                </div>
            </div>

            <div style="height: 20%;text-align: center; border-bottom: 3px solid black;font-size: 10px;top:10px;">
                BUDHWARI BAZAR,GN ROAD SEONI,,SEONI
            </div>
        </div>

        <div class = "main-info">
            <div >
                <div style="width: 45%;">
                    Voucher No. : T-{{$title}}
                </div>
                <div style="position: absolute;width: 50%;left: 50%;top:0">
                    Date : {{$date}}
                </div>
            </div>
                <div>
                    Trf.From    {{$fromdown}}
                </div>
                <div>
                    Trf.To  {{$todown}}    
                </div>
        </div>

        <div class = "main-tbl">
            <table> 
                <thead>
                    <tr>
                        <td>
                            S/N
                        </td>
                        <td >
                            Code
                        </td>
                        <td style="width: 60%;">
                            Particular
                        </td>
                        <td>
                            Pack
                        </td>
                        <td>
                            GST%
                        </td>
                        <td>
                            Unit
                        </td>
                        <td>
                            Qty
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tabledataes as $tabledata)
                    <tr>
                        <td>
                            1
                        </td>
                        <td>{{$tabledata->code}}</td>
                        <td>{{$tabledata->product}}</td>
                        <td>{{$tabledata->pack}}</td>
                        <td>{{$tabledata->gst}}</td>
                        <td>{{$tabledata->unit_1}}</td>
                        <td>{{$tabledata->qty}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div style="position: absolute; left: 20px; top: 15px;">Items {{$tot}}</div>
            <div style="position:absolute; right: 20px;top: 15px;">T.Qty 314</div>
        </div>
    
    </div>

    <div class = "right-content">
        <div class = "header">
            <div style="height: 70%;">
                <div style="position:relative;top: 30px;font-size: 25px; font-family: 'tahoma';">
                    EKTA ENTERPRISES
                </div>
                <div class="header-detail">
                    <div style="margin-bottom:5px">Phone : 9179174888</div>
                    <div style="margin-bottom:5px">Mobile : 9826623188</div>
                    <div style="margin-bottom:5px; font-size: 10px;">GSTN : 23AJBPS6285R1ZF</div>
                </div>
            </div>

            <div style="height: 20%;text-align: center; border-bottom: 3px solid black;font-size: 10px;top:10px;">
                BUDHWARI BAZAR,GN ROAD SEONI,,SEONI
            </div>
        </div>

        <div class = "main-info">
            <div >
                <div style="width: 45%;">
                    Voucher No. : T-{{$title}}
                </div>
                <div style="position: absolute;width: 50%;left: 50%;top:0">
                    Date : {{$date}}
                </div>
            </div>
                <div>
                    Trf.From    {{$fromdown}}
                </div>
                <div>
                    Trf.To  {{$todown}}    
                </div>
        </div>

        <div class = "main-tbl">
            <table> 
                <thead>
                    <tr>
                        <td>
                            S/N
                        </td>
                        <td >
                            Code
                        </td>
                        <td style="width: 60%;">
                            Particular
                        </td>
                        <td>
                            Pack
                        </td>
                        <td>
                            GST%
                        </td>
                        <td>
                            Unit
                        </td>
                        <td>
                            Qty
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tabledataes as $tabledata)
                    <tr>
                        <td>
                            1
                        </td>
                        <td>{{$tabledata->code}}</td>
                        <td>{{$tabledata->product}}</td>
                        <td>{{$tabledata->pack}}</td>
                        <td>{{$tabledata->gst}}</td>
                        <td>{{$tabledata->unit_1}}</td>
                        <td>{{$tabledata->qty}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div style="position: absolute; left: 20px; top: 15px;">Items {{$tot}}</div>
            <div style="position:absolute; right: 20px;top: 15px;">T.Qty 314</div>
        </div>
    
    </div>


</body>
</html>