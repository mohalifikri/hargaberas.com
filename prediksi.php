<?php
//error_reporting(0);
require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Regression\LeastSquares;

$reg = new LeastSquares();
$samples = array();
$targets = array();

$query_beras = mysqli_query($koneksi,"select harga_beras, bulan_beras FROM t_beras order by bulan_beras ASC");

while($data_beras=mysqli_fetch_assoc($query_beras)){
  $samples[] = [$data_beras['bulan_beras']];
  $targets[] = $data_beras['harga_beras'];
}

$reg->train($samples, $targets);
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container-prediksi"></div>
</figure>

<script>
Highcharts.chart('container-prediksi', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Tren Rata-rata Harga Beras di Tingkat Grosir Indonesia'
    },
    subtitle: {
        text: 'Tahun 2024' +
            ''
    },
    xAxis: {
        categories: [
            <?php
                $query_beras = mysqli_query($koneksi,"SELECT * FROM t_beras
                                                ORDER BY bulan_beras ASC");
                 while($data_bulan=mysqli_fetch_assoc($query_beras)){
                     echo $data_bulan['bulan_beras'].",";
                    }
                    $max_bulan=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT MAX(bulan_beras) AS awal_bulan FROM t_beras LIMIT 0,1"));
                    $bulan_awal = $max_bulan['awal_bulan']+1;
                    $bulan_akhir = 12;
                    for($i=$bulan_awal;$i<=$bulan_akhir;$i++){
                        echo $i.",";
                    }
    ?>
        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Harga (Rp.)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true,
                formatter: function () {
                    return parseFloat(this.y.toFixed(0)).toLocaleString().replace(',', '.').replace(',', '.');
                }
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Aktual',
        color: '#198754',
        data: [
            <?php
                $query_beras = mysqli_query($koneksi,"SELECT * FROM t_beras ORDER BY bulan_beras ASC");
                while($data_aktual=mysqli_fetch_assoc($query_beras)){
                    echo $data_aktual['harga_beras'].",";
                }
            ?>
        ]
    },
    {
        name: 'Prediksi',
        color: '#fd7e14',
        data: [
            <?php
                $query_beras = mysqli_query($koneksi,"SELECT * FROM t_beras ORDER BY bulan_beras ASC");
                while($data_prediksi=mysqli_fetch_assoc($query_beras)){
                    echo $reg->predict([$data_prediksi['bulan_beras']]).",";
                }
                $max_bulan=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT MAX(bulan_beras) AS awal_bulan FROM t_beras LIMIT 0,1"));
                $bulan_awal = $max_bulan['awal_bulan']+1;
                $bulan_akhir = 12;
                for($i=$bulan_awal;$i<=$bulan_akhir;$i++){
                    echo $reg->predict([$i]).",";
                }
            ?>
        ]
    }]
});

</script>

<?php
function get_bulan($bulan_angka){
    switch($bulan_angka){
        case '1': $bulan = "Januari"; break;
        case '2': $bulan = "Februari"; break;
        case '3': $bulan = "Maret"; break;
        case '4': $bulan = "April"; break;
        case '5': $bulan = "Mei"; break;
        case '6': $bulan = "Juni"; break;
        case '7': $bulan = "Juli"; break;
        case '8': $bulan = "Agustus"; break;
        case '9': $bulan = "September"; break;
        case '10': $bulan = "Oktober"; break;
        case '11': $bulan = "November"; break;
        case '12': $bulan = "Desember"; break;
    }
    return $bulan;
}
?>

<h3>Data Training:</h3>
<table class="table table-bordered table-striped">
    <tr>
        <th>Bulan</th>
        <th>Aktual</th>
        <th>Prediksi</th>
        <th>Error</th>
    </tr>
    <?php
        $query_beras = mysqli_query($koneksi,"SELECT * FROM t_beras
        ORDER BY bulan_beras ASC");
        while($data_train=mysqli_fetch_assoc($query_beras)){
    ?>
    <tr>
        <td><?=get_bulan($data_train['bulan_beras'])?></td>
        <td><?=number_format($data_train['harga_beras'],2,",",".")?></td>
        <td><?php 
                $hasil= $reg->predict([$data_train['bulan_beras']]);
                echo number_format($hasil,2,",",".");
                ?></td>
        <td>
            <?php
                $selisih = abs($data_train['harga_beras'] - $hasil);
                $mape = abs($selisih / $data_train['harga_beras']);
                $mapex[] = $mape;
                $hasil_mape= number_format($mape,5);
                echo str_replace('.',',',$hasil_mape);
            ?>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="3"style="text-align:right">MAPE:</th>
        <th>
            <?php
                $rMAPE = (array_sum($mapex) / count($samples)) * 100;
                $hasil_rMAPE = number_format($rMAPE,2);
                echo str_replace('.',',',$hasil_rMAPE)."%";
            ?>
        </th>
    </tr>
</table>
