<?php
session_start();
include 'config/koneksi.php';

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['register'])){

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $cek = mysqli_query($conn, "
        SELECT * FROM pengguna
        WHERE username = '$username'
    ");

    if(mysqli_num_rows($cek) > 0){

        $error = "Username sudah digunakan!";

    } else {

        if($password != $confirm_password){

            $error = "Konfirmasi password tidak cocok!";

        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = mysqli_query($conn, "
                INSERT INTO pengguna(
                    username,
                    email,
                    password,
                    role
                )
                VALUES(
                    '$username',
                    '$email',
                    '$password_hash',
                    'user'
                )
            ");

            if($query){

                echo "
                    <script>
                        alert('Register berhasil!');
                        window.location='login.php';
                    </script>
                ";

            } else {

                $error = "Register gagal!";
            }

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Soluna</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body class="min-h-screen relative overflow-x-hidden text-white">

    <div class="absolute inset-0">

        <img src="allfoto/background login page.jpg"
             class="w-full h-full object-cover">

    </div>

    <div class="absolute inset-0 bg-[#20364F]/75 backdrop-blur-sm"></div>

    <div class="absolute top-[-120px] left-[-120px] w-[320px] h-[320px] bg-[#8FAFC1]/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-[-120px] right-[-120px] w-[320px] h-[320px] bg-[#D7D8B5]/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-md">

            <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-[35px] p-10 shadow-2xl">

                <div class="text-center mb-8">

                    <h1 class="text-5xl font-bold text-[#D7D8B5] mb-3">
                        Soluna
                    </h1>

                    <p class="text-gray-200">
                        Create your account ✨
                    </p>

                </div>

                <?php if(isset($error)) : ?>

                    <div class="bg-red-500/20 border border-red-400 text-red-100 px-4 py-3 rounded-2xl mb-6">

                        <?= $error; ?>

                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="mb-5">

                        <label class="block mb-2 text-gray-200">
                            Username
                        </label>

                        <input type="text"
                               name="username"
                               required
                               placeholder="Enter your username"
                               class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none placeholder-gray-300">

                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 text-gray-200">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               required
                               placeholder="Enter your email"
                               class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none placeholder-gray-300">

                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 text-gray-200">
                            Password
                        </label>

                        <input type="password"
                               name="password"
                               required
                               placeholder="Enter your password"
                               class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none placeholder-gray-300">

                    </div>

                    <div class="mb-7">

                        <label class="block mb-2 text-gray-200">
                            Confirm Password
                        </label>

                        <input type="password"
                               name="confirm_password"
                               required
                               placeholder="Confirm your password"
                               class="w-full bg-white/10 border border-white/10 rounded-2xl px-5 py-4 outline-none placeholder-gray-300">

                    </div>

                    <button type="submit"
                            name="register"
                            class="w-full bg-[#D7D8B5] text-[#20364F] py-4 rounded-2xl font-semibold hover:scale-[1.02] transition">

                        Register

                    </button>

                </form>

                <p class="text-center text-gray-300 mt-7">

                    Already have an account?

                    <a href="login.php"
                       class="text-[#D7D8B5] hover:underline">

                        Login

                    </a>

                </p>

            </div>

        </div>

    </div>

</body>
</html>