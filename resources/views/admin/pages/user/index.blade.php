@extends('admin.layouts.app')

@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('title')
Users
@endsection

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Users</h4>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ route('create-user') }}" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-user"></i>
                </span>
                <span class="text">Tambah User</span>
            </a>
        </div>
        <div class="my-2"></div>
        <div class="table-responsive">
            <table class="table table-bordered" id="users" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Hapus</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Hapus</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('edit-user', $user->id) }}" data-id="{{ $user->id }}" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" data-id="{{ $user->id }}" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
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

<script>
    jQuery(document).ready(function() {
        jQuery("#users").DataTable();
    })
</script>

@endpush