<?php
require_once("parent.php");

class Paragraf extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buatParagraf($idusers, $idcerita, $isi_paragraf, $tanggal_buat)
    {
        $query = $this->mysqli->prepare("INSERT INTO paragraf (idusers, idcerita, isi_paragraf, tanggal_buat) VALUES (?, ?, ?, ?)");
        $query->bind_param("iiss", $idusers, $idcerita, $isi_paragraf, $tanggal_buat);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilParagraf($judul_cerita) {
        $query = $this->mysqli->prepare("SELECT isi_paragraf FROM paragraf WHERE idcerita = (SELECT idcerita FROM cerita WHERE judul = ?)");
        $query->bind_param("s", $judul_cerita);
        $query->execute();
        $result = $query->get_result();

        $paragraf_cerita = array();
        while ($row = $result->fetch_assoc()) {
            $paragraf_cerita[] = $row['isi_paragraf'];
        }

        return $paragraf_cerita;
    }


    public function getIdCeritaByJudul($judul) {
        $query = $this->mysqli->prepare("SELECT idcerita FROM cerita WHERE judul = ?");
        $query->bind_param("s", $judul);
        $query->execute();
        $query->store_result();
        
        if ($query->num_rows > 0) {
            $query->bind_result($idcerita);
            $query->fetch();
            return $idcerita;
        } else {
            return null; // Cerita not found
        }
    }


}
?>
