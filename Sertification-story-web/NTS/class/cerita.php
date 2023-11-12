<?php
require_once("parent.php");

class Cerita extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function buatCeritaBaru($idusers_pembuat_awal, $judul)
    {
        $query = $this->mysqli->prepare("INSERT INTO cerita (idusers_pembuat_awal, judul) VALUES (?, ?)");
        $query->bind_param("is", $idusers_pembuat_awal, $judul);

        if ($query->execute()) {
            // Dapatkan ID terakhir yang diinsert
            $lastInsertId = $this->mysqli->insert_id;
            return $lastInsertId;
        } else {
            return false;
        }
    }


    public function cariJudulCerita($keyword) {
        $query = $this->mysqli->prepare("SELECT c.idcerita, c.judul, u.nama AS pembuat_awal FROM cerita c JOIN users u ON c.idusers_pembuat_awal = u.idusers WHERE judul LIKE ?");
        $keyword = "%" . $keyword . "%";
        $query->bind_param("s", $keyword);
        $query->execute();
        $result = $query->get_result();

        $hasil_pencarian = array();
        while ($row = $result->fetch_assoc()) {
            $hasil_pencarian[] = $row;
        }

        return $hasil_pencarian;
    }

    public function ambilDaftarCerita() {
        $query = $this->mysqli->query("SELECT c.idcerita, c.judul, u.nama AS pembuat_awal FROM cerita c JOIN users u ON c.idusers_pembuat_awal = u.idusers");
        $daftar_cerita = array();

        while ($row = $query->fetch_assoc()) {
            $daftar_cerita[] = $row;
        }

        return $daftar_cerita;
    }

    public function cekJudulCerita($judul) {
        $query = $this->mysqli->prepare("SELECT idcerita FROM cerita WHERE judul = ?");
        $query->bind_param("s", $judul);
        $query->execute();
        $query->store_result();

        return $query->num_rows > 0;
    }

    public function getLastInsertId() {
        return $this->mysqli->insert_id;
    }

    public function getById($idcerita) {
        $query = $this->mysqli->prepare("SELECT * FROM cerita WHERE idcerita = ?");
        $query->bind_param("i", $idcerita);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
    }
}



}
?>
