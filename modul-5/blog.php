<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Blog Developer</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-[#1e1b4b] via-[#312e81] to-[#1e293b] text-white p-6">

<div class="max-w-5xl mx-auto">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold">Blog Reflektif Developer</h1>
    </div>

    <?php
 
    $artikel = [
        "html" => [
            "judul" => "Belajar HTML Pertama Kali",
            "tanggal" => "10 Maret 2026",
            "isi" => "Awal belajar HTML terasa membingungkan, tetapi sangat menyenangkan ketika berhasil membuat struktur halaman pertama.",
            "gambar" => "allfoto/hmtl.png",
            "link" => "https://www.w3schools.com/html/"
        ],
        "error" => [
            "judul" => "Error Pertama dalam Coding",
            "tanggal" => "15 September 2025",
            "isi" => "Mengalami error pertama membuat saya belajar untuk lebih teliti membaca kode dan memahami debugging.",
            "gambar" => "allfoto/eror.jpg",
            "link" => "https://stackoverflow.com/"
        ],
        "python" => [
            "judul" => "Belajar Python Pertama Kali",
            "tanggal" => "14 Agustus 2025",
            "isi" => "Belajar Python membuat saya lebih memahami logika pemrograman dan bagaimana menulis kode yang lebih rapi dan efisien.",
            "gambar" => "allfoto/pyhton.jpg",
            "link" => "https://www.python.org/"
        ]
    
    ];

    $pilih = $_GET['artikel'] ?? null;

    $quotes = [
        "Coding adalah seni memecahkan masalah.",
        "Error adalah guru terbaik dalam belajar coding.",
        "Terus belajar, karena teknologi selalu berkembang.",
        "Kesabaran adalah kunci menjadi developer handal."
    ];
    $randomQuote = $quotes[array_rand($quotes)];
    ?>

    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-indigo-300">Daftar Artikel</h2>

        <ul class="space-y-2">
            <?php foreach($artikel as $key => $data): ?>
                <li>
                    <a href="?artikel=<?= $key; ?>"
                       class="block bg-indigo-500/20 px-4 py-2 rounded hover:bg-indigo-400/30 transition">
                        <?= $data['judul']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if($pilih && isset($artikel[$pilih])): 
        $data = $artikel[$pilih];
    ?>
        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow">

            <h2 class="text-2xl font-bold text-indigo-300 mb-2">
                <?= $data['judul']; ?>
            </h2>

            <p class="text-sm text-slate-400 mb-4">
                <?= $data['tanggal']; ?>
            </p>

            <img src="<?= $data['gambar']; ?>"
                 class="w-full h-64 object-cover rounded-xl mb-4">

            <p class="text-slate-200 mb-4">
                <?= $data['isi']; ?>
            </p>

            <div class="bg-indigo-500/20 p-4 rounded-xl italic text-indigo-200 mb-4">
                "<?= $randomQuote; ?>"
            </div>

            <a href="<?= $data['link']; ?>" target="_blank"
               class="text-indigo-300 underline hover:text-indigo-200">
               Referensi Tambahan →
            </a>

        </div>
    <?php endif; ?>

    <div class="flex justify-between mt-10">

        <a href="timeline.php"
           class="bg-indigo-500 hover:bg-indigo-400 px-5 py-2 rounded-full">
            ← Kembali ke Timeline
        </a>

        <a href="index.php"
           class="bg-indigo-500 hover:bg-indigo-400 px-5 py-2 rounded-full">
            Kembali ke Profil →
        </a>

    </div>

</div>

</body>
</html>