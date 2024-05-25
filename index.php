<?php include "koneksi.php";?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Implementasi Metode Least Square untuk Prediksi Harga Beras Grosir Berbasis Web</title>
    <link rel="shortcut icon" href="https://ti.polindra.ac.id/images/ti.polindra.ac.id-09032017120305-LOGO-POLINDRA-WEB.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <header class="container-fluid bg-primary">
        <div class="container p-2">
            <div class="text-center">
                <img src="https://ti.polindra.ac.id/images/ti.polindra.ac.id-09032017120305-LOGO-POLINDRA-WEB.png" height="120">
                <h1 class="text-white">Implementasi Metode Least Square <br>untuk Prediksi Harga Beras Grosir Berbasis Web</h1>
            </div>
        </div>
    </header>
    <div class="container">
        <?php include "prediksi.php";?>
        <p>Sumber data:<br>
        https://www.bps.go.id/id/statistics-table/2/Mjk1IzI=/rata-rata-harga-beras-di-tingkat-perdagangan-besar--grosir--indonesia--perusahaan-.html, diakses pada tanggal 25 Mei 2024.
        </p>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
