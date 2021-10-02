$(function () {
    $("#eror_nama_produk").hide();
    $("#eror_volume").hide();
    $("#eror_satuan").hide();
    $("#eror_kategori_produk").hide();
    $("#eror_gambar").hide();

    var error_produk = false;
    var error_volume = false;
    var error_satuan = false;
    var error_kategori = false;
    var error_gambar = false;

    $("#nama_produk").focusout(function () {
        check_nama_produk();
    });
    $("#volume").focusout(function () {
        check_volume();
    });
    $("#satuan").focusout(function () {
        check_satuan();
    });
    $("#kategori_produk").focusout(function () {
        check_kategori_produk();
    });
    $("#gambar").focusout(function () {
        check_gambar();
    });

    function check_nama_produk() {
        var produk_length = $('#nama_produk').val().length;

        if(produk_length == 0){
            $("#eror_nama_produk").html("Nama Produk tidak boleh kosong");
            $("#eror_nama_produk").show();
            error_produk = true;
        } else{
            $("#eror_nama_produk").hide();
        }
    }
    function check_volume() {
        var volume_length = $('#volume').val().length;
        var volume_val = $('#volume').val();


        if(volume_length == 0 | volume_val == "0"){
            $("#eror_volume").html("Volume tidak boleh kosong");
            $("#eror_volume").show();
            error_volume = true;
        } else{
            $("#eror_volume").hide();
        }
    }
    function check_satuan() {
        var satuan_length = $('#satuan').val().length;

        if(satuan_length == 0){
            $("#eror_satuan").html("Satuan harus diisi");
            $("#eror_satuan").show();
            error_satuan = true;
        } else{
            $("#eror_satuan").hide();
        }
    }

    function check_kategori_produk() {
        var kategori_length = $('#kategori_produk').val().length;

        if(kategori_length == 0){
            $("#eror_kategori_produk").html("Kategori harus diisi");
            $("#eror_kategori_produk").show();
            error_kategori = true;
        } else{
            $("#eror_kategori_produk").hide();
        }
    }

    function check_gambar() {
        var gambar_length = $('#gambar').val().length;

        if(gambar_length == 0){
            $("#eror_gambar").html("Gambar produk harus diisi");
            $("#eror_gambar").show();
            error_gambar = true;
        } else{
            $("#eror_gambar").hide();
        }
    }

    $('#formtambah').submit(function () {
        error_gambar = false;
        error_kategori = false;
        error_produk = false;
        error_satuan = false;
        error_volume = false;

        check_gambar();
        check_kategori_produk();
        check_nama_produk();
        check_satuan();
        check_volume();

        if (error_gambar==false && error_kategori==false && error_produk==false && error_satuan==false && error_volume==false) {
        return true;
        } else{
            // return false;
            $('#btn-tambah').attr('disabled', 'disabled');
        }

    })    
});

const flashData = $('.flash-data').data('flashdata');
console.log(flashData);

if (flashData) {
    Swal.fire({
    title: 'Data Produk' + flashData,
    text:'Berhasil' + flashData,
    type:'success'
    });
}