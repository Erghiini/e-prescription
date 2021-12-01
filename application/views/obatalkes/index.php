<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Obat & Alat Kesehatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">ObatAlKes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Obatalkes Kode</th>
                                    <th>Obatalkes Nama</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $No = 0;
                                    foreach ($obatalkes as $ob) {
                                        $No++;
                                        $obatalkes_kode  = trim($ob['obatalkes_kode']);
                                        $obatalkes_nama  = trim($ob['obatalkes_nama']);
                                        $stok            = trim($ob['stok']) + 0;
                                        $additional_data = trim($ob['additional_data']);

                                        echo '
                                            <tr>
                                                <td align="center">'. $No .'.</td>
                                                <td>'. $obatalkes_kode .'</td>
                                                <td>'. $obatalkes_nama .'</td>
                                                <td align="right">'. $stok .'</td>
                                                <td>'. $additional_data .'</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div> 
<!-- /.content-wrapper -->

<script type="text/javascript">
    $("#myTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthMenu":[
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
      ]
    });
</script>