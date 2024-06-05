
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title>Pembayaran</title>
    <style>
        .btn{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container d-flex flex-column pt-2 px-5">
    <div class="payment container py-3 px-5">
        <h1 class="mb-3 text-center">Pembayaran</h1>
        <form action="" method="post" class="row row-cols-md-2 gap-2 justify-content-evenly form-group p-3">
        <?php 
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uang_dibayar = $_POST['uang_dibayar'];
            $total = $_SESSION['total'];
            if ($uang_dibayar < $total) {
                $kekurangan = $total - $uang_dibayar;
                echo "<div class='alert alert-danger'>Uang Anda kurang Rp. " . number_format($kekurangan, 2) . "</div>";
            } else {
                $kembalian = $uang_dibayar - $total;
                $_SESSION['kembalian'] = $kembalian;
                $_SESSION['uang_dibayar'] = $uang_dibayar;
                header('Location: struk.php');
                exit;
            }
        }
        ?>
            <div>
                <label for="uang_dibayar" class="form-label">Masukkan Nominal Uang :</label>
                <input type="number" name="uang_dibayar" id="uang_dibayar" placeholder="Masukkan jumlah uang" class="form-control" required>
            </div>
            <div>
                <b>Total yang harus dibayarkan : Rp. <?php echo number_format($_SESSION['total'], 2); ?></b>
            </div>
            <div>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-money-bill"></i> Bayar</button>
            </div>
            <div>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'"><i class="fa-solid fa-ban"></i> Batal</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
