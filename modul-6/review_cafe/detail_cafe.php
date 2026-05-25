<?php
session_start();
include 'config/koneksi.php';


if(!isset($_SESSION['login'])){
    header("Location: login.php");
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

$queryReview = mysqli_query($conn, "
    SELECT review.*, pengguna.username
    FROM review
    JOIN pengguna ON review.id_user = pengguna.id
    WHERE review.id_cafe = '$id'
    ORDER BY review.id DESC
");

$queryRating = mysqli_query($conn, "
    SELECT AVG(rating) AS rata_rating, COUNT(*) AS total_review
    FROM review
    WHERE id_cafe = '$id'
");

$dataRating = mysqli_fetch_assoc($queryRating);

$rating = round($dataRating['rata_rating'], 1);
$totalReview = $dataRating['total_review'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($cafe['nama_cafe']); ?> | Soluna</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#20364F] text-white overflow-x-hidden">

    <div class="fixed top-[-120px] left-[-120px] w-[350px] h-[350px] bg-[#8FAFC1]/20 rounded-full blur-3xl"></div>

    <div class="fixed bottom-[-120px] right-[-120px] w-[350px] h-[350px] bg-[#D7D8B5]/10 rounded-full blur-3xl"></div>

    <nav class="sticky top-0 z-50 bg-[#20364F]/80 backdrop-blur-xl border-b border-white/10">

        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="dashboard.php"
               class="text-3xl font-bold text-[#D7D8B5]">

                Soluna

            </a>

            <div class="flex items-center gap-3">

                <a href="dashboard.php"
                   class="bg-white/10 border border-white/10 px-5 py-2 rounded-2xl hover:bg-white/20 transition">

                    Back

                </a>

                <a href="logout.php"
                   class="bg-red-500/20 border border-red-400/20 px-5 py-2 rounded-2xl hover:bg-red-500/30 transition">

                    Logout

                </a>

            </div>

        </div>

    </nav>

    <section class="relative">

        <img src="uploads/<?= htmlspecialchars($cafe['foto']); ?>"
             class="w-full h-[480px] object-cover">

        <div class="absolute inset-0 bg-black/45"></div>

        <div class="absolute bottom-10 left-6 md:left-16 right-6">

            <div class="inline-block bg-white/10 border border-white/10 backdrop-blur-xl px-5 py-2 rounded-full mb-4 text-sm">
                Cafe Detail
            </div>

            <h1 class="text-5xl md:text-6xl font-bold mb-4">
                <?= htmlspecialchars($cafe['nama_cafe']); ?>
            </h1>

            <p class="text-xl text-gray-200">
                📍 <?= htmlspecialchars($cafe['lokasi']); ?>
            </p>

        </div>

    </section>

    <section class="px-6 py-16">

        <div class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-8 shadow-2xl">

                    <h2 class="text-3xl font-bold mb-6">
                        About This Cafe
                    </h2>

                    <div class="space-y-4 text-gray-300 text-lg">

                        <p>
                            🕒 <?= htmlspecialchars($cafe['jam_buka']); ?>
                        </p>

                        <p class="leading-relaxed">
                            ☕ <?= nl2br(htmlspecialchars($cafe['fasilitas'])); ?>
                        </p>

                    </div>

                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-8 shadow-2xl">

                    <div class="flex items-center justify-between mb-8">

                        <h2 class="text-3xl font-bold">
                            Reviews
                        </h2>

                        <span class="bg-[#D7D8B5] text-[#20364F] px-4 py-2 rounded-2xl font-semibold">
                            <?= $totalReview; ?> Review
                        </span>

                    </div>

                    <?php if(mysqli_num_rows($queryReview) > 0) : ?>

                        <div class="space-y-6">

                            <?php while($review = mysqli_fetch_assoc($queryReview)) : ?>

                                <div class="bg-white/10 border border-white/10 rounded-[25px] p-6">

                                    <div class="flex items-start justify-between gap-4 mb-4">

                                        <div>
                                            <h3 class="font-semibold text-xl">
                                                <?= htmlspecialchars($review['username']); ?>
                                            </h3>

                                            <p class="text-gray-400 text-sm mt-1">
                                                <?= $review['tanggal']; ?>
                                            </p>
                                        </div>

                                        <span class="bg-[#D7D8B5] text-[#20364F] px-4 py-2 rounded-2xl font-semibold whitespace-nowrap">
                                            ⭐ <?= $review['rating']; ?>/5
                                        </span>

                                    </div>

                                    <p class="text-gray-300 leading-relaxed mb-5">
                                        <?= nl2br(htmlspecialchars($review['komentar'])); ?>
                                    </p>

                                    <div class="flex flex-wrap gap-3">

                                        <?php if($_SESSION['id'] == $review['id_user']) : ?>

                                            <a href="edit_review.php?id=<?= $review['id']; ?>"
                                               class="bg-[#8FAFC1] text-white px-4 py-2 rounded-xl hover:scale-105 transition text-sm">

                                                Edit Review

                                            </a>

                                        <?php endif; ?>

                                        <?php if($_SESSION['role'] == 'admin') : ?>

                                            <a href="hapus_review.php?id=<?= $review['id']; ?>&cafe=<?= $cafe['id']; ?>"
                                               onclick="return confirm('Yakin ingin menghapus review ini?')"
                                               class="bg-red-500 text-white px-4 py-2 rounded-xl hover:scale-105 transition text-sm">

                                                Delete Review

                                            </a>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endwhile; ?>

                        </div>

                    <?php else : ?>

                        <div class="bg-white/10 rounded-[25px] p-8 text-center">

                            <h3 class="text-2xl font-semibold mb-3">
                                Belum Ada Review 😢
                            </h3>

                            <p class="text-gray-300">
                                Jadilah orang pertama yang memberi review cafe ini.
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="space-y-8">

                <div class="bg-[#D7D8B5] text-[#20364F] rounded-[35px] p-10 text-center shadow-2xl">

                    <h2 class="text-6xl font-bold mb-3">
                        <?= $rating ? $rating : '0.0'; ?>
                    </h2>

                    <p class="font-semibold text-lg">
                        Average Rating
                    </p>

                    <p class="text-sm mt-2">
                        <?= $totalReview; ?> review
                    </p>

                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-8 shadow-2xl">

                    <h2 class="text-2xl font-bold mb-6">
                        Add Review ✍️
                    </h2>

                    <form action="tambah_review.php" method="POST" class="space-y-5">

                        <input type="hidden"
                               name="id_cafe"
                               value="<?= $cafe['id']; ?>">

                        <div>

                            <label class="block mb-2 text-gray-300">
                                Rating
                            </label>

                            <select name="rating"
                                    required
                                    class="w-full bg-[#20364F] border border-white/10 rounded-2xl px-5 py-4 outline-none">

                                <option value="">
                                    Choose Rating
                                </option>

                                <option value="1">
                                    1 ⭐
                                </option>

                                <option value="2">
                                    2 ⭐
                                </option>

                                <option value="3">
                                    3 ⭐
                                </option>

                                <option value="4">
                                    4 ⭐
                                </option>

                                <option value="5">
                                    5 ⭐
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="block mb-2 text-gray-300">
                                Review
                            </label>

                            <textarea name="komentar"
                                      rows="5"
                                      required
                                      placeholder="Share your cafe experience..."
                                      class="w-full bg-[#20364F] border border-white/10 rounded-2xl px-5 py-4 outline-none resize-none placeholder-gray-400"></textarea>

                        </div>

                        <button type="submit"
                                class="w-full bg-[#D7D8B5] text-[#20364F] py-4 rounded-2xl font-semibold hover:scale-[1.02] transition">

                            Submit Review

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</body>
</html>