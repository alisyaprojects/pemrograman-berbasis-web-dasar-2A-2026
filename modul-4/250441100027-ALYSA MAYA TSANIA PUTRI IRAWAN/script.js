const btn = document.getElementById('mode-toggle');
const icon = document.getElementById('icon-mode');
const body = document.body;

if (btn) {
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        if (icon) icon.classList.replace('fa-moon', 'fa-sun');
    }

    btn.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            if (icon) icon.classList.replace('fa-moon', 'fa-sun');
            localStorage.setItem('theme', 'dark');
        } else {
            if (icon) icon.classList.replace('fa-sun', 'fa-moon');
            localStorage.setItem('theme', 'light');
        }
    });
}

const form = document.getElementById("login-form");

if (form) {
    form.addEventListener("submit", function(e) {
        e.preventDefault(); 

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (email === "admin@gmail.com" && password === "12345") {
            window.location.href = "hal2.html"; 
        } else {
            alert("Email atau password salah! Gunakan admin@gmail.com dan 12345");
        }
    });
}