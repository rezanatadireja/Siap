{{-- <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ubah Role & Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="idubah">
                @include('master.role-permission.form-ubah')
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-square btn-success" id="simpanubah">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-save') }}"></use>
                    </svg> Simpan Perubahan
                </a>
                <button type="button" class="btn btn-square btn-secondary" data-dismiss="modal">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-right') }}"></use>
                    </svg> Kembali
                </button>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ubah Role & Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="idubah">
                    <div class="col-md-12">
                        @include('role-permission.form-ubah')
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button id="simpanubah" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

@role('admin')
    @include('admin.component.modalhapus')
@endrole
