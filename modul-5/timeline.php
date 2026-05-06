<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Timeline Belajar Coding</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-[#1e1b4b] via-[#312e81] to-[#1e293b] text-white p-6">

<?php

$timeline = [
    ["tahun" => "2023", "kegiatan" => "Sama sekali belum tertarik ke dunia TI tapi sudah mulai berpikir kalau dunia TI itu menarik"],
    ["tahun" => "2024", "kegiatan" => "Ditahun ini saya mulai tertarik dan belajar tentang perodingan tapi belum serius dan itu masih menggunakan hp"],
    ["tahun" => "2025", "kegiatan" => "Tahun 2025 saya lulus dari SMA memutuskan untuk memasuki dunia IT"],
    ["tahun" => "2025", "kegiatan" => "Dibulan agustus itu sudah memasuki dunia perkuliahan dan itu saya mulai belajar Python untuk pertama kalinya"],
    ["tahun" => "2026", "kegiatan" => "Belajar bahasa pemrograman yang lain sambil membuat project sederhana"]
];
?>

<div class="max-w-3xl mx-auto">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-emerald-300">
            Timeline Perjalanan Belajar Coding
        </h1>
    </div>

    <div class="relative border-l-2 border-indigo-400 pl-6 space-y-8">

        <?php foreach($timeline as $data): ?>
            
            <div class="relative">

                <div class="absolute -left-[13px] top-4 w-4 h-4 bg-indigo-400 rounded-full ring-4 ring-indigo-500/30"></div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10 shadow hover:scale-[1.02] transition">

                    <p class="text-lg text-emerald-300">
                        <?= $data['tahun']; ?>
                    </p>

                    <p class="mt-1 text-emerald-300">
                        <?= $data['kegiatan']; ?>
                    </p>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <div class="flex justify-between mt-12">

        <a href="index.php"
           class="bg-indigo-500 hover:bg-indigo-400 px-5 py-2 rounded-full transition text-emerald-300">
            ← Kembali ke Profil
        </a>

        <a href="blog.php"
           class="bg-indigo-500 hover:bg-indigo-400 px-5 py-2 rounded-full transition text-emerald-300">
            Menuju Blog Developer →
        </a>

    </div>

</div>

</body>
</html>