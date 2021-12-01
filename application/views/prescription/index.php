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
                    <h1>Prescription</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Prescription</li>
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
                    <div class="col-lg-12" align="right">
                        <a href="<?= base_url() ?>index.php/prescription/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Data</a>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead>
                                <tr style="text-align: center;">
                                    <th data-priority="0">#</th>
                                    <th data-priority="3">Prescription ID</th>
                                    <th data-priority="1">Nama Pasien</th>
                                    <th data-priority="4">Alamat Pasien</th>
                                    <th data-priority="5">Total Non Racikan</th>
                                    <th data-priority="6">Total Racikan</th>
                                    <th data-priority="7">Created Date</th>
                                    <th data-priority="8">Created By</th>
                                    <th data-priority="2">Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $No = 0;
                                    foreach ($all_data as $data) {
                                        $No++;
                                        $prescription_id    = trim($data['prescription_id']);
                                        $patient_name       = trim($data['patient_name']);
                                        $patient_address    = trim($data['patient_address']);
                                        $non_racikan_total  = trim($data['non_racikan_total']);
                                        $racikan_total      = trim($data['racikan_total']);
                                        $created_date       = trim($data['created_date']);

                                        echo '
                                            <tr>
                                                <td align="center">'. $No .'.</td>
                                                <td align="center">'. $prescription_id .'</td>
                                                <td>
                                                    <a href="'. base_url() .'index.php/prescription/view/'. $prescription_id .'">'. $patient_name .'</a>
                                                </td>
                                                <td>'. $patient_address .'</td>
                                                <td>'. $non_racikan_total .'</td>
                                                <td>'. $racikan_total .'</td>
                                                <td>'. date('Y/m/d H:i', strtotime($created_date)) .'</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <a href="'. base_url() .'index.php/prescription/print/'. $prescription_id .'" class="btn btn-secodary" target="_blank"><i class="fa fa-print"></i></a>
                                                </td>
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