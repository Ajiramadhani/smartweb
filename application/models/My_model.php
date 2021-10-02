<?php
defined('BASEPATH') or exit();

class My_model extends CI_Model
{
    function ambildata($table)
    {
        return $this->db->get($table);
    }

    function joinproduk($produk, $table)
    {
        $produk = "SELECT * FROM produk, kategori where kategori_produk=id_kategori order by id_produk asc";
        return $this->db->get($table, $produk);
    }

    function tambahdata($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function ambilId($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function updatedata($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapusdata($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function simpan_upload($nama_produk, $volume, $satuan, $kategori_produk, $image)
    {
        $data = array(
            'nama_produk' => $nama_produk,
            'volume' => $volume,
            'satuan' => $satuan,
            'kategori_produk' => $kategori_produk,
            'gambar' => $image
        );
        $result = $this->db->insert('produk', $data);
        return $result;
    }
}
