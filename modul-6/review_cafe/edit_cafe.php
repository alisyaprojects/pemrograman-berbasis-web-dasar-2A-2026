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

if(isset($_POST['update'])){

    $nama_cafe = htmlspecialchars($_POST['nama_cafe']);
    $lokasi = htmlspecialchars($_POST['lokasi']);
    $fasilitas = htmlspecialchars($_POST['fasilitas']);
    $jam_buka = htmlspecialchars($_POST['jam_buka']);

    if($_FILES['foto']['name'] != ""){

        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $nama_foto = time() . "_" . $foto;

        move_uploaded_file($tmp, "uploads/" . $nama_foto);

        if(file_exists("uploads/" . $cafe['foto'])){
            unlink("uploads/" . $cafe['foto']);
        }

        $query = mysqli_query($conn, "
            UPDATE cafe
            SET
                nama_cafe = '$nama_cafe',
                lokasi = '$lokasi',
                fasilitas = '$fasilitas',
                jam_buka = '$jam_buka',
                foto = '$nama_foto'
            WHERE id = '$id'
        ");

    } else {

        $query = mysqli_query($conn, "
            UPDATE cafe
            SET
                nama_cafe = '$nama_cafe',
                lokasi = '$lokasi',
                fasilitas = '$fasilitas',
                jam_buka = '$jam_buka'
            WHERE id = '$id'
        ");

    }

    if($query){

        echo "
            <script>
                alert('Cafe berhasil diupdate!');
                window.location='dashboard.php';
            </script>
        ";

    } else {

        $error = "Cafe gagal diupdate!";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cafe | Soluna</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body class="bg-[#20364F] min-h-screen text-white overflow-x-hidden">

    <nav class="sticky top-0 z-50 bg-[#20364F]/80 backdrop-blur-xl border-b border-white/10">

        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="dashboard.php"
               class="text-3xl font-bold text-[#D7D8B5]">

                Soluna

            </a>

            <a href="dashboard.php"
               class="bg-white/10 border border-white/10 px-5 py-2 rounded-2xl hover:bg-white/20 transition">

                Back

            </a>

        </div>

    </nav>

    <section class="px-6 py-14">

        <div class="max-w-3xl mx-auto bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-10 shadow-2xl">

            <div class="mb-10">

                <h1 class="text-4xl font-bold mb-3">

                    Edit Cafe ☕

                </h1>

                <p class="text-gray-300">

                    Update cafe information for Soluna.

                </p>

            </div>

            <?php if(isset($error)) : ?>

                <div class="bg-red-500/20 border border-red-400 text-red-100 px-4 py-3 rounded-2xl mb-6">

                    <?= $error; ?>

                </div>

            <?php endif; ?>

            <form method="POST"
                  enctype="multipart/form-data">

                <div class="mb-6">

                    <label class="block mb-2 text-gray-200">
                        Nama Cafe
                    </label>

                    <input type="text"
                           name="nama_cafe"
                           required
                           value="<?= htmlspecialchars($cafe['nama_cafe']); ?>"
                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-gray-200">
                        Lokasi
                    </label>

                    <input type="text"
                           name="lokasi"
                           required
                           value="<?= htmlspecialchars($cafe['lokasi']); ?>"
                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-gray-200">
                        Jam Buka
                    </label>

                    <input type="text"
                           name="jam_buka"
                           required
                           value="<?= htmlspecialchars($cafe['jam_buka']); ?>"
                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-gray-200">
                        Fasilitas / Deskripsi
                    </label>

                    <textarea name="fasilitas"
                              rows="5"
                              required
                              class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none resize-none"><?= htmlspecialchars($cafe['fasilitas']); ?></textarea>

                </div>

                <div class="mb-6">

                    <label class="block mb-3 text-gray-200">
                        Current Photo
                    </label>

                    <img src="uploads/<?= htmlspecialchars($cafe['foto']); ?>"
                         class="w-full h-[260px] object-cover rounded-3xl border border-white/10">

                </div>

                <div class="mb-8">

                    <label class="block mb-2 text-gray-200">
                        New Photo (Optional)
                    </label>

                    <input type="file"
                           name="foto"
                           class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4">

                </div>

                <button type="submit"
                        name="update"
                        class="w-full bg-[#D7D8B5] text-[#20364F] py-4 rounded-2xl font-semibold hover:scale-[1.02] transition">

                    Update Cafe

                </button>

            </form>

        </div>

    </section>

</body>
</html>