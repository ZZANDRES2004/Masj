document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('http://localhost:8081/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                usuario: email,
                contrasena: password
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(`✅ Bienvenido, ${data.nombre}`);
                window.location.href = data.redirectUrl;
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Error en el servidor');
        });
    });