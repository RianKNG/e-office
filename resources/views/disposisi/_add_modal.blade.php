<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Nota Dinas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addItemForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="errorAlert" class="alert alert-danger d-none"></div>

                    <!-- Nomor Nota -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Nota</label>
                        <input type="text" class="form-control" id="nomor_nota" name="nomor_nota" readonly placeholder="Akan di-generate otomatis">
                        <div class="invalid-feedback" id="error_nomor_nota"></div>
                        <small class="form-text text-muted">Nomor surat akan di-generate otomatis berdasarkan jenis dan tanggal.</small>
                    </div>

                    <!-- Tanggal Nota -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Nota</label>
                        <input type="date" class="form-control" id="tanggal_nota" name="tanggal_nota">
                        <div class="invalid-feedback" id="error_tanggal_nota"></div>
                    </div>

                    <!-- Perihal -->
                    <div class="mb-3">
                        <label class="form-label">Perihal</label>
                        <textarea class="form-control" id="perihal" name="perihal" rows="2"></textarea>
                        <div class="invalid-feedback" id="error_perihal"></div>
                    </div>

                    <!-- Isi Nota -->
                    <div class="mb-3">
                        <label class="form-label">Isi Nota</label>
                        <textarea class="form-control" id="isi_nota" name="isi_nota" rows="4"></textarea>
                        <div class="invalid-feedback" id="error_isi_nota"></div>
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-3">
                        <label class="form-label">Lampiran (PDF/Image)</label>
                        <input type="file" class="form-control" id="lampiran" name="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div class="invalid-feedback" id="error_lampiran"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
                        <div class="invalid-feedback" id="error_status"></div>
                    </div>

                    <!-- Created By -->
                    <div class="mb-3">
                        <label class="form-label">Created By</label>
                        <input type="text" class="form-control" id="created_by" name="created_by">
                        <div class="invalid-feedback" id="error_created_by"></div>
                    </div>

                    <!-- Approved By -->
                    <div class="mb-3">
                        <label class="form-label">Approved By</label>
                        <input type="text" class="form-control" id="approved_by" name="approved_by">
                        <div class="invalid-feedback" id="error_approved_by"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>