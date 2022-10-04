<div class="modal modal-danger fade" id="modalHapus" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">HAPUS DATA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idHapus">
                <p style="font-weight: bold;">Anda yakin akan menghapus Data ini?<br/>                
            </div>
            <div class="modal-footer">           
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                {!! link_to('#', $title='Saya Yakin Menghapus Data', $attributes=['id'=>'yakinhapus', 'class'=>'btn btn-danger btn-shadow']) !!}
            </div>
        </div>
    </div>
</div>
{{-- <div id="fire-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md" role="document">         
        <div class="modal-content">           
            <div class="modal-header">             
                <h5 class="modal-title">Are You Sure?</h5>             
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">               
                    <span aria-hidden="true">×</span>             
                </button>           
            </div>           
            <div class="modal-body">
                <input type="hidden" id="idHapus">
                Anda yakin akan menghapus data ini ?
            </div>           
            <div class="modal-footer">           
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                {!! link_to('#', $title='Saya Yakin Menghapus Data', $attributes=['id'=>'yakinhapus', 'class'=>'btn btn-danger btn-shadow']) !!}
            </div>         
        </div>       
    </div>
</div> --}}