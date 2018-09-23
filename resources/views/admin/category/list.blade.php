<table id="datatable-editable" class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($cats as $cat)

        <tr>
            <td>{{ $cat->id }}</td>
            <td>{!! $cat->name !!}</td>
            @if($cat->parent_id == 0)
                <td>null</td>
            @else
                @foreach($pcat as $item)
                    @if($cat->parent_id == $item->id)
                        <td>{{ $item->name }}</td>
                        @break
                    @endif
                @endforeach
            @endif
            @if ($cat->status == 1)
                <td>Activate</td>
            @else
                <td>Deactivate</td>
            @endif
            <td class="actions">
                <a class="btn btn-xs btn-rounded edit-row" data-id="{{ $cat->id }}" data-parent="{{ $cat->parent_id }}" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-xs btn-rounded remove-row" data-id="{{ $cat->id }}" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
                            <label for="catName">Category Name*</label>
                            <input type="text" name="catName" parsley-trigger="change" required placeholder="Enter category name" class="form-control" id="catName">
                            <ul class="parsley-errors-list filled errorName">
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Parent category*</label>
                            <select class="form-control" id="parentID" style="width: 100%;">
                                <option value="0">null</option> @foreach ($cats as $key)

                                <option value="{{ $key->id }}">{{ $key->name }}</option> @endforeach

                            </select>
                            <ul class="parsley-errors-list filled errorParent">
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
                                Submit
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
        $("#catName").removeClass("parsley-error");
        $("#parentID").removeClass("parsley-error");

        var $row = $(this).closest( 'tr' );
        var data = table.row( $row.get(0) ).data();
        var id = data[0], name = data[1], parentName = data[2], status = data[3];
        var parent = $(this).data('parent');

        $("#id").val(id);
        $("#catName").val(_.unescape(name));
        $("#parentID").val(parent);
        if (status == "Activate") {
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
            resetModal(name, parent, status);
        });
    });

    // Submit data
    $( "#submit" ).click(function() {
        if ($( "#id" ).val() == 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('categories.create') }}",
                data: { name: $('#catName').val(), parent_id: $('#parentID').val(), status: $('#status').val() }
            }).done(function( data ) {
                console.log(data);
                if (data == "success") {
                    $( '#myModal' ).modal('hide');
                    $( ".table-category" ).load( "categories/list" );
                    toastr["success"]("Category has been created.", "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#catName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    }
                    if (data.errorParent != "") {
                        $("#catParent").addClass("parsley-error");
                        $(".errorParent").html(data.errorParent);
                    }
                }
            });
        } else {
            $.ajax({
                method: "POST",
                url: "{{ route('categories.edit') }}",
                data: { id: $('#id').val(), name: $('#catName').val(), parent_id: $('#parentID').val(), status: $('#status').val() }
            }).done(function( data ) {
                console.log(data);
                if (data == "success") {
                    $('#myModal').modal('hide');
                    $( ".table-category" ).load( "categories/list" );
                    toastr["success"]("Category has been updated.", "Success!");
                } else {
                    if (data.errorName != "") {
                        $("#catName").addClass("parsley-error");
                        $(".errorName").html(data.errorName);
                    }
                    if (data.errorParent != "") {
                        $("#catParent").addClass("parsley-error");
                        $(".errorParent").html(data.errorParent);
                    }
                }
            });
        }
    });

    // Delete category
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
                    url: "{{ route('categories.destroy') }}",
                    data: { id: id }
                }).done(function( data ) {
                    console.log(data);
                    if (data == "success") {
                        $( ".table-category" ).load( "categories/list" );
                        toastr["success"]("Category has been removed.", "Success!");
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

    function resetModal(name, parent, status) {
        $( "#catName" ).val(name);
        $( "#parentID" ).val(parent);
        $( "#status" ).val(status);

        if ($("#status").val() == 1)
            $("#status").prop('checked', true);
        else
            $("#status").prop('checked', false);

        $(".error").remove();
        $("#catName").removeClass("parsley-error");
        $("#parentID").removeClass("parsley-error");
    };
</script>
