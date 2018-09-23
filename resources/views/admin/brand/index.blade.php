@extends('admin.layouts.master')

@section('title', 'Brand Table')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Notification css (Toastr) -->
    <link href="{{ asset('public/admin/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert css -->
    <link href="{{ asset('public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet">

                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title">
                        Primary Heading
                    </h3>
                    <div class="portlet-widgets">
                        <a href="javascript:;" data-toggle="reload" id="refresh"><i class="zmdi zmdi-refresh"></i></a>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="zmdi zmdi-minus"></i></a>
                        <a href="#" data-toggle="remove"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="bg-primary" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="m-b-30">
                                    <button id="addToTable" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="table-brand">
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/admin/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>

    <!-- Toastr js -->
    <script type="text/javascript" src="{{ asset('public/admin/assets/plugins/toastr/toastr.min.js') }}"></script>

    <!-- Sweet Alert js -->
    <script src="{{ asset('public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( ".table-brand" ).load( "brands/list" );

            $( "#refresh" ).click(function() {
                $( ".table-brand" ).load( "brands/list" );
            });

            // Show modal create
            $( '#addToTable' ).click(function() {
                $( '#myModal' ).modal('show');
                $( ".portlet-title" ).html("Create brand");

                $( "#id" ).val(0);
                $( "#brandName" ).val('');
                $( "#status" ).val(1);

                $( "#reset" ).click(function() {
                    resetModal(null, 1);
                });

                $( "#status" ).click(function() {
                    activate();
                });

                if ($("#status").val() == 1)
                    $("#status").prop('checked', true);
                else
                    $("#status").prop('checked', false);
            });
        });
    </script>
@endsection