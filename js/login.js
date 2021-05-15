document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formLogin');
    const div = document.getElementById('estado');
    const span = document.getElementById('countdown');

    form.addEventListener('submit', function(ev) {
        ev.preventDefault();

        div.classList.add('d-none');

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
                div.classList.remove('d-none', 'alert-danger', 'alert-success');
                if(response.success) {
                    div.classList.add('alert-success');
                    estado.innerHTML = "Iniciaste sesión correctamente. Redireccionando... ";
                    setTimeout(
                        function () {
                            location.href = 'secciones/abm.php';
                        }, 2000
                    );

                } else {
                    div.classList.add('alert-danger');
                    estado.innerHTML = "El email o la contraseña no son correctos.";
                }
            });
    });
});
