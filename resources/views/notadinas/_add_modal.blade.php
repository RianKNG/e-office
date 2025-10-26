<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_nomor_nota" class="form-label">Nomor Nota</label>
                        <input type="text" class="form-control" id="edit_nomor_nota" name="nomor_nota" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit_tanggal_nota" class="form-label">tanggal Nota</label>
                     <input type="date" class="form-control" id="edit_tanggal_nota" name="tanggal_nota">
                     <!-- <input type="date" name="tanggal_nota" id="tanggal_nota" required> -->

                    </div>
                    <div class="mb-3">
                        <label for="edit_perihal" class="form-label">Perihal</label>
                        <textarea class="form-control" id="edit_perihal" name="perihal" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_isi_nota" class="form-label">Isi Nota</label>
                        <textarea class="form-control" id="edit_isi_nota" name="isi_nota" rows="4" required></textarea>
                    </div>
                     <!-- <div class="mb-3">
                        <label class="form-label">Lampiran (PDF/Image)</label>
                        <input type="file" class="form-control" id="edit_lampiran" name="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti lampiran.</small> -->
                        <!-- Tampilkan preview lampiran lama (opsional) -->
                        <!-- <div id="edit_lampiran_preview" class="mt-2"></div>
                    </div> -->
                     <div class="mb-3">
                        <label for="edit_status" class="form-label">status</label>
                     <input type="text" class="form-control" id="edit_status" name="status" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit_nama" class="form-label">Penulis</label>
                     <input type="text" class="form-control" id="edit_nama" readonly>
                    </div>
                       <div class="mb-3">
                        <label for="edit_created_by" class="form-label">created_by</label>
                     <input type="text" class="form-control" id="edit_created_by" name="created_by" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit_approved_by" class="form-label">approve_by</label>
                     <input type="text" class="form-control" id="edit_approved_by" name="approved_by" required>
                    <!-- </div>
                      <div class="mb-3">
                        <label for="edit_approved_at" class="form-label">approved_at</label>
                     <input type="date" class="form-control" id="edit_approved_at" name="approved_at" required>
                    </div> -->
                      <!-- <div class="mb-3">
                        <label for="edit_created_at" class="form-label">created_at</label>
                     <input type="date" class="form-control" id="edit_created_at" name="created_at" required>
                    </div> -->
                <!-- </div> -->
        <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="updateData()">Ubah Data</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>