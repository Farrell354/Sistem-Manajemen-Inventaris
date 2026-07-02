<!DOCTYPE html>
<html>
<head>
    <title>Laporan Inventaris Barang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <h2 class="text-center">Laporan Master Data Inventaris</h2>
    <p>Tanggal Dicetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $product->kode_barang }}</td>
                    <td>{{ $product->nama_barang }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td class="text-center">{{ $product->stok }}</td>
                    <td>{{ $product->lokasi_penyimpanan }}</td>
                    <td>{{ $product->kondisi_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
