<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Interaktif Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-[#1e1b4b] via-[#312e81] to-[#1e293b] text-white p-6">

<div class="max-w-5xl mx-auto">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold">Profil Interaktif Developer</h1>
    </div>

    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-white/10">
        <div class="grid md:grid-cols-2 gap-6 items-center">

            <div class="flex justify-center ">
                <img src="allfoto/foto pake almet.jpeg"
                     class="rounded-xl w-64 aspect-[3/4] object-cover shadow-lg ">
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3 text-indigo-300 text-center">
                    Profil Interaktif Developer Pemula
                </h2>

                <table class="w-full text-sm border border-indigo-400/40">
                    <tr><td class="border p-2">Nama</td><td class="border p-2">Alysa Maya Tsania Putri Irawan</td></tr>
                    <tr><td class="border p-2">ID Developer</td><td class="border p-2">AMTP-01</td></tr>
                    <tr><td class="border p-2">Kota/Tgl Lahir</td><td class="border p-2">Bangkalan,  01-04-06</td></tr>
                    <tr><td class="border p-2">Email</td><td class="border p-2">alisyamaya146@gmail.com</td></tr>
                    <tr><td class="border p-2">No. WhatsApp</td><td class="border p-2">085278155520</td></tr>
                </table>
            </div>

        </div>
    </div>

    <div class="mt-12 bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-white/10">
        <form method="POST" class="space-y-4">

            <div>
                <label class="text-sm">Framework yang Digunakan</label>
                <input type="text" name="framework" placeholder="Contoh: PHP, Laravel, Tailwind"
                    class="w-full p-2 mt-1 bg-white/5 border border-indigo-400/40 rounded text-white">
            </div>

            <div>
                <label class="text-sm">Pengalaman Membuat Aplikasi</label>
                <textarea name="pengalaman"
                    class="w-full p-2 mt-1 bg-white/5 border border-indigo-400/40 rounded text-white"></textarea>
            </div>

            <div class="text-sm">
                Tools Penunjang:<br>
                <input type="checkbox" name="tools[]" value="VS Code"> VS Code
                <input type="checkbox" name="tools[]" value="GitHub"> GitHub
                <input type="checkbox" name="tools[]" value="Figma"> Figma
                <input type="checkbox" name="tools[]" value="Postman"> Postman
            </div>

            <div class="text-sm">
                Minat Bidang:<br>
                <input type="radio" name="minat" value="Frontend"> Frontend
                <input type="radio" name="minat" value="Backend"> Backend
                <input type="radio" name="minat" value="Fullstack"> Fullstack
            </div>

            <div>
                <label class="text-sm">Tingkat Skill Coding</label>
                <select name="level"
                    class="w-full mt-1 p-2 bg-white/10 border border-indigo-400/40 rounded text-white">
                    <option value="" class="text-black">Pilih Level</option>
                    <option value="Dasar" class="text-black">Dasar</option>
                    <option value="Cukup" class="text-black">Cukup</option>
                    <option value="Profesional" class="text-black">Profesional</option>
                </select>
            </div>

            <button type="submit" name="submit"
                class="w-full bg-indigo-500 hover:bg-indigo-400 py-2 rounded">
                Submit
            </button>

        </form>
    </div>

    <?php
    if(isset($_POST['submit'])){

        $framework = $_POST['framework'];
        $pengalaman = $_POST['pengalaman'];
        $tools = $_POST['tools'] ?? [];
        $minat = $_POST['minat'] ?? "";
        $level = $_POST['level'];

        if($framework == "" || $pengalaman == "" || $minat == "" || $level == ""){
            echo "<p class='text-red-400 mt-4 text-center'>Semua input wajib diisi!</p>";
        } else {

            $arr = explode(",", $framework);

            function tampilData($minat, $level, $tools){
                $toolList = !empty($tools) ? implode(", ", $tools) : "Tidak ada";

                echo "
                <table class='w-full mt-4 border border-indigo-400/40 text-sm'>
                    <tr><td class='border p-2'>Minat Bidang</td><td class='border p-2'>$minat</td></tr>
                    <tr><td class='border p-2'>Level Skill</td><td class='border p-2'>$level</td></tr>
                    <tr><td class='border p-2'>Tools Penunjang</td><td class='border p-2'>$toolList</td></tr>
                </table>";
            }

            echo "
            <div class='mt-10 bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-white/10'>
                <h2 class='text-center text-indigo-300 font-bold text-xl mb-4'>Hasil Input</h2>
            ";

            tampilData($minat, $level, $tools);

            echo "<div class='mt-4'>
                    <p class='font-semibold mb-2'>Framework yang digunakan:</p>
                    <div class='flex flex-wrap gap-2'>";
            foreach($arr as $f){
                echo "<span class='bg-indigo-500/20 px-3 py-1 rounded-full text-sm'>".trim($f)."</span>";
            }
            echo "  </div>
                  </div>";

            if(count($arr) > 2){
                echo "<p class='text-indigo-300 italic mt-3'>Skill Anda cukup luas di bidang development!</p>";
            }

            echo "<div class='mt-4'>
                    <p class='font-semibold'>Pengalaman:</p>
                    <p class='text-slate-300 mt-1'>$pengalaman</p>
                  </div>";

            echo "</div>";
        }
    }
    ?>

    <div class="text-center mt-12">
        <a href="timeline.php"
           class="inline-block bg-indigo-500 hover:bg-indigo-400 px-6 py-2 rounded-full">
            Halaman Selanjutnya →
        </a>
    </div>

</div>

</body>
</html>