<table id="datatable-editable" class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($brands as $item)

        <tr>
            <td>{{ $item->id }}</td>
            <td>{!! $item->name !!}</td>
            @if ($item->status == 1)
                <td>Unlock</td>
            @else
                <td>Lock</td>
            @endif
            <td class="actions">
                <a class="btn btn-xs btn-rounded edit-row" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-xs btn-rounded remove-row" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
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
                    <form id="form" data-parsley-validate novalidate>
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="brandName">Brand Name*</label>
                            <input type="text" name="brandName" parsley-trigger="change" required placeholder="Enter brand name" class="form-control" id="brandName">
                            <ul class="parsley-errors-list filled errorName">
                            </ul>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="status" type="checkbox" value="1">
                                <label for="status"> Activate </label>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="button" id="submit">
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

    // $('#datatable-editable tbody').on( 'click', 'tr', function () {
    //     var data = table.row( this ).data();
    //     alert(data[0]);
    // } );

    // Show modal edit
    $(".edit-row").click(function () {
        $('#myModal').modal('show');
        $(".portlet-title").html("Modal Edit");

        $(".error").remove();
        $("#brandName").removeClass("parsley-error");

        var $row = $(this).closest( 'tr' );
        var data = table.row( $row.get(0) ).data();
        var id = data[0], name = data[1], status = data[2];

        $("#id").val(id);
        $("#brandName").val(_.unescape(name));
        if (status == "Unlock") {
            // $("#status").val(1);
            status = 1;
        } else {
            // $("#status").val(0);
            status = 0;
        }
        $("#status").val(status);

        if ($("#status").val() == 1)
            $("#status").prop('checked', true);
        else
            $("#status").prop('checked', false);

        $("#status").click(function() {
            activate();
        });

        $("#reset").click(function() {
            resetModal(name, status);
        });
    });

    // Submit data
    $( "#submit" ).click(function() {
        if ($( "#id" ).val() == 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('brands.create') }}",
                data: { name: $('#brandName').val(), status: $('#status').val() }
            }).done(function( data ) {
                console.log(data);
                if (data == "success") {
                    $( '#myModal' ).modal('hide');
                    $( ".table-brand" ).load( "brands/list" );
                    toastr["success"]("Brand has been created.", "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#brandName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    }
                }
            });
        } else {
            $.ajax({
                method: "POST",
                url: "{{ route('brands.edit') }}",
                data: { id: $('#id').val(), name: $('#brandName').val(), status: $('#status').val() }
            }).done(function( data ) {
                console.log(data);
                if (data == "success") {
                    $('#myModal').modal('hide');
                    $( ".table-brand" ).load( "brands/list" );
                    toastr["success"]("Brand has been updated.", "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#brandName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    }
                }
            });
        }
    });

    // Delete brand
    $(".remove-row").click(function() {
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
                    url: "{{ route('brands.destroy') }}",
                    data: { id: id }
                }).done(function( data ) {
                    console.log(data);
                    if (data == "success") {
                        $( ".table-brand" ).load( "brands/list" );
                        toastr["success"]("Brand has been removed.", "Success!");
                    } else {
                        toastr["error"](data, "Danger!");
                    }
                });
            });
    });

    toastr.options = {
        "progressBar": true,
    };

    function activate() {
        if ($("#status").is(":checked"))
            $("#status").val(1);
        else
            $("#status").val(0);
    }

    function resetModal(name, status) {
        $( "#brandName" ).val(name);
        $( "#status" ).val(status);

        if ($("#status").val() == 1)
            $("#status").prop('checked', true);
        else
            $("#status").prop('checked', false);

        $(".error").remove();
        $("#brandName").removeClass("parsley-error");
    };
</script>