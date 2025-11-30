<?php
// AuthController.php
require_once __DIR__ . '/../config/koneksi.php';

class AuthController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT id_pakar, username, password FROM pakar WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['pakar_logged_in'] = true;
                $_SESSION['pakar_username'] = $row['username'];
                return "";
            } else {
                return "Username atau Password salah.";
            }
        } else {
            return "Username atau Password salah.";
        }
    }

    public static function checkAuth() {
        if (!isset($_SESSION['pakar_logged_in']) || $_SESSION['pakar_logged_in'] !== true) {
            header("Location: login.php");
            exit;
        }
    }

    public static function logout() {
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }
}
?>