@extends('admin.layouts.app')

@push('addon-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet">
</link>
<style>
    .help-block {
        font-style: italic;
        color: red;
    }
</style>
@endpush

@section('title')
{{$title}}
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">{{$title}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form id="form-create-permission" data-action="{{ route('store-permission') }}" data-page-url="{{ route('permissions') }}">
                    <div class="form-group">
                        <label>Permission</label>
                        <input class="form-control" type="text" name="permission" autocomplete="off">
                        <p class="help-block help-block-permission"></p>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-icon-split kembali">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split simpan-permission">
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

<script>
    let pageUrl = jQuery('#form-create-permission').data('page-url');

    jQuery('.simpan-permission').on('click', function() {
        let url = jQuery('#form-create-permission').data('action');

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'dataType': 'json',
            'cache': false,
            'data': {
                'permission': jQuery('input[name=permission]').val()
            },
            success: function(response) {
                console.log(response);
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