<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$id_cafe = $_GET['cafe'];

$queryReview = mysqli_query($conn, "
    SELECT * FROM review
    WHERE id = '$id'
");

$review = mysqli_fetch_assoc($queryReview);

if(!$review){
    header("Location: dashboard.php");
    exit;
}

if($_SESSION['role'] != 'admin' && $_SESSION['id'] != $review['id_user']){
    header("Location: dashboard.php");
    exit;
}

$queryDelete = mysqli_query($conn, "
    DELETE FROM review
    WHERE id = '$id'
");

if($queryDelete){
    echo "
        <script>
            alert('Review berhasil dihapus!');
            window.location='detail_cafe.php?id=$id_cafe';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Review gagal dihapus!');
            window.location='detail_cafe.php?id=$id_cafe';
        </script>
    ";
}
?>