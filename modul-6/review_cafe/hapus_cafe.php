<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$queryCafe = mysqli_query($conn, "
    SELECT * FROM cafe
    WHERE id = '$id'
");

$cafe = mysqli_fetch_assoc($queryCafe);

if(!$cafe){
    header("Location: dashboard.php");
    exit;
}

if(!empty($cafe['foto']) && file_exists("uploads/" . $cafe['foto'])){
    unlink("uploads/" . $cafe['foto']);
}

$queryDelete = mysqli_query($conn, "
    DELETE FROM cafe
    WHERE id = '$id'
");

if($queryDelete){
    echo "
        <script>
            alert('Cafe berhasil dihapus!');
            window.location='dashboard.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Cafe gagal dihapus!');
            window.location='dashboard.php';
        </script>
    ";
}
?>