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
                    <h1>Signa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Signa</li>
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
                                    <th>Signa Kode</th>
                                    <th>Signa Nama</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $No = 0;
                                    foreach ($signa as $data) {
                                        $No++;
                                        $signa_kode  = trim($data['signa_kode']);
                                        $signa_nama  = trim($data['signa_nama']);
                                        $additional_data = trim($data['additional_data']);

                                        echo '
                                            <tr>
                                                <td align="center">'. $No .'.</td>
                                                <td>'. $signa_kode .'</td>
                                                <td>'. $signa_nama .'</td>
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