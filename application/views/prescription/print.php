<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$img  = base64_encode(file_get_contents('assets/images/RX.jpeg'));
$logo = 'data:image/jpeg;base64,' . $img;
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $prescription['patient_name'] .' - '. date('Ymd') ?></title>
    <style type="text/css">
        :root{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td rowspan="4" style="width: 50%">
                        <img src="<?= $logo ?>" style="width: 50px;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Patient Name</td>
                    <td style="width: 10px;">:</td>
                    <td><?= $prescription['patient_name'] ?></td>
                </tr>
                <tr>
                    <td>Birth Date</td>
                    <td>:</td>
                    <td><?= $prescription['patient_birthplace'] ?>, <?= date('d-M-Y', strtotime($prescription['patient_birthdate'])) ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?= $prescription['patient_address'] ?></td>
                </tr>
            </table>
            
        </div>
        
        <hr>

        <div style="height: 210mm;">
            <table style="width: 100%">
                <?php 
                    foreach ($non_racikan as $data) {
                        $non_racikan_id = $data['non_racikan_id'];
                        $obatalkes_nama = $data['obatalkes_nama'];
                        $qty            = $data['qty'];
                        $signa_nama     = $data['signa_nama'];
                        $signa_kode     = $data['signa_kode'];

                        echo "
                            <tr>
                                <td>
                                    # $obatalkes_nama <br>
                                    $qty <br>
                                    $signa_kode
                                </td>
                            </tr>
                        ";
                    }

                    foreach ($racikan as $data) {
                        $racikan_id = $data['racikan_id'];
                        $racikan_nama = $data['racikan_nama'];
                        $signa_nama = $data['signa_nama'];
                        $signa_kode = $data['signa_kode'];

                        echo "
                            <tr>
                                <td>
                                    # $racikan_nama <br>
                                    $signa_kode
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>


        <p>
        <hr>Date: <?= date('d-M-Y'); ?></p>
    </div>
</body>
</html>