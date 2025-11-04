<!-- Modal -->
<div class="modal fade" id="modalNotaDinas" tabindex="-1" aria-labelledby="modalNotaDinasLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNotaDinasLabel">Buat Nota Dinas Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formNotaDinasX" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Tanggal Nota <span class="text-danger">*</span></label>
            <input type="date" name="tanggal_nota" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Perihal <span class="text-danger">*</span></label>
            <input type="text" name="perihal" class="form-control" placeholder="Contoh: Permohonan Cuti" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Isi Nota <span class="text-danger">*</span></label>
            <textarea name="isi_nota" class="form-control" rows="4" placeholder="Tuliskan isi nota dinas..." required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Lampiran (Opsional)</label>
            <input type="file" name="lampiran" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            <div class="form-text">Format: PDF, DOC, DOCX, JPG, PNG (max 10 MB)</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="draft">Draft</option>
              <option value="approved">Disetujui</option>
            </select>
          </div>
          <div id="formResponse" class="mt-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanNota">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>