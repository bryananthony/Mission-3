<?php
require_once("data.php");

class ParentClass {

    
    public function __construct() {
        $this->mysqli = new mysqli(server, username, password, database);
        if ($this->mysqli->connect_error) {
            die("Koneksi database gagal: " . $this->mysqli->connect_error);
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }
}
?>
