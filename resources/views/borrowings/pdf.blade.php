<!DOCTYPE html>
<html>
<head>
    <title>Laporan Riwayat Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .status-dipinjam { color: #d97706; font-weight: bold; }
        .status-dikembalikan { color: #16a34a; font-weight: bold; }
    </style>
</head>
<body>

    <h2 class="text-center">Laporan Riwayat Peminjaman Barang</h2>
    <p>Tanggal Dicetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Barang (Jumlah)</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $index => $borrowing)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>
                        @foreach($borrowing->details as $detail)
                            - {{ $detail->product->nama_barang }} ({{ $detail->jumlah }})<br>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ $borrowing->tanggal_kembali ? \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d M Y') : '-' }}</td>
                    <td class="{{ $borrowing->status == 'Dipinjam' ? 'status-dipinjam' : 'status-dikembalikan' }}">
                        {{ $borrowing->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
