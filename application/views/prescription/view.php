<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">.select2-container{width: 100% !important;}</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Prescription</li>
                        <li class="breadcrumb-item active">View Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row" id="non_racikan">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                                <h4>Data Pasien</h4>
                            </div>
                            <div class="col" align="right">
                                <a href="<?= base_url() .'index.php/prescription/print/'. $prescription_id ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="" class="form-control" value="<?= $prescription['patient_name'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="" class="form-control" value="<?= $prescription['patient_address'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tempat Tanggal Lahir</label>
                            <input type="text" name="" class="form-control" value="<?= $prescription['patient_birthplace'] .','. date('d-M-Y', strtotime($prescription['patient_birthdate'])) ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row" id="non_racikan">
                    <div class="col-lg-12">
                        <h4>Non Racikan</h4>
                        <hr>
                    </div>

                    <div class="col-lg-12 non-racikan-card">
                        <?php  
                            foreach ($non_racikan as $data) {
                                $non_racikan_id = $data['non_racikan_id'];
                                $obatalkes_nama = $data['obatalkes_nama'];
                                $qty = $data['qty'];
                                $signa_nama = $data['signa_nama'];
                                $signa_kode = $data['signa_kode'];

                                echo '
                                    <div class="card non-racikan-list">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label>Obat</label>
                                                        <input type="text" name="" class="form-control" value="'. $obatalkes_nama .'" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="text" name="" class="form-control" value="'. $qty .'" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label>Signa</label>
                                                        <input type="text" name="" class="form-control" value="'. $signa_nama .' | '. $signa_kode .'" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row" id="racikan">
                    <div class="col-lg-12">
                        <h4>Racikan</h4>
                        <hr>
                    </div>

                    <div class="col-lg-12 racikan-card">
                        <?php 
                            // print_r($racikan_obat[21]);

                            foreach ($racikan as $data) {
                                $racikan_id = $data['racikan_id'];
                                $racikan_nama = $data['racikan_nama'];
                                $signa_nama = $data['signa_nama'];
                                $signa_kode = $data['signa_kode'];

                                $d = '';
                                foreach ($racikan_obat[$racikan_id] as $data_obat) {
                                    $obatalkes_nama = $data_obat['obatalkes_nama'];
                                    $qty = $data_obat['qty'];

                                    $d .= '
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Obat</label>
                                                            <input type="text" name="" class="form-control" value="'. $obatalkes_nama .'" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Qty</label>
                                                            <input type="text" name="" class="form-control" value="'. $qty .'" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }

                                echo '
                                    <div class="card racikan-list">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Racikan</label>
                                                        <input type="text" name="" class="form-control" value="'. $racikan_nama .'" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Signa</label>
                                                        <input type="text" name="" class="form-control" value="'. $signa_nama .' | '. $signa_kode .'" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="container-racikan-obat">
                                                '. $d .'
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div> 
<!-- /.content-wrapper -->