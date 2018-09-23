@extends('admin.layouts.master')

@section('title', 'Product Table')

@section('styles')
<!-- DataTables -->
        <link href="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Notification css (Toastr) -->
        <link href="{{ asset('public/admin/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert css -->
        <link href="{{ asset('public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('public/admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet">

                                    <div class="portlet-heading portlet-default">
                                        <h3 class="portlet-title">
                                            <i class="fa fa-table" aria-hidden="true"></i>
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

                                            <div class="table-product">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-12">
                                <div class="portlet">

                                    <div class="portlet-heading portlet-default">
                                        <h3 class="portlet-title">
                                            <i class="fa fa-image" aria-hidden="true"></i>
                                        </h3>
                                        <div class="portlet-widgets">
                                            <a href="javascript:;" data-toggle="reload" id="refresh-2"><i class="zmdi zmdi-refresh"></i></a>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary2"><i class="zmdi zmdi-minus"></i></a>
                                            <a href="#" data-toggle="remove"><i class="zmdi zmdi-close"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div id="bg-primary2" class="panel-collapse collapse in">
                                        <div class="portlet-body">

                                            <div class="table-product-img">
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

        <!-- CKEditor 4 -->
        <script src="https://cdn.ckeditor.com/4.7.2/standard/ckeditor.js"></script>

        <!-- CKFinder -->
        <script src="{{ asset('public/admin/assets/plugins/ckfinder/ckfinder.js') }}"></script>

        <!-- Toastr js -->
        <script type="text/javascript" src="{{ asset('public/admin/assets/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Sweet Alert js -->
        <script src="{{ asset('public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>

        <script src="{{ asset('public/admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>

        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $( ".table-product-img" ).load( "products/imgList" );
                setTimeout(function(){
                    $( ".table-product" ).load( "products/list" );
                }, 500);

                // $.get("products/imgList", function(data){
                //     $(".table-product-img").html(data);
                // });

                $( "#refresh" ).click(function() {
                    $( ".table-product" ).load( "products/list" );
                });

                $( "#refresh-2" ).click(function() {
                    $( ".table-product-img" ).load( "products/imgList" );
                });

                // Show modal create
                $( '#addToTable' ).click(function() {
                    $( '#myModal' ).modal('show');
                    $( ".portlet-title" ).html("Create Product");

                    setModal(0, '', 0, 0, '', 1, 1, 1);

                    checkStatus();

                    $( "#status" ).click(function() {
                        activate();
                    });

                    $( "#reset" ).click(function() {
                        resetModal('', 0, 0, '', 0, 1);
                    });
                });
            });
        </script>
@endsection
