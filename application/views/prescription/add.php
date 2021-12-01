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
                    <h1>Add Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Prescription</li>
                        <li class="breadcrumb-item active">Add Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="<?= base_url() ?>index.php/prescription/add_process" enctype="multipart/form-data" id="myForm">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="non_racikan">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <h4>Data Pasien</h4>
                                </div>
                                <div class="col" align="right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <select name="patient_id" id="patient_id" class="form-control" required>
                                </select>
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
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success add-obat-non-racikan" style="width: 100%"><i class="fa fa-plus"></i> Tambah Obat</button>
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
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success add-racikan" style="width: 100%"><i class="fa fa-plus"></i> Tambah Racikan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row" id="draft">
                        <div class="col-lg-12">
                            <h4>Draft</h4>
                            <hr>
                        </div>

                        <div class="col-lg-12">
                            <table class="table table-bordered table-draft">
                                <thead>
                                    <tr>
                                        <td>Nama Pasien: <span id="draft_patient_name"></span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary" style="width: 100%"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div> 
<!-- /.content-wrapper -->

<script type="text/javascript">
    // var masterNonRacikan = $('.non-racikan-card').find('.row').clone();
    $("#myTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthMenu":[
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
      ]
    });

    $('#patient_id').select2({
        minimumInputLength: 1,
        allowClear: false,
        placeholder: '-- Pilih Pasien --',
        ajax: {
            dataType: 'json',
            url: '<?= base_url() ?>index.php/prescription/getpatient',
            delay: 1000,
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });

    select2Obat();
    function select2Obat(){
        $('.obatalkes_id').select2({
            minimumInputLength: 1,
            allowClear: false,
            placeholder: '-- Pilih Obat --',
            ajax: {
                dataType: 'json',
                url: '<?= base_url() ?>index.php/obatalkes/getobat',
                delay: 1000,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });
    }

    $(document).on('select2:select', '.obatalkes_id', function(e){
        let data         = e.params.data;
        let obatalkes_id = data.id;
        let stok         = data.stok;
        let self         = $(this);
        let curr_stok    = 0;
        let obatalkesLen = $('input[obatalkes-id="'+ obatalkes_id +'"]').length;

        if (obatalkesLen > 0) {
            curr_stok = $('input[obatalkes-id="'+ obatalkes_id +'"]:eq(0)').val();
            self.closest('.row').find('.stok').val(curr_stok);
            self.closest('.row').find('.qty').attr('max', curr_stok);
        } else {
            self.closest('.row').find('.stok').val(stok);
            self.closest('.row').find('.qty').attr('max', stok);
        }

        self.closest('.row').find('.stok').attr('obatalkes-stok', stok);
        self.closest('.row').find('.stok').attr('obatalkes-id', obatalkes_id);
    });

    $(document).on('input', '.qty', function(){
        var obatalkes_id    = $(this).closest('.card').find('.stok').attr('obatalkes-id');
        var t_stok          = $(this).closest('.card').find('.stok').attr('obatalkes-stok');
        // total qty used
        var obatalkes       = $('input[obatalkes-id="' + obatalkes_id + '"]');
        var t_qty           = getTotalQty(obatalkes_id);

        $('input[obatalkes-id="' + obatalkes_id + '"]').val(parseInt(t_stok) - t_qty);

        countMax(obatalkes_id);
    });

    select2Signa();
    function select2Signa(){
        $('.signa_id').select2({
            minimumInputLength: 1,
            allowClear: false,
            placeholder: '-- Pilih Signa --',
            ajax: {
                dataType: 'json',
                url: '<?= base_url() ?>index.php/signa/getsigna',
                delay: 1000,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });
    }

    $('.add-obat-non-racikan').on('click', function(){
        let data = `
            <div class="card non-racikan-list">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Obat</label>
                                <select name="non_racik[obatalkes_id][]" id="" class="form-control obatalkes_id" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Stok Obat</label>
                                <input type="text" name="non_racik[stok][]" id="" class="form-control stok" obatalkes-id="" obatalkes-stok="0" value="N/A" disabled>    
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="non_racik[qty][]" id="" class="form-control qty" value="0" min="1" max="0" placeholder="-" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Signa</label>
                                <select name="non_racik[signa_id][]" id="" class="form-control signa_id" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" align="right">
                            <button type="button" class="btn btn-danger btn-sm delete-obat"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('.non-racikan-card').append(data);
        select2Obat();
        select2Signa();
    });

    $(document).on('click', '.delete-obat', function(){
        if (confirm('Hapus Obat?')) {
            var obatalkes_id  = $(this).closest('.card').find('input').attr('obatalkes-id');
            var qty           = $(this).closest('.card').find('.qty').val();
            var obatalkes_val = $('input[obatalkes-id="'+ obatalkes_id +'"]').val();
            var max           = $('input[obatalkes-id="'+ obatalkes_id +'"]').closest('.card').find('.qty').attr('max');

            $('input[obatalkes-id="'+ obatalkes_id +'"]').val(parseInt(obatalkes_val) + parseInt(qty));
            countMax(obatalkes_id);

            $(this).closest('.card').remove();
            checkDraft();
        }
    });

    function getTotalQty(obatalkes_id) {
        var obatalkes = $('input[obatalkes-id="' + obatalkes_id + '"]');
        var t_qty     = 0;
        obatalkes.each(function(){
            var x_qty = $(this).closest('.card').find('.qty').val();
            t_qty     = t_qty + parseInt(x_qty);
        });
        return t_qty;
    }

    function countMax(obatalkes_id){
        var obatalkes = $('input[obatalkes-id="' + obatalkes_id + '"]');
        obatalkes.each(function(){
            var s_stok  = $(this).closest('.card').find('.stok').val();
            var c_qty   = $(this).closest('.card').find('.qty').val();
            var qty_max = parseInt(s_stok) + parseInt(c_qty);

            $(this).closest('.card').find('.qty').attr('max', qty_max);
        });
    }

    $(document).on('click', '.delete-racikan', function(){
        if (confirm('Hapus Racikan?')) {
            $(this).closest('.racikan-list').remove();
            checkDraft();
        }
    });

    $('.add-racikan').on('click', function(){
        let racikanLen = $('.racikan-list').length;
        let data = `
            <div class="card racikan-list">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Racikan</label>
                                <input type="text" name="racik[nama_racikan][]" class="form-control nama_racikan" id="" maxlength="100" minlength="5" class="form-control" placeholder="Contoh: Racikan obat penurun panas" onchange="this.value = this.value.trim()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Signa</label>
                                <select name="racik[signa_id][]" class="signa_id" id="" class="form-control signa_id">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="container-racikan-obat">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Obat</label>
                                            <select name="racik[obatalkes_id][`+ racikanLen +`][]" id="" class="form-control obatalkes_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Stok Obat</label>
                                            <input type="text" name="racik[stok][`+ racikanLen +`][]" id="" class="form-control stok" obatalkes-id="" obatalkes-stok="0" value="0" placeholder="N/A" disabled>    
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" name="racik[qty][`+ racikanLen +`][]" id="" class="form-control qty" value="0" min="1" max="0" placeholder="-" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Obat</label>
                                            <select name="racik[obatalkes_id][`+ (racikanLen + 1) +`][]" id="" class="form-control obatalkes_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Stok Obat</label>
                                            <input type="text" name="racik[stok][`+ (racikanLen + 1) +`][]" id="" class="form-control stok" obatalkes-id="" obatalkes-stok="0" value="0" placeholder="N/A" disabled>    
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" name="racik[qty][`+ (racikanLen + 1) +`][]" id="" class="form-control qty" value="0" min="1" max="0" placeholder="-" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-success add-obat-racikan" style="width: 100%"><i class="fa fa-plus"></i> Tambah Obat</button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger delete-racikan" style="width: 100%"><i class="fa fa-trash"></i> Hapus Racikan</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('.racikan-card').append(data);
        select2Obat();
        select2Signa();
    });

    $(document).on('click', '.add-obat-racikan', function(){
        let racikanLen = $('.racikan-list').length;
        let data = `
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Obat</label>
                                <select name="racik[obatalkes_id][`+ racikanLen +`][]" id="" class="form-control obatalkes_id">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Stok Obat</label>
                                <input type="text" name="racik[stok][`+ racikanLen +`][]" id="" class="form-control stok" value="0" placeholder="N/A" disabled>    
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="racik[qty][`+ racikanLen +`][]" id="" class="form-control qty" value="0" min="1" placeholder="-" required>
                            </div>
                        </div>
                        <div class="col-lg-12" align="right">
                            <button type="button" class="btn btn-danger btn-sm delete-obat"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $(this).closest('.card-body').find('.container-racikan-obat').append(data);
        select2Obat();
    });

    $('#patient_id').on('change', function(){
        var patient_name = $(this).find('option:selected').text();
        $('#draft_patient_name').text(patient_name);
    });

    $('.non-racikan-card, .racikan-card').on('change', function(){
        checkDraft();
    })

    function checkDraft(){
        var data = '';

        $('.non-racikan-list').each(function(){
            var obatalkes_id = $(this).find('.obatalkes_id option:selected').text();
            var qty = $(this).find('.qty').val();
            var signa_id = $(this).find('.signa_id option:selected').text();

            data += `
                <tr>
                    <td>
                        #`+ obatalkes_id +`<br>&ensp;`+ qty +`<br>&ensp;`+ signa_id +`
                    </td>
                </tr>
            `;
        });
        
        if ($('.racikan-list').length > 0) {
            $('.racikan-list').each(function(){
                var nama_racikan = $(this).find('.nama_racikan').val();
                var signa_id = $(this).find('.signa_id option:selected').text();

                data += `
                    <tr>
                        <td>
                            #`+ nama_racikan +`<br>&ensp;`+ signa_id +`
                        </td>
                    </tr>
                `;
            });
        }

        $('.table-draft tbody').html(data);
    }

    let submit = false;
    $('#myForm').on('submit', function(){
        if ($('.obatalkes_id').length <= 0) return (alert('Can not save, no data available.'), false);

        if (!submit) {
            if (confirm('Data sudah benar?')) {
                submit = true;
                $('#myForm [type="submit"]').prop('disabled', true);
                $('#myForm').submit();
            }
        }

        return submit;
    });
</script>