@extends('layouts.mainLayout')
@section('css')


    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- end page title end breadcrumb -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{route('product.insert')}}">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Product Name</label>
                                <input type="text" name="ProductName" placeholder="Product Name" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Rate Per Unit</label>
                                <input type="text" name="ratePerUnit" placeholder="Rate Per Unit" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Status</label>
                               <select class="form-control col-md-12" name="status">
                                   <option>select status</option>
                                   <option>Active</option>
                                   <option>InActive</option>
                               </select>
                            </div>

                            <div class="form-group col-md-12">
                                <button class="btn btn-success pull-right">submit</button>
                            </div>

                        </div>


                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    <!-- The Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Package</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="editModalBody">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-right mb-2 mr-2">
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
                            Add Product
                        </button>
                    </div>
                    <h4 class="mt-0 header-title">All Products</h4>

                    <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Rate Per Unit</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script>
        $(document).ready( function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('product.getdata') !!}",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                },
                columns: [
                    { data: 'productName', name: 'product.ProductName' },
                    { data: 'ratePerUnit', name: 'product.ratePerUnit'},
                    { data: 'status', name: 'product.status'},
                    { "data": function(data){

                            return '<a class="btn btn-default btn-sm"  data-panel-id="'+data.ProductId+'" onclick="editProduct(this)"><i class="fa fa-edit"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });
        } );


        function editProduct(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('product.edit') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    $("#editModalBody").html(data);
                    $('#editModal').modal();
                    // console.log(data);
                }
            });
        }


        function getpackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "{!! route('package.getpackage') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                 //   $('bandwidth').val(data.bandwidth);
                  //  $('price').val(data.price);

                    document.getElementById('bandwidth').value = data.bandwidth;
                    document.getElementById('price').value = data.price;
                    document.getElementById('cablepackage').value = "Select a Package";

                }
            });
        }

        function getcablepackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "{!! route('package.cable.getpackage') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                 //   $('bandwidth').val(data.bandwidth);
                  //  $('price').val(data.price);
              
                    var price = document.getElementById('price').value ;

                    document.getElementById('price').value =   parseFloat(price) + parseFloat(data.price);

                }
            });
        }
    </script>

@endsection