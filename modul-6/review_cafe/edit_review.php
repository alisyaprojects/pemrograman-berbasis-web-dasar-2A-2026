<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$queryReview = mysqli_query($conn, "
    SELECT * FROM review
    WHERE id = '$id'
");

$review = mysqli_fetch_assoc($queryReview);

if(!$review){
    header("Location: dashboard.php");
    exit;
}

if($_SESSION['id'] != $review['id_user'] && $_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['update'])){

    $rating = $_POST['rating'];
    $komentar = htmlspecialchars($_POST['komentar']);

    if($rating < 1 || $rating > 5){

        $error = "Rating harus 1 sampai 5!";

    } else {

        $queryUpdate = mysqli_query($conn, "
            UPDATE review
            SET rating = '$rating',
                komentar = '$komentar'
            WHERE id = '$id'
        ");

        if($queryUpdate){
            echo "
                <script>
                    alert('Review berhasil diupdate!');
                    window.location='detail_cafe.php?id=".$review['id_cafe']."';
                </script>
            ";
        } else {
            $error = "Review gagal diupdate!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review | Soluna</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#20364F] min-h-screen text-white flex items-center justify-center px-6 py-10 overflow-x-hidden">

    <div class="absolute top-[-120px] left-[-120px] w-[320px] h-[320px] bg-[#8FAFC1]/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-120px] right-[-120px] w-[320px] h-[320px] bg-[#D7D8B5]/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-2xl bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-10 shadow-2xl">

        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold mb-3">
                Edit Review ✨
            </h1>

            <p class="text-gray-300">
                Update your cafe experience.
            </p>
        </div>

        <?php if(isset($error)) : ?>
            <div class="bg-red-500/20 border border-red-400 text-red-100 px-4 py-3 rounded-2xl mb-6">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">

            <div>
                <label class="block mb-2 text-gray-300">
                    Rating
                </label>

                <select name="rating"
                        required
                        class="w-full bg-[#20364F] border border-white/10 rounded-2xl px-5 py-4 outline-none">

                    <option value="1" <?= $review['rating'] == 1 ? 'selected' : ''; ?>>1 ⭐</option>
                    <option value="2" <?= $review['rating'] == 2 ? 'selected' : ''; ?>>2 ⭐</option>
                    <option value="3" <?= $review['rating'] == 3 ? 'selected' : ''; ?>>3 ⭐</option>
                    <option value="4" <?= $review['rating'] == 4 ? 'selected' : ''; ?>>4 ⭐</option>
                    <option value="5" <?= $review['rating'] == 5 ? 'selected' : ''; ?>>5 ⭐</option>

                </select>
            </div>

            <div>
                <label class="block mb-2 text-gray-300">
                    Review
                </label>

                <textarea name="komentar"
                          rows="6"
                          required
                          class="w-full bg-[#20364F] border border-white/10 rounded-2xl px-5 py-4 outline-none resize-none"><?= htmlspecialchars($review['komentar']); ?></textarea>
            </div>

            <div class="flex flex-col md:flex-row gap-4">

                <a href="detail_cafe.php?id=<?= $review['id_cafe']; ?>"
                   class="w-full text-center bg-white/10 border border-white/10 py-4 rounded-2xl hover:bg-white/20 transition">
                    Cancel
                </a>

                <button type="submit"
                        name="update"
                        class="w-full bg-[#D7D8B5] text-[#20364F] py-4 rounded-2xl font-semibold hover:scale-[1.02] transition">
                    Update Review
                </button>

            </div>

        </form>

    </div>

</body>
</html>