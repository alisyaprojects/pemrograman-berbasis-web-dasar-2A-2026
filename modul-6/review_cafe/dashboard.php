<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$search = "";

if(isset($_GET['search'])){
    $search = htmlspecialchars($_GET['search']);
}

$queryCafe = mysqli_query($conn, "
    SELECT * FROM cafe
    WHERE nama_cafe LIKE '%$search%'
    OR lokasi LIKE '%$search%'
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Soluna</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        .light body{
            background: #F5F5F5;
            color: #20364F;
        }

        .light .nav-light{
            background: rgba(255,255,255,0.85);
            border-color: rgba(32,54,79,0.15);
        }

        .light .glass{
            background: rgba(255,255,255,0.75);
            border-color: rgba(32,54,79,0.12);
            color: #20364F;
        }

        .light .muted{
            color: #5D7F9D;
        }
    </style>

    <script>
        if(localStorage.getItem('theme') === 'light'){
            document.documentElement.classList.add('light');
        }
    </script>
</head>

<body class="bg-[#20364F] text-white overflow-x-hidden transition-colors duration-500">

    <div class="fixed top-[-120px] left-[-120px] w-[350px] h-[350px] bg-[#8FAFC1]/20 rounded-full blur-3xl"></div>
    <div class="fixed bottom-[-120px] right-[-120px] w-[350px] h-[350px] bg-[#D7D8B5]/10 rounded-full blur-3xl"></div>

    <nav class="nav-light sticky top-0 z-50 bg-[#20364F]/80 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="dashboard.php" class="text-3xl font-bold text-[#D7D8B5]">
                Soluna
            </a>

            <div class="flex items-center gap-4">

                <div class="hidden md:block text-gray-300 muted">
                    Hi,
                    <span class="text-[#D7D8B5] font-semibold">
                        <?= htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </div>

                <?php if($_SESSION['role'] == 'admin') : ?>
                    <a href="tambah_cafe.php"
                       class="bg-[#D7D8B5] text-[#20364F] px-5 py-2 rounded-2xl font-semibold hover:scale-105 transition">
                        + Add Cafe
                    </a>
                <?php endif; ?>

                <button onclick="toggleTheme()"
                        id="themeButton"
                        class="glass bg-white/10 border border-white/10 px-4 py-2 rounded-2xl hover:bg-white/20 transition">
                    🌙
                </button>

                <a href="logout.php"
                   class="glass bg-white/10 border border-white/10 px-5 py-2 rounded-2xl hover:bg-white/20 transition">
                    Logout
                </a>

            </div>
        </div>
    </nav>

    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                    Find Your Next
                    <span class="text-[#D7D8B5]">
                        Cozy Place ☕
                    </span>
                </h1>

                <p class="text-gray-300 muted text-lg max-w-2xl mx-auto">
                    Explore aesthetic cafes, relaxing places, and your next favorite coffee spot.
                </p>
            </div>

            <form method="GET" class="max-w-3xl mx-auto mb-16">
                <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[30px] p-4 shadow-2xl">

                    <div class="flex flex-col md:flex-row gap-4">

                        <input type="text"
                               name="search"
                               value="<?= htmlspecialchars($search); ?>"
                               placeholder="Search cafe or location..."
                               class="glass w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-gray-300 outline-none">

                        <button type="submit"
                                class="bg-[#D7D8B5] text-[#20364F] px-8 py-4 rounded-2xl font-semibold hover:scale-105 transition">
                            Search
                        </button>

                    </div>

                </div>
            </form>

            <?php if(mysqli_num_rows($queryCafe) > 0) : ?>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <?php while($cafe = mysqli_fetch_assoc($queryCafe)) : ?>

                        <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] overflow-hidden shadow-2xl hover:scale-[1.02] transition">

                            <img src="uploads/<?= htmlspecialchars($cafe['foto']); ?>"
                                 class="w-full h-[210px] object-cover">

                            <div class="p-5">

                                <h2 class="text-xl font-semibold mb-2">
                                    <?= htmlspecialchars($cafe['nama_cafe']); ?>
                                </h2>

                                <p class="text-gray-300 muted mb-2 text-sm">
                                    📍 <?= htmlspecialchars($cafe['lokasi']); ?>
                                </p>

                                <p class="text-gray-400 muted mb-5 text-sm line-clamp-2 leading-relaxed">
                                    <?= htmlspecialchars($cafe['fasilitas']); ?>
                                </p>

                                <div class="flex flex-wrap items-center gap-2">

                                    <a href="detail_cafe.php?id=<?= $cafe['id']; ?>"
                                       class="bg-[#D7D8B5] text-[#20364F] px-4 py-2 rounded-xl text-sm font-semibold hover:scale-105 transition">
                                        View Details
                                    </a>

                                    <?php if($_SESSION['role'] == 'admin') : ?>

                                        <a href="edit_cafe.php?id=<?= $cafe['id']; ?>"
                                           class="bg-[#8FAFC1] text-white px-4 py-2 rounded-xl text-sm hover:scale-105 transition">
                                            Edit
                                        </a>

                                        <a href="hapus_cafe.php?id=<?= $cafe['id']; ?>"
                                           onclick="return confirm('Yakin ingin menghapus cafe ini?')"
                                           class="bg-red-500 text-white px-4 py-2 rounded-xl text-sm hover:scale-105 transition">
                                            Delete
                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else : ?>

                <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[30px] p-10 text-center max-w-2xl mx-auto">
                    <h2 class="text-3xl font-semibold mb-4">
                        Cafe Not Found ☕
                    </h2>

                    <p class="text-gray-300 muted">
                        Try another keyword or location.
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </section>

<script>
    const themeButton = document.getElementById('themeButton');

    function setIcon(){
        if(document.documentElement.classList.contains('light')){
            themeButton.innerHTML = '☀️';
        } else {
            themeButton.innerHTML = '🌙';
        }
    }

    function toggleTheme(){
        document.documentElement.classList.toggle('light');

        if(document.documentElement.classList.contains('light')){
            localStorage.setItem('theme', 'light');
        } else {
            localStorage.setItem('theme', 'dark');
        }

        setIcon();
    }

    setIcon();
</script>

</body>
</html>