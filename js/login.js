document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formLogin');

    form.addEventListener('submit', function(ev) {
        ev.preventDefault();

        fetch('api/login.php', {
            method: 'POST',
            body: JSON.stringify({
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            })
        })
            .then(rta => rta.json())
            .then(response => {
                console.log(response);
                if(response.success) {
                    location.href = 'index.php';
                } else {
                    respuesta.innerHTML = "Las credenciales ingresadas no parecen ser correctas.";
                }
            });
    });

});
