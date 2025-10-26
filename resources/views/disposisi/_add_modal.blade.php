<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Disposisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="/disposisi/add" method="POST" enctype="multipart/form-data" id="suratForm">
                    @csrf 
                    
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="id">

                    <div class="mb-3">
                        <label for="add_nomor_disposisi" class="form-label">Nomor Disposisi</label>
                        <input type="text" class="form-control" id="add_nomor_disposisi" name="nomor_disposisi" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_id_surat_masuk" class="form-label">Surat Masuk</label>
                        <input type="text" class="form-control" id="add_id_surat_masuk" name="id_surat_masuk" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="add_dari_user" class="form-label">Dari User</label>
                        <input type="text" class="form-control" id="add_dari_user" name="dari_user" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="add_kepada_user" class="form-label">Kepada User</label>
                        <input type="text" class="form-control" id="add_kepada_user" name="kepada_user" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_instruksi" class="form-label">Instruksi</label>
                        <input type="text" class="form-control" id="add_instruksi" name="instruksi">
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="add_catatan" name="catatan" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_batas_waktu" class="form-label">Batas Waktu</label>
                        <input type="date" class="form-control" id="add_batas_waktu" name="batas_waktu" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_prioritas" class="form-label">Prioritas</label>
                        <input type="text" class="form-control" id="add_prioritas" name="prioritas" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add-status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="add-status" name="status" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_created_by" class="form-label">Created By</label>
                        <input type="text" class="form-control" id="edit_created_by" name="created_by" required>
                    </div>
                    
                    </form>
            </div>
            
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                
                <button type="button" class="btn btn-primary" onclick="addData()">Simpan Data</button>
                
            </div>
        </div>
    </div>
</div>