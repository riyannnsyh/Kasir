
<?php
session_start();
if (!isset($_SESSION['uang_dibayar']) || !isset($_SESSION['kembalian'])) {
    header('Location: index.php');
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
    <title>Bukti Pembayaran</title>
</head>
<body>
<div class="container d-flex flex-column pt-2 px-5">
    <div class="receipt container py-3 px-5">
        <h2 class="mb-3 text-center">Bukti Pembayaran</h2>
        <div class="table-responsive px-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No. Transaksi</td>
                        <td>#<?php echo rand(10000000, 99999999); ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><?php echo date('F - j - Y'); ?></td>
                    </tr>
                    <?php foreach ($_SESSION['items'] as $key => $item): ?>
                    <tr>
                        <td><?php echo $item['nama_barang']; ?></td>
                        <td>Rp. <?php echo number_format($item['harga_barang'], 2); ?> x <?php echo $item['jumlah_barang']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Uang Yang Dibayarkan</td>
                        <td>Rp. <?php echo number_format($_SESSION['uang_dibayar'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Rp. <?php echo number_format($_SESSION['total'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Kembalian</td>
                        <td>Rp. <?php echo number_format($_SESSION['kembalian'], 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-3 text-center">Terimakasih Telah Berbelanja di Indoapril </p>
 <div class="text-center">       <button class="btn btn-primary text-center" onclick="window.location.href='index.php'"><i class="fa-solid fa-home"></i> Kembali ke Beranda</button></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php
// Clear session data after payment
session_unset();
session_destroy();
?>
