<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <div class="col-lg">
            <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?> -->
            <!-- <?php if ($this->session->flashdata('flash')) : ?> -->
            <div class="row mt-3" id="flash">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Produk berhasil <?= $this->session->flashdata('flash'); ?>
                    </div>
                </div>
            </div>
            <!-- <?php endif; ?> -->
            <a href="#form" class="btn btn-primary mb-3" onclick="submit('tambah')" data-toggle="modal" data-target="#form">Tambah Kategori</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Volume</th>
                                    <th>Satuan</th>
                                    <th>Image</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="target">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="formLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="form">Tambahkan Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <center>
                            <div class="alert-danger" role="alert" id="pesan"></div>
                        </center>
                        <form method="post" id="formtambah">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="card bg-danger text-white text-center fade-in" id="eror_nama_produk"></div>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk">
                                    <input type="hidden" name="id_produk" value="" />
                                    <?php echo form_error('nama_produk'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="card bg-danger text-white text-center fade-in" id="eror_volume"></div>
                                    <input type="number" class="form-control" name="volume" id="volume" placeholder="Volume">
                                </div>
                                <div class="form-group">
                                    <div class="card bg-danger text-white text-center fade-in" id="eror_satuan"></div>
                                    <select class="form-control mr-sm-2" name="satuan" id="satuan">
                                        <option value="">--Pilih Satuan--</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Gram">Gram</option>
                                        <option value="Liter">Liter</option>
                                        <option value="Ml">Ml</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="card bg-danger text-white text-center fade-in" id="eror_kategori_produk"></div>
                                    <select class="form-control" name="kategori_produk" id="kategori_produk">
                                        <option value="">--Pilih Kategori--</option>
                                        <?php foreach ($kategori as $row) { ?>
                                            <option <?php if (set_value('kategori_produk') == $row->id_kategori) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $row->id_kategori; ?>"><?= $row->judul_kategori; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="card bg-danger text-white text-center fade-in" id="eror_gambar"></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Choose file</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button id="btn-ubah" onclick="ubahdata()" class="btn btn-warning">Update</button>
                                <button id="btn-tambah" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
                                <!-- <button type="submit" id="btn_upload" name="simpan" class="btn btn-primary">Tambah</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script lang="text/javascript">
    function message(icon, text) {
        Swal.fire({
            icon: icon,
            title: 'Data Produk',
            text: text,
            showCloseButton: false,
            showCancelButton: false,
        });
    }

    // addajax
    function tambahdata() {
        $('#formtambah').submit(function(e) {
            var nama_produk = $("[name='nama_produk']").val();
            var volume = $("[name='volume']").val();
            var satuan = $("[name='satuan']").val();
            var gambar = $("[name='gambar']").val();
            var kategori_produk = $("[name='kategori_produk']").val();

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('produk/tambahproduk'); ?>",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                // beforeSend: function(hasil) {
                //     $('#btn-tambah').html('<i class="fas fa-spinner fa-spin"></i> Proses...');
                //     $('#pesan').html(hasil.pesan);
                // },
                success: function(hasil) {
                    $('#pesan').html(hasil.pesan);
                    if (hasil.pesan == '') {
                        $('#form').modal('hide');
                        $('#flash').show();
                        $('#btn-tambah').html('Tambah');
                        ambilData();
                        cleardata();
                        if (submit) {
                            message('success', 'Data Berhasil di Tambah');
                        }
                    }
                }
            });
            return false;
        });
    }
    // addajax
    ambilData();

    function cleardata() {
        $("[name='nama_produk']").val('');
        $("[name='volume']").val('');
        $("[name='satuan']").val('');
        $("[name='gambar']").val('');
        $("[name='kategori_produk']").val('');
    }

    function ambilData() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() . "produk/ambildata" ?>',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var baris = '';
                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + (i + 1) + ' </td>' +
                        '<td>' + data[i].nama_produk + '</td>' +
                        '<td> ' + data[i].volume + '</td>' +
                        '<td>' + data[i].satuan + ' </td>' +
                        '<td><img src="assets/img/produk/' + data[i].gambar + '" width="100"></td>' +
                        '<td>' + data[i].judul_kategori + ' </td>' +
                        '<td><a href="#form" data-toggle="modal" class="btn btn-warning" onclick="submit(' + data[i].id_produk + ')">Ubah </a> <a onclick="hapusdata(' + data[i].id_produk + ')" class="btn btn-danger text-white">Hapus</a></td>' +
                        '</tr>';
                }
                $('#target').html(baris);
            }
        })
    }

    function submit(x) {
        if (x == 'tambah') {
            $('#btn-tambah').show();
            $('#btn-ubah').hide();
        } else {
            $('#btn-tambah').hide();
            $('#btn-ubah').show();

            $.ajax({
                type: "POST",
                data: 'id_produk=' + x,
                url: '<?= base_url() . 'produk/ambilId'; ?>',
                dataType: 'json',
                success: function(hasil) {
                    $('[name="id_produk"]').val(hasil[0].id_produk);
                    $('[name="nama_produk"]').val(hasil[0].nama_produk);
                    $('[name="volume"]').val(hasil[0].volume);
                    $('[name="satuan"]').val(hasil[0].satuan);
                    $('[name="gambar"]').val(hasil[0].gambar);
                    $('[name="kategori_produk"]').val(hasil[0].kategori_produk);
                }
            });
        }
    }

    function ubahdata() {
        $('#formtambah').submit(function(e) {
            var id_produk = $("[name='id_produk']").val();
            var nama_produk = $("[name='nama_produk']").val();
            var volume = $("[name='volume']").val();
            var satuan = $("[name='satuan']").val();
            var gambar = $("[name='gambar']").val();
            var kategori_produk = $("[name='kategori_produk']").val();

            e.preventDefault();
            $.ajax({
                type: 'POST',
                // data : 'id_produk=' + id_produk + '&nama_produk=' + nama_produk + '&volume=' + volume + '&satuan=' + satuan + '&gambar=' + gambar + '&kategori_produk=' + kategori_produk,
                url: '<?= base_url() . 'produk/ubahdata'; ?>',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(hasil) {
                    if (cleardata() == '') {
                        $('#btn-ubah').attr('disabled', 'disabled');
                    }
                    $('#btn-ubah').html('<i class="fas fa-spinner fa-spin"></i> Proses...');
                },
                success: function(hasil) {
                    $('#form').modal('hide');
                    // $('#flash').show();
                    $('#btn-ubah').html('Edit');
                    ambilData();
                    if (submit) {
                        message('success', 'Data Berhasil di Ubah');
                    }
                }
            });
        });
    }

    function hapusdata(id_produk) {
        var tanya = confirm('Apakah anda yakin akan menghapus data?');

        if (tanya) {
            $.ajax({
                type: 'post',
                data: 'id_produk=' + id_produk,
                url: '<?= base_url() . 'produk/hapusdata'; ?>',
                success: function() {
                    ambilData();
                }
            });
        }
    }
</script>