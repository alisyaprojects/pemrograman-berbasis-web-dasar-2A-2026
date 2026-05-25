<?php
session_start();
include 'config/koneksi.php';

$queryCafe = mysqli_query($conn, "
    SELECT * FROM cafe
    ORDER BY id DESC
    LIMIT 6
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluna | Cafe Review Platform</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        html{
            scroll-behavior: smooth;
        }

        .light body{
            background: #F5F5F5;
            color: #20364F;
        }

        .light .nav-light{
            background: rgba(255,255,255,0.85);
            border-color: rgba(32,54,79,0.1);
        }

        .light .glass{
            background: rgba(255,255,255,0.75);
            border-color: rgba(32,54,79,0.12);
            color: #20364F;
        }

        .light .muted{
            color: #5D7F9D;
        }

        .light .light-bg-main{
            background: #F5F5F5;
        }

        .light .light-bg-secondary{
            background: #ECECEC;
        }

        .light .light-bg-third{
            background: #EAEAEA;
        }

        .light .hero-overlay{
            background: rgba(245, 245, 245, 0.72);
        }

        .light .hero-image{
            filter: brightness(1.08);
        }
    </style>

    <script>
        if(localStorage.getItem('theme') === 'light'){
            document.documentElement.classList.add('light');
        }
    </script>
</head>

<body class="bg-[#20364F] text-white overflow-x-hidden transition-colors duration-500">

    <nav class="nav-light fixed top-0 left-0 w-full z-50 bg-[#20364F]/80 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <h1 class="text-3xl font-bold text-[#D7D8B5]">
                Soluna
            </h1>

            <div class="hidden md:flex items-center gap-8 text-gray-200 muted">
                <a href="#home" class="hover:text-[#D7D8B5] transition">Home</a>
                <a href="#explore" class="hover:text-[#D7D8B5] transition">Explore</a>
                <a href="#features" class="hover:text-[#D7D8B5] transition">Features</a>
                <a href="#fitur" class="hover:text-[#D7D8B5] transition">Fitur</a>
            </div>

            <div class="flex items-center gap-3">

                <button onclick="toggleTheme()"
                        id="themeButton"
                        class="glass bg-white/10 border border-white/10 px-4 py-2 rounded-2xl hover:bg-white/20 transition">
                    🌙
                </button>

                <a href="login.php"
                   class="glass px-5 py-2 rounded-2xl border border-white/20 hover:bg-white/10 transition">
                    Login
                </a>

                <a href="register.php"
                   class="bg-[#D7D8B5] text-[#20364F] px-5 py-2 rounded-2xl font-semibold hover:scale-105 transition">
                    Register
                </a>

            </div>
        </div>
    </nav>

    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <div class="absolute inset-0">
            <img src="allfoto/background login page.jpg"
                 class="hero-image w-full h-full object-cover">
        </div>

        <div class="hero-overlay absolute inset-0 bg-[#20364F]/75"></div>

        <div class="relative z-10 text-center px-6 max-w-4xl pt-20">

            <div class="mb-8">

                <span class="glass bg-white/10 border border-white/20 backdrop-blur-md px-5 py-3 rounded-full text-sm">

                    Modern Cafe Review Platform

                </span>

            </div>

            <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-8">

                Discover Cozy Cafes
                <span class="text-[#D7D8B5]">
                    And Good Moments
                </span>

            </h1>

            <p class="muted text-lg md:text-xl text-gray-300 leading-relaxed mb-10">

                Explore aesthetic cafes, share honest reviews,
                and discover your next favorite place for coffee,
                conversations, or peaceful moments alone.

            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">

                <a href="register.php"
                   class="bg-[#D7D8B5] text-[#20364F] px-8 py-4 rounded-2xl font-semibold hover:scale-105 transition shadow-xl">

                    Get Started

                </a>

                <a href="#explore"
                   class="glass border border-white/20 bg-white/10 backdrop-blur-md px-8 py-4 rounded-2xl hover:bg-white/20 transition">

                    Explore Cafe

                </a>

            </div>

        </div>

    </section>

    <section class="relative bg-[#2B4663] light-bg-third px-6 py-16 border-t border-white/5">

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-7 text-center shadow-xl hover:-translate-y-2 transition">

                <h2 class="text-3xl font-bold text-[#D7D8B5] mb-2">
                    120+
                </h2>

                <p class="muted text-gray-300">
                    Cozy Cafes
                </p>

            </div>

            <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-7 text-center shadow-xl hover:-translate-y-2 transition">

                <h2 class="text-3xl font-bold text-[#D7D8B5] mb-2">
                    500+
                </h2>

                <p class="muted text-gray-300">
                    Honest Reviews
                </p>

            </div>

            <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-7 text-center shadow-xl hover:-translate-y-2 transition">

                <h2 class="text-3xl font-bold text-[#D7D8B5] mb-2">
                    1K+
                </h2>

                <p class="muted text-gray-300">
                    Cafe Lovers
                </p>

            </div>

            <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-7 text-center shadow-xl hover:-translate-y-2 transition">

                <h2 class="text-3xl font-bold text-[#D7D8B5] mb-2">
                    20+
                </h2>

                <p class="muted text-gray-300">
                    Locations
                </p>

            </div>

        </div>

    </section>

    <section id="explore" class="relative py-24 px-6 bg-[#20364F] light-bg-main border-t border-white/5">

        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">

                <h2 class="text-4xl md:text-5xl font-bold mb-5">

                    Explore Popular Cafes

                </h2>

                <p class="muted text-gray-300 text-lg">

                    Find aesthetic cafes and cozy places around you.

                </p>

            </div>

            <?php if(mysqli_num_rows($queryCafe) > 0) : ?>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <?php while($cafe = mysqli_fetch_assoc($queryCafe)) : ?>

                        <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] overflow-hidden shadow-2xl hover:scale-[1.02] transition">

                            <img src="uploads/<?= htmlspecialchars($cafe['foto']); ?>"
                                 class="w-full h-[210px] object-cover">

                            <div class="p-5">

                                <h3 class="text-xl font-semibold mb-2">

                                    <?= htmlspecialchars($cafe['nama_cafe']); ?>

                                </h3>

                                <p class="muted text-gray-300 mb-2 text-sm">

                                    <?= htmlspecialchars($cafe['lokasi']); ?>

                                </p>

                                <p class="muted text-gray-400 mb-5 text-sm line-clamp-2 leading-relaxed">

                                    <?= htmlspecialchars($cafe['fasilitas']); ?>

                                </p>

                                <a href="login.php"
                                   class="inline-block bg-[#D7D8B5] text-[#20364F] px-4 py-2 rounded-xl text-sm font-semibold hover:scale-105 transition">

                                    View Details

                                </a>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <section id="features" class="relative py-24 px-6 bg-[#2A425C] light-bg-secondary border-t border-white/5">

        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">

                <h2 class="text-4xl md:text-5xl font-bold mb-5">

                    Why Soluna?

                </h2>

                <p class="muted text-gray-300 text-lg">

                    More than just a cafe review platform.

                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-8 shadow-2xl hover:-translate-y-2 transition">

                    <h3 class="text-2xl font-semibold mb-4">
                        Cozy Atmosphere
                    </h3>

                    <p class="muted text-gray-300 leading-relaxed">

                        Discover cafes with warm interiors,
                        relaxing vibes, and comfortable spaces.

                    </p>

                </div>

                <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-8 shadow-2xl hover:-translate-y-2 transition">

                    <h3 class="text-2xl font-semibold mb-4">
                        Honest Reviews
                    </h3>

                    <p class="muted text-gray-300 leading-relaxed">

                        Read authentic experiences and ratings
                        from cafe lovers around you.

                    </p>

                </div>

                <div class="glass bg-white/10 border border-white/10 backdrop-blur-xl rounded-[28px] p-8 shadow-2xl hover:-translate-y-2 transition">

                    <h3 class="text-2xl font-semibold mb-4">
                        Favorite Moments
                    </h3>

                    <p class="muted text-gray-300 leading-relaxed">

                        Find the perfect place for coffee,
                        conversations, or peaceful alone time.

                    </p>

                </div>

            </div>

        </div>

    </section>

    <footer class="bg-[#20364F] light-bg-main border-t border-white/10 py-8 px-6">

        <div class="max-w-7xl mx-auto text-center muted text-gray-400">

            © 2026 Soluna. All rights reserved.

        </div>

    </footer>

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