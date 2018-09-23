<table id="datatable-editable" class="table table-hover table-inverse table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $pro)

        <tr>
            <td>{{ $pro->id }}</td>
            <td>{{ $pro->name }}</td>
            <td>{{ $pro->price }} VNĐ</td>
            <td>{{ isset($pro->sale_price) ? (string)$pro->sale_price.' VNĐ' : 'none' }}</td>
            <td>{{ $pro->quantity }}</td>
            <td>{!! $pro->description !!}</td>
            @foreach($categories as $cat)
                @if($pro->cat_id == $cat->id)
                    <td>{{ $cat->name }}</td>
                    @break
                @endif
            @endforeach
            @foreach($brands as $bra)
                @if($pro->brand_id == $bra->id)
                    <td>{{ $bra->name }}</td>
                    @break
                @endif
            @endforeach
            <td>{{ $pro->status == 1 ? 'Activate' : 'Deactivate' }}</td>
            <td class="actions">
                <a class="btn btn-xs edit-row" data-id="{{ $pro->id }}" data-cat="{{ $pro->cat_id }}" data-bra="{{ $pro->brand_id }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                <a class="btn btn-xs remove-row" data-id="{{ $pro->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="portlet">

            <div class="portlet-heading bg-purple">
                <h3 class="portlet-title">Modal title</h3>
                <div class="portlet-widgets">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></a>
                    <a id="reset" href="javascript:;" class="close" data-toggle="reload"><i class="zmdi zmdi-refresh"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div id="bg-default" class="panel-collapse collapse in">
                <div class="portlet-body">
                    <form id="form" class="form-horizontal" data-parsley-validate novalidate>
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="proName" class="col-md-2 control-label">
                                Product Name <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="proName" parsley-trigger="change" required placeholder="Enter product name" class="form-control" id="proName">
                                <ul class="parsley-errors-list filled errorName">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-md-2 control-label">
                                Price <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="price" parsley-trigger="change" required placeholder="Enter price" class="form-control" id="price">
                                <ul class="parsley-errors-list filled errorPrice">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sale_price" class="col-md-2 control-label">Sale Price</label>
                            <div class="col-md-10">
                                <input type="text" name="price" parsley-trigger="change" placeholder="Enter price" class="form-control" id="sale_price">
                                <ul class="parsley-errors-list filled errorSalePrice">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-md-2 control-label">
                                Quantity <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="quantity" parsley-trigger="change" required placeholder="Enter quantity" class="form-control" id="quantity">
                                <ul class="parsley-errors-list filled errorQuantity">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-2 control-label">
                                Description <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="description"></textarea>
                                <ul class="parsley-errors-list filled errorDescription">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catID" class="col-md-2 control-label">
                                Category <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <select class="form-control" id="catID" style="width: 100%;"> @foreach ($categories as $item)

                                    <option value="{{ $item->id }}">{{ $item->name }}</option> @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="braID" class="col-md-2 control-label">
                                Brand <abbr style="border: 0; text-decoration: none;" title="required">*</abbr>
                            </label>
                            <div class="col-md-10">
                                <select class="form-control" id="braID" style="width: 100%;"> @foreach ($brands as $item)

                                        <option value="{{ $item->id }}">{{ $item->name }}</option> @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <input id="status" type="checkbox" value="1">
                                    <label for="status"> Activate </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button type="button" class="btn btn-primary waves-effect waves-light" id="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end Modal -->

<script>
    var table = $('#datatable-editable').DataTable( {
        fixedHeader: true
    } );

    $('[data-toggle="tooltip"]').tooltip();

    $("input[name='price']").TouchSpin({
        min: 0,
        max: 1000000000,
        step: 500,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        postfix: 'VNĐ'
    });

    $("input[name='quantity']").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
    });

    CKEDITOR.replace( 'description' );

    CKEDITOR.config.height = 110;

    // Show modal edit
    $("#datatable-editable").on('click', '.edit-row', function () {
        $('#myModal').modal('show');
        $(".portlet-title").html("Edit Product");

        $(".error").remove();
        $("#proName").removeClass("parsley-error");
        $("#price").removeClass("parsley-error");
        $("#quantity").removeClass("parsley-error");
        $("#description").removeClass("parsley-error");

        var $row = $(this).closest( 'tr' );
        var data = table.row( $row.get(0) ).data();
        var id = data[0],
            name = data[1],
            price = data[2].slice(0, data[2].length - 4),
            sale_price = data[3].slice(0, data[3].length - 4),
            quantity = data[4],
            description = data[5],
            catName = data[6],
            braName = data[7],
            status = data[8];
        var cat_id = $(this).data('cat');
        var bra_id = $(this).data('bra');
        // var id = $(this).data('id');

        if (status == "Activate")
            status = 1;
        else
            status = 0;

        setModal(id, name, price, sale_price, quantity, description, cat_id, bra_id, status);

        checkStatus();

        $("#status").click(function() {
            activate();
        });

        $("#reset").click(function() {
            resetModal(name, price, sale_price, quantity, description, cat_id, bra_id, status);
        });
    });

    // Submit data
    $( "#submit" ).click(function() {
        var description = CKEDITOR.instances.description.getData();
        // alert(description.slice(3, description.length - 5));
        // alert(description.substr(3, description.length - 8));
        // alert(description.substring(3, description.length - 5));
        if ($( "#id" ).val() == 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('products.create') }}",
                data: {
                    name: $('#proName').val(),
                    price: $( "#price" ).val(),
                    sale_price: $( "#sale_price" ).val(),
                    quantity: $( "#quantity" ).val(),
                    description: description.slice(3, description.length - 5),
                    cat_id: $('#catID').val(),
                    bra_id: $('#braID').val(),
                    status: $('#status').val()
                }
            }).done(function( data ) {
                console.log(data);
                if (data == "success") {
                    $( '#myModal' ).modal('hide');
                    $( ".table-product" ).load( "products/list" );
                    $('.table-product-img').load("{{ route('products.imgList') }}");
                    toastr["success"]("Product has been created.", "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#proName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    } else {
                        $("#proName").removeClass("parsley-error");
                        $(".errorName").empty();
                    }

                    if (data.errorPrice != "") {
                        $("#price").addClass("parsley-error");
                        $(".errorPrice").html(data.errorPrice);
                    } else {
                        $("#price").removeClass("parsley-error");
                        $(".errorPrice").empty();
                    }

                    if (data.errorQuantity != "") {
                        $("#quantity").addClass("parsley-error");
                        $(".errorQuantity").html(data.errorQuantity);
                    } else {
                        $("#quantity").removeClass("parsley-error");
                        $(".errorQuantity").empty();
                    }

                    if (data.errorDescription != "") {
                        $("#description").addClass("parsley-error");
                        $(".errorDescription").html(data.errorDescription);
                    } else {
                        $("#description").removeClass("parsley-error");
                        $(".errorDescription").empty();
                    }
                }
            });
        } else {
            $.ajax({
                method: "POST",
                url: "{{ route('products.edit') }}",
                data: {
                    id: $('#id').val(),
                    name: $('#proName').val(),
                    price: $( "#price" ).val(),
                    sale_price: $( "#sale_price" ).val(),
                    quantity: $( "#quantity" ).val(),
                    description: description.slice(3, description.length - 5),
                    cat_id: $('#catID').val(),
                    bra_id: $('#braID').val(),
                    status: $('#status').val()
                }
            }).done(function( data ) {
                console.log(data);
                if (data.success != null) {
                    $( '#myModal' ).modal('hide');
                    $( ".table-product" ).load( "products/list" );
                    toastr["success"](data.success, "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#proName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    } else {
                        $("#proName").removeClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    }

                    if (data.errorPrice != "") {
                        $("#price").addClass("parsley-error");
                        $(".errorPrice").html(data.errorPrice);
                    } else {
                        $("#price").removeClass("parsley-error");
                        $(".errorPrice").html(data.errorPrice);
                    }

                    if (data.errorQuantity != "") {
                        $("#quantity").addClass("parsley-error");
                        $(".errorQuantity").html(data.errorQuantity);
                    } else {
                        $("#quantity").removeClass("parsley-error");
                        $(".errorQuantity").html(data.errorQuantity);
                    }

                    if (data.errorDescription != "") {
                        $("#description").addClass("parsley-error");
                        $(".errorDescription").html(data.errorDescription);
                    } else {
                        $("#description").removeClass("parsley-error");
                        $(".errorDescription").html(data.errorDescription);
                    }
                }
            });
        }
    });

    // Delete product
    $("#datatable-editable").on('click', '.remove-row', function() {
        var id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            },
            function(){
            //   swal("Deleted!", "Your imaginary file has been deleted.", "success");

                $.ajax({
                    type: "POST",
                    url: "{{ route('products.destroy') }}",
                    data: { id: id }
                }).done(function( data ) {
                    console.log(data);
                    if (data == "success") {
                        $( ".table-product" ).load( "products/list" );
                        toastr["success"]("Product has been removed.", "Success!");
                    } else {
                        // toastr["error"](data, "Danger!");
                    }
            });
        });
    });

    toastr.options = {
        "progressBar": true,
    };

    function resetModal(name, price, sale, quantity, description, category, brand, status) {
        $( "#proName" ).val(name);
        $( "#price" ).val(price);
        $( "#sale_price" ).val(sale);
        $( "#quantity" ).val(quantity);
        // CKEDITOR.instances.description.setData(description);
        $( "#catID" ).val(category);
        $( "#braID" ).val(brand);
        $( "#status" ).val(status);

        checkStatus();

        $(".error").remove();
        $("#proName").removeClass("parsley-error");
        $("#price").removeClass("parsley-error");
        $("#quantity").removeClass("parsley-error");
        $("#description").removeClass("parsley-error");
        $("#catID").removeClass("parsley-error");
    }

    function setModal(id, name, price, sale, quantity, description, category, brand, status) {
        $( "#id" ).val(id);
        $( "#proName" ).val(name);
        $( "#price" ).val(price);
        $( "#sale_price" ).val(sale);
        $( "#quantity" ).val(quantity);
        CKEDITOR.instances.description.setData(description);
        $( "#catID" ).val(category);
        $( "#braID" ).val(brand);
        $( "#status" ).val(status);
    }

    function checkStatus() {
        if ($("#status").val() == 1)
            $("#status").prop('checked', true);
        else
            $("#status").prop('checked', false);
    }

    function activate() {
        if ($("#status").is(":checked"))
            $("#status").val(1);
        else
            $("#status").val(0);
    }
</script>
