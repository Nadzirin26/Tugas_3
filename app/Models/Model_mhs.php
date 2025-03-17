<?php

    /**
     * Model mahasiswa berfungsi untuk menjalankan query
     * Sebelum menggunakan query, load dulu library database
     */

    namespace Models;
    use Libraries\Database;

    class Model_mhs
    {
        public function __construct()
        {
            $db = new Database();
            $this->dbh = $db->getInstance();
        }

        function simpanData($nim, $nama)
        {
            $created_at = date('Y-m-d H:i:s'); // Set the current timestamp
            $rs = $this->dbh->prepare("INSERT INTO mahasiswa (nim, nama, created_at) VALUES (?, ?, ?)");
            $rs->execute([$nim, $nama, $created_at]);
        }

        function lihatData()
        {

            $rs = $this->dbh->query("SELECT * FROM mahasiswa WHERE Deleted_at IS NULL");
            return $rs;
        }
        function softDelete($id){
            $rs = $this->dbh->prepare("UPDATE mahasiswa SET Deleted_at = NOW() WHERE id=?");
            $rs->execute([$id]);
        }

        function lihatDataDetail($id)
        {

            $rs = $this->dbh->prepare("SELECT * FROM mahasiswa WHERE id=?");
            $rs->execute([$id]);
            return $rs->fetch();// kalau hasil query hanya satu, gunakan method fetch() bawaan PDO
        }
    }