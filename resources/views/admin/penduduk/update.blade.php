<div class="modal fade" id="editPenduduk">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"">
        <form action="{{ url('penduduk.update')}}" method="PUT" id="form-edit">
            @csrf
        <div class="modal-header">	
            <h5 class="modal-title">Edit Penduduk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer bg-whitesmoke">
            <button type="button" class="btn btn-primary btn-update">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
        </form>
        </div>
    </div>
</div>