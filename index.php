
<?php
session_start();

if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
    $_SESSION['total'] = 0;
}

if (isset($_POST['tambah'])) {
    if (!empty($_POST['nama_barang']) && !empty($_POST['harga_barang']) && !empty($_POST['jumlah_barang'])) {
        $nama_barang = $_POST['nama_barang'];
        $harga_barang = $_POST['harga_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $total_harga = $harga_barang * $jumlah_barang;

        $item = [
            'nama_barang' => $nama_barang,
            'harga_barang' => $harga_barang,
            'jumlah_barang' => $jumlah_barang,
            'total_harga' => $total_harga
        ];

        array_push($_SESSION['items'], $item);
        $_SESSION['total'] += $total_harga;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $key = $_GET['hapus'];
    unset($_SESSION['items'][$key]);
    $_SESSION['items'] = array_values($_SESSION['items']); // Reindex the array
    $_SESSION['total'] = array_sum(array_column($_SESSION['items'], 'total_harga')); // Recalculate total
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title>Kasir</title>
</head>
<body>
<div class="container d-flex flex-column pt-2 px-5">
    <div class="add container text-center py-3 px-5">  
        <h2 class="mb-3">Masukkan Data Barang!</h2>
        <form action="" method="post" class="row row-cols-md-2 gap-2 justify-content-evenly form-group rounded">
            <div class="d-flex flex-xl-row flex-column  gap-3">
                <div class="form-group">
                    <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="number" name="harga_barang" id="harga_barang" placeholder="Harga Barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="number" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" class="form-control" required>
                </div>
            </div>
            <div class="d-flex gap-1 text-xl-center">
                <button type="submit" name="tambah" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i> Tambah</button>
                <?php if (!empty($_SESSION['items'])): ?>
                    <a href="pembayaran.php" style="color: white; text-decoration: none;" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i> Bayar</a>
                <?php endif; ?>
            </div>
        </form>
        <hr>
    </div>
    <?php 
    if (!empty($_SESSION['items'])) {
        echo "<div class='items table-responsive px-5'>";
        echo '<h3 class="text-center mb-4">STRUK PEMBELIAN</h3>';
        echo '<table class="table table-striped table-sm rounded text-center table-bordered">';
        echo "<thead class='table-warning'><tr><th>No</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Total Harga</th><th>Action</th></tr></thead><tbody>";
        foreach ($_SESSION['items'] as $key => $item) {
            echo "<tr>";
            echo "<td>" . ($key + 1) . "</td>";
            echo "<td>" . $item['nama_barang'] . "</td>";
            echo "<td>Rp. " . number_format($item['harga_barang'], 2) . "</td>";
            echo "<td>" . $item['jumlah_barang'] . "</td>";
            echo "<td>Rp. " . number_format($item['total_harga'], 2) . "</td>";
            echo '<td><a href="?hapus=' . $key . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>';
            echo "</tr>";
        }
        echo '<tr><td colspan="5" class="text-center">Total Pembayaran :</td><td>Rp. ' . number_format($_SESSION['total'], 2) . '</td></tr>';
        echo "</tbody></table>";
        echo "</div>"; // Close div here
    } else {
        echo "<div class='items table-responsive px-5'>"; // Open div here for empty case
        echo '<table class="table table-striped rounded text-center table-bordered px-5">';
        echo "<thead class='table-warning'><tr><th>No</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Action</th></tr></thead>";
        echo "<tbody><tr><td colspan='5' class='text-center text-danger py-4'>Tidak Ada Data</td></tr></tbody>";
        echo "</table>";
        echo "</div>"; // Close div here for empty case
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
