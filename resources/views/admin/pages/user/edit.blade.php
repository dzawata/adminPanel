@extends('admin.layouts.app')

@push('addon-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet">
<style>
    .help-block {
        font-style: italic;
        color: red;
    }
</style>
@endpush

@section('title')
Edit User
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Edit User</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form id="form-create-user" data-action="{{ route('update-user', $user->id) }}" data-page-url="{{ route('users') }}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama" autocomplete="off" value="{{ $user->name }}">
                        <p class="help-block help-block-nama"></p>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" autocomplete="off" value="{{ $user->email }}">
                        <p class="help-block help-block-email"></p>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                        <p class="help-block help-block-password"></p>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select id="role" name="role" data-value="{{ $user->role }}" multiple>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        <p class="help-block help-block-role"></p>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-icon-split kembali">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split simpan-user">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>
<script>
    let pageUrl = jQuery('#form-create-user').data('page-url');

    const displaySelect = new SlimSelect({
        select: '#role'
    })
    displaySelect.set(jQuery("#role").data('value'));

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
                '_method': 'PUT',
                'nama': jQuery('input[name=nama]').val(),
                'email': jQuery('input[name=email]').val(),
                'password': jQuery('input[name=password]').val(),
                'role': jQuery('select[name=role]').val(),
            },
            success: function(response) {
                if (response.status) {
                    tata.success('Sukses simpan data', '', {
                        position: 'tr'
                    });
                    jQuery('.help-block').html('');

                    setTimeout(() => {
                        window.location.href = pageUrl;
                    }, 4000);
                } else {
                    console.log(response);
                    tata.error('Gagal simpan data, hubungi admin', '', {
                        position: 'tr'
                    });
                }
            },
            error: function(response) {
                if (response.responseJSON !== undefined) {

                    jQuery('.help-block').html('');

                    let data = response.responseJSON.errors;
                    for (let key in data) {
                        jQuery('.help-block-' + key).html(`${data[key]}`);
                    }
                }
            }
        })
    });

    jQuery('.kembali').on('click', function() {
        window.location.href = pageUrl;
    })
</script>

@endpush