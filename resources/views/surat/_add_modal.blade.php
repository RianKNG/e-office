<!-- Modal Tambah Surat -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="formTambahSurat" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Jenis Surat</label>
            <select name="jenis_surat" class="form-control" required>
              <option value="">-- Pilih Jenis --</option>
              <option value="Surat Undangan">Surat Undangan</option>
              <option value="Surat Edaran">Surat Edaran</option>
              <option value="Surat Pengumuman">Surat Pengumuman</option>
              <option value="Surat Tugas">Surat Tugas</option>
              <option value="Surat Keputusan">Surat Keputusan</option>
              <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
            </select>
          </div>

          <div class="form-group">
            <label>Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Perihal</label>
            <input type="text" name="perihal" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Isi Surat</label>
            <textarea name="isi_surat" rows="4" class="form-control" required></textarea>
          </div>
        
          <div class="form-group">
            <label>Tempat Pembuatan</label>
            <input type="text" name="tempat_pembuatan" class="form-control">
          </div>

          <div class="form-group">
            <label>Jabatan Pembuat</label>
            <input type="text" name="jabatan_pembuat" class="form-control">
          </div>

          <div class="form-group">
            <label>Sifat Surat</label>
            <input type="text" name="sifat_surat" class="form-control">
          </div>

          <div class="form-group">
            <label>Derajat Keamanan</label>
            <input type="text" name="derajat_keamanan" class="form-control">
          </div>
          <div class="form-group">
            <label>Catatan Tambahan (Optional)</label>
            <input type="text" name="catatan_tambahan" class="form-control">
          </div>

           <div class="form-group">
            <label>Nama</label>
            <input type="text" name="user_id" value="{{ auth()->user()->username }}">
          </div>

          <div class="form-group">
            <label>Berkas Surat (Optional)</label>
            <input type="file" name="berkas_surat" class="form-control-file">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
