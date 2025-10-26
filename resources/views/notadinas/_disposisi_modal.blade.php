<!-- Tombol -->

<!-- Modal -->
<div class="modal fade" id="disposisiModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formDisposisi">
        <input type="hidden" id="nota_id">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Disposisi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nomor Disposisi</label>
            <input type="text" id="nomor_disposisi" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Instruksi</label>
            <textarea id="instruksi" class="form-control" required></textarea>
          </div>
           <div class="mb-3">
            <label>Catatan</label>
            <textarea id="catatan" class="form-control" required></textarea>
          </div>
           <div class="mb-3">
            <label>B W</label>
            <input type="date" class="form-control"  id="batas_waktu" required>
            
          </div>
          <label for="prioritas">Prioritas</label>
                <select id="prioritas" name="prioritas" class="form-control">
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
           <label for="status">status</label>
            <select id="status" name="status" class="form-control">
                <option value="menunggu">menunggu</option>
                <option value="diproses">diproses</option>
                <option value="selesai">selesai</option>
            </select>
         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
