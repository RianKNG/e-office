<div>
    <h3>Pemberitahuan</h3>
    <p>Perihal: <b>{{ $data['perihal'] ?? '' }}</b></p>
    <p>Kepada: <b>{{ $data['nama_penerima'] ?? '' }}</b></p>
    <p>Tanggal: {{ date('d-m-Y') }}</p>
</div>

