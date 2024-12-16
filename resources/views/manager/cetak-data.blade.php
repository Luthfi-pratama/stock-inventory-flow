<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        td {
            padding: 8px;
            text-align: left;
        }

        h1 {
            font-size: 2rem;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 1.25rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <h1>Rekap Data MASUK</h1>
    <h3>{{ $title }}</h3>
    <table class="table table-hover">
        <thead class="table-primary"></thead>>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>