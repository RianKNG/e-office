<!-- Modal Tambah Nota Dinas -->
<div class="modal fade" id="exampleModalD" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Nota Dinas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addItemForm" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <!-- Nomor Nota (readonly, tidak dikirim) -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Nota</label>
                        <input type="text" class="form-control" id="nomor_nota" placeholder="Akan di-generate otomatis" readonly>
                        <small class="form-text text-muted">Nomor surat di-generate otomatis berdasarkan tanggal.</small>
                    </div>

                    <!-- Tanggal Nota -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Nota <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal_nota" id="tanggal_nota">
                        <div class="invalid-feedback" id="error_tanggal_nota"></div>
                    </div>

                    <!-- Perihal -->
                    <div class="mb-3">
                        <label class="form-label">Perihal <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="perihal" id="perihal" rows="2" required></textarea>
                        <div class="invalid-feedback" id="error_perihal"></div>
                    </div>

                    <!-- Isi Nota -->
                    <div class="mb-3">
                        <label class="form-label">Isi Nota <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="isi_nota" id="isi_nota" rows="4" required></textarea>
                        <div class="invalid-feedback" id="error_isi_nota"></div>
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-3">
                        <label class="form-label">Lampiran (PDF/DOC/JPG/PNG)</label>
                        <input type="file" class="form-control" name="lampiran" id="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted">Opsional. Maks. 10 MB.</small>
                        <div class="invalid-feedback" id="error_lampiran"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="status" id="status" required>
                        <div class="invalid-feedback" id="error_status"></div>
                    </div>

                    <!-- Created By (ID User) -->
                    <div class="mb-3">
                        <label class="form-label">ID Penulis (created_by) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="created_by" id="created_by" required>
                        <div class="invalid-feedback" id="error_created_by"></div>
                    </div>

                    <!-- Approved By (ID User) -->
                    <div class="mb-3">
                        <label class="form-label">ID Pemeriksa (approved_by) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="approved_by" id="approved_by" required>
                        <div class="invalid-feedback" id="error_approved_by"></div>
                    </div>

                    <!-- Alert Error Umum -->
                    <div id="errorAlert" class="alert alert-danger d-none"></div>

                </div>

                <div class="modal-footer">
          <button type="button" id="addButton" onclick="store()" class="btn btn-secondary" data-dismiss="modal">Add</button>
          <button type="button" id="updateButton" class="btn btn-primary">Update</button>
        </div>
            </form>
        </div>
    </div>
</div>