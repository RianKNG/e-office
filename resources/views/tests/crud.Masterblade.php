@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@section('content')

<div class="form-container fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Buat Surat Baru</h5>
        <div>
            <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="saveAsDraft()">
                <i class="bi bi-save"></i> Simpan Draft
            </button>
        </div>
    </div>
    
        <form id="buatSuratForm" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                <select class="form-select" id="jenisSurat" name="jenis_surat" required>
                    <option value="">Pilih Jenis Surat</option>
                    <option value="edaran">Surat Edaran</option>
                    <option value="undangan">Surat Undangan</option>
                    <option value="pengumuman">Surat Pengumuman</option>
                    <option value="tugas">Surat Tugas</option>
                    <option value="keputusan">Surat Keputusan</option>
                    <option value="pemberitahuan">Surat Pemberitahuan</option>
                    <option value="keterangan">Surat Keterangan</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomorSurat" name="nomor_surat" placeholder="Auto Generate" readonly required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggalSurat" name="tanggal_surat" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Perihal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Masukkan perihal surat" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tujuan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Masukkan tujuan surat" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Isi Surat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="isiSurat" name="isi_surat" rows="12" placeholder="Tulis isi surat di sini..." required></textarea>
            <div class="form-text">
                <small>Tip: Gunakan format surat yang baku dan jelas</small>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Lampiran</label>
                <input type="file" class="form-control" id="lampiran" name="lampiran" multiple accept=".pdf,.doc,.docx,.xls,.xlsx">
                <div class="form-text">
                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX (max 5MB)</small>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Sifat Surat <span class="text-danger">*</span></label>
                <select class="form-select" id="sifatSurat" name="sifat_surat" required>
                    <option value="biasa">Biasa</option>
                    <option value="penting">Penting</option>
                    <option value="rahasia">Rahasia</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Klasifikasi Surat</label>
                <select class="form-select" name="klasifikasi">
                    <option value="">Pilih Klasifikasi</option>
                    <option value="umum">Umum</option>
                    <option value="penting">Penting</option>
                    <option value="rahasia">Rahasia</option>
                    <option value="sangat_rahasia">Sangat Rahasia</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Derajat Keamanan</label>
                <select class="form-select" name="derajat">
                    <option value="">Pilih Derajat</option>
                    <option value="terbuka">Terbuka</option>
                    <option value="terbatas">Terbatas</option>
                    <option value="rahasia">Rahasia</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Pembuatan</label>
                <input type="text" class="form-control" name="tempat" placeholder="Contoh: Yogyakarta">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jabatan Pembuat</label>
                <input type="text" class="form-control" name="jabatan" placeholder="Contoh: Kepala Bagian" value="<?php echo isset($_SESSION['jabatan']) ? $_SESSION['jabatan'] : ''; ?>">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Catatan Tambahan</label>
            <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan tambahan (opsional)"></textarea>
        </div>
        
        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Surat
            </button>
            <button type="button" class="btn btn-outline-primary" onclick="previewSurat()">
                <i class="bi bi-eye"></i> Preview
            </button>
            <button type="button" class="btn btn-outline-secondary" onclick="loadTemplate()">
                <i class="bi bi-file-earmark-text"></i> Load Template
            </button>
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
        </div>
    </form>
</div>

<!-- Template Modal -->
<div class="modal fade" id="templateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Template Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="undangan">
                            <div class="card-body">
                                <h6 class="card-title">Surat Undangan</h6>
                                <p class="card-text">Template untuk surat undangan rapat atau kegiatan</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="edaran">
                            <div class="card-body">
                                <h6 class="card-title">Surat Edaran</h6>
                                <p class="card-text">Template untuk surat edaran internal</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="pengumuman">
                            <div class="card-body">
                                <h6 class="card-title">Surat Pengumuman</h6>
                                <p class="card-text">Template untuk surat pengumuman</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="tugas">
                            <div class="card-body">
                                <h6 class="card-title">Surat Tugas</h6>
                                <p class="card-text">Template untuk surat tugas perintah</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent" class="border p-4" style="min-height: 400px;">
                    <!-- Preview content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.template-card {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.template-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.template-card.selected {
    border-color: var(--primary-color);
    background: rgba(0, 102, 204, 0.05);
}

#previewContent {
    font-family: 'Times New Roman', serif;
    line-height: 1.6;
}

#previewContent h1, #previewContent h2, #previewContent h3, #previewContent h4, #previewContent h5, #previewContent h6 {
    font-family: 'Times New Roman', serif;
    font-weight: bold;
}

#previewContent .letter-header {
    text-align: right;
    margin-bottom: 20px;
}

#previewContent .letter-content {
    text-align: justify;
}

#previewContent .letter-footer {
    margin-top: 50px;
}
</style>


