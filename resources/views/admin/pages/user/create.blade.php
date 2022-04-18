@extends('admin.layouts.app')

@push('addon-style')
<style>

</style>
@endpush

@section('title')
Tambah User
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Tambah User</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form id="form-create-user" data-action="{{ route('store-user') }}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama" autocomplete="off">
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" autocomplete="off">
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                            <option value="3" selected>None</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-icon-split simpan-user">
                            <span class="text">Simpan</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')

<script>
    jQuery('.simpan-user').on('click', function() {

        let url = jQuery('#form-create-user').data('action');

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'dataType': 'json',
            'cache': false,
            'data': {
                'nama': jQuery('input[name=nama]').val(),
                'email': jQuery('input[name=email]').val(),
                'password': jQuery('input[name=password]').val(),
                'confirmation_password': jQuery('input[name=confirmation_password]').val(),
                'role': jQuery('input[name=role]').val(),
            },
            success: function(response) {
                console.log(response);
            }
        })
    });
</script>

@endpush