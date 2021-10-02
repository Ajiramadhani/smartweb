<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?> -->

            <?= $this->session->flashdata('sukses'); ?>
            <a href="#form" class="btn btn-primary mb-3" onclick="submit('tambah')" data-toggle="modal" data-target="#form">Tambah Kategori</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="target">
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form">Tambahkan Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <center>
                <p class="text-danger" id="pesan"></p>
            </center>
            <form action="<?= base_url('tambahan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="judul_kategori" id="judul_kategori" placeholder="Nama Kategori">
                        <!-- <?php echo form_error('judul_kategori'); ?> -->
                        <input type="hidden" name="id_kategori" value="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-ubah" onclick="ubahdata()" class="btn btn-warning">Update</button>
                    <button type="button" id="btn-tambah" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    ambilData();

    function ambilData() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() . 'tambahan/ambildata' ?>',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var baris = '';
                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + data[i].judul_kategori + '</td>' +
                        '<td><a href="#form" data-toggle="modal" class="btn btn-warning" onclick="submit(' + data[i].id_kategori + ')">Ubah </a> <a onclick="hapusdata(' + data[i].id_kategori + ')" class="btn btn-danger text-white">Hapus</a></td>' +
                        '</tr>';
                }
                $('#target').html(baris);
            }
        })
    }

    function tambahdata() {
        var judul_kategori = $("[name='judul_kategori']").val();

        $.ajax({
            type: 'POST',
            data: 'judul_kategori=' + judul_kategori,
            url: '<?= base_url() . 'tambahan/tambahkategori' ?>',
            dataType: 'json',
            success: function(hasil) {
                // console.log(hasil);
                $("#pesan").html(hasil.pesan);

                if (hasil.pesan == '') {
                    $("#form").modal('hide');
                    ambilData();

                    $("[name='judul_kategori']").val('');
                }
            }
        });
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
                data: 'id_kategori=' + x,
                url: '<?= base_url() . 'tambahan/ambilId'; ?>',
                dataType: 'json',
                success: function(hasil) {
                    $('[name="id_kategori"]').val(hasil[0].id_kategori);
                    $('[name="judul_kategori"]').val(hasil[0].judul_kategori);
                }
            });
        }
    }

    function ubahdata() {
        var id_kategori = $("[name='id_kategori']").val();
        var judul_kategori = $("[name='judul_kategori']").val();

        $.ajax({
            type: 'POST',
            data: 'id_kategori=' + id_kategori + '&judul_kategori=' + judul_kategori,
            url: '<?= base_url() . 'tambahan/ubahdata' ?>',
            dataType: 'json',
            success: function(hasil) {
                $("#pesan").html(hasil.pesan);

                if (hasil.pesan == "") {
                    $("#form").modal('hide');
                    ambilData();
                }
            }
        });
    }

    function hapusdata(id_kategori) {
        var tanya = confirm('Apakah anda yakin akan menghapus data?');

        if (tanya) {
            $.ajax({
                type: 'post',
                data: 'id_kategori=' + id_kategori,
                url: '<?= base_url() . 'tambahan/hapusdata'; ?>',
                success: function() {
                    ambilData();
                }
            });
        }
    }
</script>