@endsection
<script>
// Template data
const templates = {
    undangan: {
        jenis: 'undangan',
        perihal: 'Undangan Rapat',
        isi: `Assalamu'alaikum wr. wb.

Dengan hormat,

Bersama ini kami mengundang Bapak/Ibu untuk menghadiri rapat yang akan diselenggarakan pada:

Hari/Tanggal : [isi hari dan tanggal]
Waktu       : [isi waktu]
Tempat      : [isi tempat]
Acara       : [isi acara]

Demikian undangan ini kami sampaikan, atas perhatian dan kehadirannya kami ucapkan terima kasih.

Wassalamu'alaikum wr. wb.`
    },
    edaran: {
        jenis: 'edaran',
        perihal: 'Edaran Internal',
        isi: `Sehubungan dengan [isi keperluan], dengan ini kami edarkan kepada seluruh pegawai untuk:

1. [point 1]
2. [point 2]
3. [point 3]

Demikian edaran ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.`
    },
    pengumuman: {
        jenis: 'pengumuman',
        perihal: 'Pengumuman',
        isi: `Diberitahukan kepada seluruh pegawai bahwa [isi pengumuman].

Hal ini berlaku mulai tanggal [isi tanggal] sampai dengan [isi tanggal akhir].

Atas perhatiannya diucapkan terima kasih.`
    },
    tugas: {
        jenis: 'tugas',
        perihal: 'Surat Tugas',
        isi: `Berdasarkan [dasar pemberian tugas], dengan ini menugaskan:

Nama    : [isi nama]
NIP     : [isi NIP]
Jabatan : [isi jabatan]

Untuk melaksanakan tugas:
- [isi tugas 1]
- [isi tugas 2]
- [isi tugas 3]

Pelaksanaan tugas dilaksanakan mulai tanggal [isi tanggal] sampai dengan [isi tanggal selesai].

Demikian surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.`
    }
};

// Load template function
function loadTemplate() {
    const modal = new bootstrap.Modal(document.getElementById('templateModal'));
    modal.show();
}

// Select template
document.addEventListener('DOMContentLoaded', function() {
    const templateCards = document.querySelectorAll('.template-card');
    
    templateCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            templateCards.forEach(c => c.classList.remove('selected'));
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Get template data
            const templateType = this.dataset.template;
            const template = templates[templateType];
            
            if (template) {
                // Fill form with template data
                document.getElementById('jenisSurat').value = template.jenis;
                document.getElementById('perihal').value = template.perihal;
                document.getElementById('isiSurat').value = template.isi;
                
                // Generate nomor surat
                // generateNomorSurat();
                
                // // Close modal
                // bootstrap.Modal.getInstance(document.getElementById('templateModal')).hide();
                
                // showNotification('Template berhasil dimuat!', 'success');
            }
        });
    });
});

// Preview function
function previewSurat() {
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    const previewContent = document.getElementById('previewContent');
    
    // Get form data
    const jenisSurat = document.getElementById('jenisSurat').value;
    const nomorSurat = document.getElementById('nomorSurat').value;
    const tanggalSurat = document.getElementById('tanggalSurat').value;
    const perihal = document.getElementById('perihal').value;
    const tujuan = document.getElementById('tujuan').value;
    const isiSurat = document.getElementById('isiSurat').value;
    const tempat = document.querySelector('[name="tempat"]').value || 'Yogyakarta';
    
    // Format tanggal
    const date = new Date(tanggalSurat);
    const formattedDate = date.toLocaleDateString('id-ID', { 
        day: 'numeric', 
        month: 'long', 
        year: 'numeric' 
    });
    
    // Generate preview HTML
    let previewHTML = `
        <div class="letter-header">
            <p><strong>PDAM TIRTA ASASTA</strong></p>
            <p>${tempat}, ${formattedDate}</p>
            <p>Nomor: ${nomorSurat}</p>
            <p>Lamp: -</p>
            <p>Perihal: ${perihal}</p>
        </div>
        
        <div class="letter-content">
            <p>Yth. ${tujuan}</p>
            <p>Di tempat</p>
            <br>
            <div style="white-space: pre-line;">${isiSurat}</div>
        </div>
        
        <div class="letter-footer">
            <p style="text-align: right;">
                Hormat kami,<br><br>
                <strong>PDAM TIRTA ASASTA</strong><br>
                <u>${document.querySelector('[name="jabatan"]').value || 'Kepala Bagian'}</u><br>
                NIP. [isi NIP]
            </p>
        </div>
    `;
    
    previewContent.innerHTML = previewHTML;
    modal.show();
}

// Save as draft function
function saveAsDraft() {
    const form = document.getElementById('buatSuratForm');
    const formData = new FormData(form);
    
    // Add draft status
    formData.append('status', 'draft');
    
    // Send to server (simulated)
    showLoading();
    
    setTimeout(() => {
        hideLoading();
        showNotification('Draft berhasil disimpan!', 'success');
    }, 1000);
}

// Auto-generate nomor surat when jenis changes
document.getElementById('jenisSurat')?.addEventListener('change', generateNomorSurat);
</script>