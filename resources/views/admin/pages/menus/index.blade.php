@extends('admin.layouts.app')

@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('title')
{{$title}}
@endsection

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">{{$title}}</h4>
    </div>
    <div class="card-body">
        <div class="text-right">
            @can('create_user')
            <a href="{{ route('create-user') }}" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah {{$title}}</span>
            </a>
            @endcan
        </div>
        <div class="my-2"></div>
        <div class="table-responsive">
            <table class="table table-bordered" id="{{$title}}" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Hapus</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Hapus</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->parent }}</td>
                        <td>{{ $menu->url }}</td>
                        <td><i class="fas fa-fw {{ $menu->icon }}"></i></td>
                        <td class="text-center">
                            @can('edit_menu')
                            <a href="{{ route('edit-menu', $menu->id) }}" data-id="{{ $menu->id }}" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            @endcan
                        </td>
                        <td class="text-center">
                            @can('edit_menu')
                            <form method="post" class="delete-form" data-route="{{route('delete-menu',$menu->id)}}">
                                <a type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('addon-script')

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

<!-- confirmation -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    jQuery(document).ready(function() {
        jQuery("#{{$title}}").DataTable();
    })

    jQuery(".delete-form").on('click', function(e) {

        e.preventDefault();

        let url = jQuery(this).data('route');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {

                jQuery.ajax({
                    'headers': {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    'url': url,
                    'method': 'POST',
                    'dataType': 'json',
                    'cache': false,
                    'data': {
                        '_method': 'delete'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Gagal hapus data',
                                footer: '<a href=""></a>'
                            })
                        }
                    }
                })
            }
        })
    })
</script>

@endpush