<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];
$id_cafe = $_POST['id_cafe'];
$rating = $_POST['rating'];
$komentar = htmlspecialchars($_POST['komentar']);

if($rating < 1 || $rating > 5){
    echo "
        <script>
            alert('Rating harus 1 sampai 5!');
            window.history.back();
        </script>
    ";
    exit;
}

$query = mysqli_query($conn, "
    INSERT INTO review(id_user, id_cafe, rating, komentar)
    VALUES('$id_user', '$id_cafe', '$rating', '$komentar')
");

if($query){
    echo "
        <script>
            alert('Review berhasil ditambahkan!');
            window.location='detail_cafe.php?id=$id_cafe';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Review gagal ditambahkan!');
            window.history.back();
        </script>
    ";
}
?>