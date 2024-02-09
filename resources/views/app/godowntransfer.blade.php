@extends('layouts.contentNavbarLayout')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">    
        <h4 class="mb-4">
             TRANSFER
        </h4>
        <!-- Advanced Search -->
        <div class="card">
            <div class ="card-header d-flex justify-content-end">
                <button class="btn btn-info mx-2"> Print </button>
                <button class="btn btn-success" id = "AddRecord"> Add Record </button>
            </div>
            <div class="card-body">

                <hr class="mt-0">
                <div class="row" id="card-form">
                    <div class="row">
                        <div class ="col-md-4">
                            <div class='row'>
                                <div class="row form-floating form-floating-outline col-md-3  my-2">
                                    <input type="text" class="form-control dt-input" placeholder="Series" value = "T" readonly>
                                </div>

                                <div class="row form-floating form-floating-outline col-md-3  my-2">
                                    <input type="text" class="form-control dt-input" placeholder="Series" value = "{{$max+1}}" readonly>
                                </div>
                                

                                <div class="col-12 col-sm-12 col-md-6 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control dt-date flatpickr-range dt-input flatpickr-input" data-column="5" placeholder="StartDate to EndDate" data-column-index="4" id="dt_date" name="dt_date" >
                                        <label for="dt_date">Date</label>
                                    </div>
                                    <input type="hidden" class="form-control dt-date start_date dt-input" data-column="5" data-column-index="4" name="value_from_start_date">
                                    <input type="hidden" class="form-control dt-date end_date dt-input" name="value_from_end_date" data-column="5" data-column-index="4">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="form-group row">
                                    <label for="from-godown">From Godown</label>
                                    <!-- <div class="col-md-9"> -->
                                        <select id="from-godown" class="form-control dt-input col-md-9" onchange="getGoDown()">
                                            <option></option>
                                            
                                            @foreach($godowns as $godown)
                                                <option value="{{$godown['gdn_name']}}">{{$godown['gdn_name']}}</option>
                                            @endforeach
                                        </select>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="form-group row">
                                    <label for="to-godown" > To Godown </label>
                                    <!-- <div class="col-md-9"> -->
                                        <select id="to-godown" class="form-control dt-input" onchange = "getGoDown()">
                                            <option></option>
                                            @foreach($godowns as $godown)
                                                <option value="{{$godown['gdn_name']}}" >{{$godown['gdn_name']}}</option>
                                            @endforeach
                                        </select>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-floating form-floating-outline  my-2">
                                    <input type="text" class="form-control dt-input" placeholder="Series">
                                    <label>Ref.No.</label>
                                </div>
                        </div>
                        <div class="col-md-4 stock p3-3" style="border:1px solid black">
                           <h4 style="border-bottom:1px solid black;padding: 5px 0" > Stock </h4>
                           <h4 style="border-bottom:1px solid black;padding: 5px 0"> Now </h4>
                           <h4 style="border-bottom:1px solid black;padding: 5px 0"> Packing </h4>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mx-2" style="align-items: center;">
                        
                        <div id="EditDiv" style="display:none">
                            <div class="d-flex justify-content-end mx-2" style="align-items: center">
                                <div class="form-floating form-floating-outline col-md-6  my-2">
                                    <input type="text" class="form-control dt-input" id="EditText" placeholder="Series">
                                    <label>Edit</label>
                                </div>
                                <div><button class="btn btn-danger my-2 waves-effect waves-light mx-1" data-bs-toggle="modal" id="SaveBtn"> Save </button></div>
                            </div>
                            
                        </div>
                            <div id="DeleteDiv" style = "display:none"> <button class="btn btn-danger my-2 waves-effect waves-light mx-2" data-bs-toggle="modal" id="DeleteBtn"> Delete </button></div>
                            <div id="OpenDiv"><button class="btn btn-danger my-2 waves-effect waves-light" data-bs-toggle="modal" id="openModalBtn"> Add </button></div>
                    </div>
 
                    <div class="row">
                            <div class="col-sm-12">
                            <table class="dt-advanced-search table table-bordered dtr-column data-table dataTable no-footer" id="transfer-table" aria-describedby="DataTables_Table_2_info"  style="width: 1396px;" role="grid">
                                <thead>
                                    <tr>
                                        <td>Code</td>
                                        <td>Product</td>
                                        <td>Pack</td>
                                        <td>GST%</td>
                                        <td>Unit</td>
                                        <td>Pc/Bx</td>
                                        <td>M.R.P.</td>
                                        <td>Rate</td>
                                        <td>Qty</td>
                                        <td>Amount</td>
                                        <td>Ok</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                        </div>

                    <div class="row my-5">
                        <div class="col-md-8 by-1">
                            <span >Total Items</span>
                            <input type="text" class="col-1 dt-input" id="tot-item" placeholder="Series" value = "0">
                        </div>
                        <div class="col-md-4 d-flex justify-content-around">
                            <span>Net Amount</span>
                            <span>Net Amt</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    <!--/ Advanced Search -->
    </div>
  <!-- / Content -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalCenterTitle">Select Items</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                        <table class="dt-advanced-search table table-bordered  dtr-column data-table" id="product-table" aria-describedby="DataTables_Table_2_info" style="width: 1396px;">
                            <thead>
                            <tr>
                                @foreach($table_columns as $column)
                                    <td>{{ $column }}</td>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="btn-select-item">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalCenterTitle">Delete Item</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body"> Are you sure you want to permanently delete this item?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary" id="btn-delete-item">Yes</button>
                            </div>
                    </div>
            </div>
        </div>


        <div class="modal fade" id="modalAlert" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalCenterTitle">Message</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="modal_alert_text"> Are you sure you want to permanently delete this item?
                            </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Ok</button>
                            </div>
                    </div>
            </div>
        </div>



    <div class="content-backdrop fade"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    var columns = JSON.parse(`<?php echo json_encode($fields)?>`);

    var columnData = columns.map(c => { return { data: c }; });



    function getGoDown() {
            




            let go,from;
            go = $("#to-godown").val();
            from = $("#from-godown").val();
            // alert(go);
            // alert(from);
            if(go ==  from) {
                // alert("Same Gown Transfer not Allowed.. Please change Godown Code");
                $("#to-godown").val("");
                $("#modalAlert").modal('show');
                $("#modal_alert_text").text("Same Gown Transfer not Allowed.. Please change Godown Code");
                // $("#from-godown").
            }
        }



    $(document).ready(function() {
        // $('#transfer-table').DataTable({
        //     serverSide: false, // Since data is fetched from DBF directly
        //     processing: true,
        //     ajax: "{{url('/dbf/getRecords')}}",
        //     columns: columnData,
        //     lengthMenu: [5, 10, 25, 50, 100] // Allow users to select number of records per page
        // });

        var n_col, n_dt;
        var $tot_item = 0;
        var tabledata = [];
        // alert();
        // $("#DeleteDiv").css("display","none");
        $("#btn-select-item").click(function () {

            if (Object.keys(rowData).length == 0) return;

            $tot_item ++;
            $("#tot-item").val($tot_item);

            var html ='';
                html +=`<tr>`;
                html +=`<td data-key='code'>${rowData.code}</td>`;
                html +=`<td data-key='product'>${rowData.product}</td>`;
                html +=`<td data-key='pack'>${rowData.pack}</td>`;
                html +=`<td data-key='gst'>${rowData.gst}</td>`;
                html +=`<td data-key='unit_1'>${rowData.unit_1}</td>`;
                html +=`<td data-key='mult_f'>${rowData.mult_f}</td>`;
                html +=`<td data-key='mrp1'>${rowData.mrp1}</td>`;
                html +=`<td data-key='rate1'>${rowData.rate1}</td>`;
                html +=`<td data-key='qty'>${rowData.qty}</td>`;
                html +="<td data-key='amt'></td>";
                html +="<td data-key='ok'></td>";
                html +="</tr>";
            $("#transfer-table tbody").append(html);
            $("#modalCenter").modal('hide');
        });



 
        $("#openModalBtn").on("click", function() {
            $("#modalCenter").modal('show');
        });

        $("#DeleteBtn").on("click", function() {
            $("#modalDelete").modal('show');
        })

        var rowData = {};
        // Close modal when close button is clicked
        $(".close").on("click", function() {
            rowData = {};
            $("#modalCenter").modal('hide');
        });
        //
        var table = $('#product-table').DataTable({
                paging: true,
                serverSide: false,
                searching: true,
                ajax: "{{url('/dbf/getProducts')}}",
                lengthMenu: [5, 10, 25, 50, 100],
                columns: [
                    { data: 'code', name: 'Code' },
                    { data: 'product', name: 'Product' },
                    { data: 'pack', name: 'Pack' },
                    { data: 'gst', name: 'Gst' },
                    { data: 'mrp1', name: 'Mrp' },
                    { data: 'rate1', name: 'Rate' },
                    { data: 'mult_f', name: 'PIB' },
                    { data: 'qty', name: 'Stock'},
                    { data: 'unit_1',name: 'Unit'}
                    // Add more columns as needed
                ]
        });

        $('#AddRecord').click(function() {

            
            let dt_date = $('#dt_date').val();
            if(dt_date.length == 0 ) return ;
            let myArry = dt_date.split('-');
            dt_date = myArry[0].concat(myArry[1].concat(myArry[2]));
            
            tabledata = [];
            $("#transfer-table tbody").children('tr').map((e, item)=> {
                var rowData = {};

                $(item).children('td').map((i, td) => {
                    if ($(td).data('key').trim().length > 0)
                        rowData[$(td).data('key')] = $(td).text();
                })
                
                tabledata.push(rowData);
            })
            $.ajax({
                type : "post",
                url : "{{url('/dbf/saveRecords')}}",
                data : {
                    _token : "{{csrf_token()}}",
                    series : 'T',
                    bill : '{{$max + 1}}',
                    dt_Date : dt_date,
                    tableData: tabledata
                },
                success : function(res){
                    // alert("Success!");
                    alert(res);
                    tabledata = {};
                },
                error: function(err) {
                    console.error(err);
                }
            })
        });
        


        $('#product-table tbody').on('click', 'tr', function () {

            rowData = table.row(this).data();
            $("#product-table tbody tr").removeClass('active');
            $(this).addClass('active');
            
        });

        $('#transfer-table tbody').on('click', 'tr td', function () {
            rowData = table.row(this).data();
            $("#transfer-table tbody tr").css("background-color","white");
            $(this).parent().css("background-color","#555555");
            n_col = this;

            console.log($(this));

            $("#DeleteDiv").css("display","block");
            
            n_dt = this;
            $("#EditDiv").css("display","block");
            $("#EditText").val($(this).text());
        });

        $('#transfer-table tbody tr').on('click','td', function () {

            n_dt = this;
            $("#EditDiv").css("display","block");
            $("#EditText").val($(this).text());
        });



        $("#btn-delete-item").click(function () {

            // $(n_col).parent().css("display","none");
            var ch = $(n_col).parent().parent().children('tr');
            $(n_col).parent().remove();



            $("#modalDelete").modal('hide');

            $("#DeleteDiv").css("display","none");
            $("#OpenDiv").css("display","block");
            $("#EditDiv").hide();
        });

        $("#SaveBtn").click(function () {
            let str = $("#EditText").val();
            $(n_dt).text(str);
            $("#EditDiv").hide();
        });
        
    });
</script>
@endsection