<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pratinjau Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .iframe-container {
            border: 1px solid #ccc;
            height: 700px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Pratinjau Surat</h1>
                <p>Berikut adalah tampilan pratinjau surat sebelum dicetak:</p>
                <a href="{{ route('surat.cetak') }}" class="btn btn-primary" target="_blank">Cetak PDF</a>
                <a href="{{ route('surat.preview') }}" class="btn btn-secondary">Refresh Preview</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="iframe-container">
                    {{--  Iframe ini akan menampilkan versi PDF dari surat  --}}
                    <iframe src="{{ route('surat.stream') }}" width="100%" height="100%"></iframe>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
