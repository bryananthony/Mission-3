<?php
require_once("parent.php");
session_start();

class Users extends ParentClass {
    public function __construct() {
        parent::__construct();
    }

    public function register($idusers, $nama, $password) {
        $salt = $this->generateSalt();
        $encryptedPassword = $this->encryptPwd($password, $salt);

        $query = $this->mysqli->prepare("INSERT INTO users (idusers, nama, password, salt) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $idusers, $nama, $encryptedPassword, $salt);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function login($idusers, $password) {
        $query = $this->mysqli->prepare("SELECT idusers, password, salt FROM users WHERE idusers = ?");
        $query->bind_param("s", $idusers);
        $query->execute();
        $query->store_result();
        
        if ($query->num_rows == 1) {
            $query->bind_result($idusers, $dbPassword, $salt);
            $query->fetch();
            
            $passwordToCheck = $this->encryptPwd($password, $salt);

            if ($passwordToCheck === $dbPassword) {
                return $idusers;
            }
        }
        
        return false;
    }

    private function generateSalt() {
        return bin2hex(random_bytes(10));
    }

    private function encryptPwd($password, $salt) {
        return hash('sha256', $password . $salt);
    }


    public function getUserNameById($idusers) {
    $query = $this->db->prepare("SELECT nama FROM users WHERE idusers = ?");
    $query->bind_param("s", $idusers);
    $query->execute();
    $query->store_result();

    if ($query->num_rows == 1) {
        $query->bind_result($nama);
        $query->fetch();
        return $nama;
    } else {
        return false;
    }
}

}
?>
