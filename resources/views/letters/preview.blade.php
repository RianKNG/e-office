<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 20px; }
        .kwitansi-box { border: 1px solid #000; padding: 20px; width: 600px; margin: auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; }
        .table-items { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-items th, .table-items td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table-items th { background-color: #f2f2f2; }
        .footer { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="kwitansi-box">
        <div class="header">
            <h2>Kwitansi Pembayaran</h2>
        </div>
        <div class="info">
       
            <!-- <p><strong>Tanggal:</strong> {{ $data_kwitansi['subject'] }}</p>
            <p><strong>Kepada:</strong> {{ $data_kwitansi['contact'] }}</p>
            <p><strong>Alamat:</strong> {{ $data_kwitansi['letter_type'] }}</p> -->
        </div>
        <table class="table-items">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <div class="footer">
           
        </div>
    </div>
</body>
</html>
