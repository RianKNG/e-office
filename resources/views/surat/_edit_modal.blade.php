<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Edit Surat</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="formEditSurat">
        <div class="modal-body">
            
            <input type="hidden" id="edit_id" name="id">

            <div class="form-group">
              <label>Nomor Surat</label>
              <input type="text" id="edit_nomor_surat" name="nomor_surat" class="form-control">
            </div>

            <div class="form-group">
              <label>Perihal</label>
              <input type="text" id="edit_perihal" name="perihal" class="form-control">
            </div>

            <div class="form-group">
              <label>Tempat Pembuatan</label>
              <input type="text" id="edit_tempat" name="tempat_pembuatan" class="form-control">
            </div>

            <div class="form-group">
              <label>Jabatan Pembuat</label>
              <input type="text" id="edit_jabatan" name="jabatan_pembuat" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
