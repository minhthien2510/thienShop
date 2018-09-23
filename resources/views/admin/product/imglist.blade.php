<input type="hidden" id="img">
<input type="hidden" id="pro_id">

<table id="datatable" class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Images</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pros as $pro)
        <tr>
            <td>{{ $pro->id }}</td>
            <td>{{ $pro->name }}</td>
            <td>
                <div class="row">
                    <form>
                @foreach ($imgs as $img)
                    @if ($pro->id == $img->pro_id)
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                            @if($img->cover_image == 1)
                            <input type="radio" name="optradio" checked data-id="{{ $img->id }}" data-pro_id="{{ $pro->id }}" data-toggle="tooltip" title="Cover image" style="display: block; position: absolute; left: 12px;">
                            @else
                                <input type="radio" name="optradio" data-id="{{ $img->id }}" data-pro_id="{{ $pro->id }}" style="display: block; position: absolute; left: 12px;">
                            @endif
                            <a class="btn btn-danger btn-xs removeImg" type="button" data-id="{{ $img->id }}" data-toggle="tooltip" title="Remove" style="display: block; position: absolute; right: 10px;">
                                {{-- <span aria-hidden="true">&times;</span> --}}<i class="fa fa-times"></i>
                            </a>
                            <img src="{{ $img->name }}" class="img-thumbnail" alt="{{ $img->name }}" height="100%" width="100%">
                        </div>
                    @endif
                @endforeach
                    </form>
                </div>
            </td>
            <td>
                <a class="btn btn-xs insert-img" data-id="{{ $pro->id }}" data-toggle="tooltip" title="Insert image"><i class="fa fa-plus-square"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    var table = $('#datatable').DataTable( {
        fixedHeader: false
    } );

    $('.insert-img').click(function() {
        $('#pro_id').val($(this).data('id'));

        CKFinder.modal( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
                $('#img').val(file.getUrl());

                $.ajax({
                    type: "POST",
                    url: "{{ route('products.createImg') }}",
                    data: { name: $('#img').val(), pro_id: $('#pro_id').val() }
                }).done(function( data ) {
                    console.log(data);
                    $( ".table-product-img" ).load( "products/imgList" );
                });
			} );

			finder.on( 'file:choose:resizedImage', function( evt ) {
                $('#img').val(evt.data.resizedUrl);

                $.post(
                    "{{ route('products.createImg') }}",
                    { name: $('#img').val(), pro_id: $('#pro_id').val() },
                    function( data ) {
                        console.log(data);
                        $( ".table-product-img" ).load( "products/imgList" );
                    }
                );
			} );
		}
        } );
    });

    $('input[name="optradio"]').on('change', function () {
        var id = $(this).data('id');
        var pro_id = $(this).data('pro_id');

        $.post(
            "{{ route('products.updateImg') }}",
            { id: id, pro_id: pro_id },
            function( data ) {
                console.log(data);
                $( ".table-product-img" ).load( "products/imgList" );
            }
        );
    });

    $('#datatable').on('click', '.removeImg', function() {
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
                $.post(
                    "{{ route('products.destroyImg') }}",
                    { id: id },
                    function( data ) {
                        console.log(data);
                        // if (data == "success")
                            $( ".table-product-img" ).load( "products/imgList" );
                    }
                );
            }
        );

        // swal({
        //     title: "Are you sure?",
        //     text: "You will not be able to recover this file!",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#DD6B55",
        //     confirmButtonText: "Yes, delete it!",
        // },
        // function(){
        //     swal("Deleted!", "Your imaginary file has been deleted.", "success");

            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: "{{ route('products.destroyImg') }}",--}}
                {{--data: { id: id }--}}
            {{--}).done(function( data ) {--}}
                {{--console.log(data);--}}
                {{--if (data == "success") {--}}
                    {{--$( ".table-product-img" ).load( "products/imgList" );--}}
                    {{--toastr["success"]("Images has been removed.", "Success!");--}}
                {{--} else {--}}
                    {{--// toastr["error"](data, "Danger!");--}}
                {{--}--}}
            {{--});--}}
        // });
    });

</script>
