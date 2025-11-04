<!-- Modal Pilih Template Surat -->
<div class="modal fade" id="templateSuratModalDua" tabindex="-1" aria-labelledby="templateSuratLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="templateSuratLabel">Pilih Template Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">

          <!-- Surat Undangan -->
          <div class="col-md-6">
            <div class="card border p-3 h-100 text-start">
              <h6 class="fw-bold mb-1">Surat Undangan</h6>
              <p class="text-muted small mb-3">Template untuk surat undangan rapat atau kegiatan</p>
              <button class="btn btn-outline-primary btn-sm mt-auto pilih-template" data-template="undangan">
                Pilih
              </button>
            </div>
          </div>

          <!-- Surat Edaran -->
          <div class="col-md-6">
            <div class="card border p-3 h-100 text-start">
              <h6 class="fw-bold mb-1">Surat Edaran</h6>
              <p class="text-muted small mb-3">Template untuk surat edaran internal</p>
              <button class="btn btn-outline-primary btn-sm pilih-template" data-template="edaran">
                Pilih
              </button>
            </div>
          </div>

          <!-- Surat Pengumuman -->
          <div class="col-md-6">
            <div class="card border p-3 h-100 text-start">
              <h6 class="fw-bold mb-1">Surat Pengumuman</h6>
              <p class="text-muted small mb-3">Template untuk surat pengumuman</p>
              <button class="btn btn-outline-primary btn-sm pilih-template" data-template="pengumuman">
                Pilih
              </button>
            </div>
          </div>

          <!-- Surat Tugas -->
          <div class="col-md-6">
            <div class="card border p-3 h-100 text-start">
              <h6 class="fw-bold mb-1">Surat Tugas</h6>
              <p class="text-muted small mb-3">Template untuk surat tugas perintah</p>
              <button class="btn btn-outline-primary btn-sm pilih-template" data-template="tugas">
                Pilih
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.pilih-template');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const jenis = this.getAttribute('data-template');

            // Simulasi ambil template dari server
            fetch(`/api/template-surat/${jenis}`)
                .then(res => res.json())
                .then(data => {
                    // Masukkan hasil template ke textarea
                    document.querySelector('#isi_surat').value = data.template;
                    
                    // Tutup modal
                    const modal = bootstrap.Modal.getInstance(document.querySelector('#templateSuratModal'));
                    modal.hide();
                })
                .catch(err => {
                    alert('Gagal memuat template!');
                    console.error(err);
                });
        });
    });
});
</script>
