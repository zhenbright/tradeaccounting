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
                <button class="btn btn-info mx-2"> All Records </button>
                <button class="btn btn-success"> Add Record </button>
            </div>
            <div class="card-body">

                <hr class="mt-0">
                <div class="card-datatable table-responsive" id="card-datatable" style="display:none;" >
                    <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="dt-advanced-search table table-bordered  dtr-column data-table" id="transfer-table" aria-describedby="DataTables_Table_2_info" style="width: 1396px;">
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
                        </div>
                    </div>
                </div>
                <div class="row" id="card-form">
                    <div class="row">
                        <div class ="col-md-4">
                            <div class='row'>
                                <div class="form-floating form-floating-outline col-md-6  my-2">
                                    <input type="text" class="form-control dt-input" placeholder="Series">
                                    <label>Series</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control dt-date flatpickr-range dt-input flatpickr-input" data-column="5" placeholder="StartDate to EndDate" data-column-index="4" id="dt_date" name="dt_date" readonly="readonly">
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
                                        <select id="from-godown" class="form-control dt-input col-md-9">
                                            <option></option>
                                            
                                            @foreach($godowns as $godown)
                                                <option value="f-{{$godown['gdn_name']}}">{{$godown['gdn_name']}}</option>
                                            @endforeach
                                        </select>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="form-group row">
                                    <label for="to-godown" > To Godown </label>
                                    <!-- <div class="col-md-9"> -->
                                        <select id="to-godown" class="form-control dt-input">
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
                    <div class="d-flex justify-content-end mx-2">
                        <button class="btn btn-danger my-2 waves-effect waves-light" data-bs-toggle="modal" id="openModalBtn"> Add </button>
                    </div>
                    <div class="row">
                        <table class="dt-advanced-search table table-bordered  dtr-column data-table" id="transfer-table" style="width: 1396px;">
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
                                <!-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-8 by-1">
                            <span>Total Items</span>
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
    <div class="content-backdrop fade"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    var columns = JSON.parse(`<?php echo json_encode($fields)?>`);

    var columnData = columns.map(c => { return { data: c }; });

    $(document).ready(function() {
        // $('#transfer-table').DataTable({
        //     serverSide: false, // Since data is fetched from DBF directly
        //     processing: true,
        //     ajax: "{{url('/dbf/getRecords')}}",
        //     columns: columnData,
        //     lengthMenu: [5, 10, 25, 50, 100] // Allow users to select number of records per page
        // });

        $("#openModalBtn").on("click", function() {
            $("#modalCenter").modal('show');
        });
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
                    { data: 'qty', name: 'Stock'}
                    // Add more columns as needed
                ]
        });
        
        $('#product-table tbody').on('click', 'tr', function () {
            // Get the data from the clicked row
            rowData = table.row(this).data();
            
            $("#product-table tbody tr").removeClass('active');
            $(this).addClass('active');
            
        });

        $("#btn-select-item").click(function () {
            if (Object.keys(rowData).length == 0) return;
            var html ='';
                html +="<tr>";
                html +=`<td>${rowData.code}</td>`;
                html +=`<td>${rowData.product}</td>`;
                html +=`<td>${rowData.pack}</td>`;
                html +=`<td>${rowData.gst}</td>`;
                html +=`<td></td>`;
                html +=`<td>${rowData.mult_f}</td>`;
                html +=`<td>${rowData.mrp1}</td>`;
                html +=`<td>${rowData.rate1}</td>`;
                html +=`<td>${rowData.qty}</td>`;
                html +="<td></td>";
                html +="<td></td>";
                html +="<tr>";
            $("#transfer-table tbody").append(html);
            $("#modalCenter").modal('hide');
        })
    });
</script>
@endsection