document.addEventListener('DOMContentLoaded', function () {
    const formRegistro = document.getElementById('formRegistro');

    /**
     * Realiza el fetch a la api para crear el usuario y muestra el resultado en pantalla
     */
    function crearUsuario() {
        const inputUsuario = document.getElementById('usuario');
        const inputEmail = document.getElementById('email');
        const inputPassword = document.getElementById('password');

        const data = {
            usuario: inputUsuario.value,
            email: inputEmail.value,
            password: inputPassword.value,
        };
        const estado = document.getElementById('estado');
        estado.classList.add('d-none');

        fetch('api/registro.php', {
                method: 'post',
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                estado.classList.remove('d-none', 'alert-danger', 'alert-success');
                console.log('respuesta del Post', responseData);
                estado.classList.add('alert');
                if (responseData.success) {
                    estado.classList.add('alert-success');

                    setTimeout(
                        function () {
                            location.href = 'login.php';
                        }, 2000
                    );
                } else {
                    estado.classList.add('alert-danger');

                }
                mostrarMensaje(responseData);
            });
    }

    formRegistro.addEventListener('submit', function (ev) {
        ev.preventDefault();

        crearUsuario();
    });
});

/**
 * Muestra mensaje de éxito o error en pantalla.
 * @param response
 */
function mostrarMensaje(response) {
    if (response.msg.usuario !== undefined || response.msg.email !== undefined || response.msg.password !== undefined) {
        if (response.msg.usuario !== undefined && response.msg.email !== undefined) {
            estado.innerHTML = response.msg.usuario + " " + response.msg.email + " " + response.msg.password;
        } else if (response.msg.usuario !== undefined) {
            estado.innerHTML = response.msg.usuario;
        } else if (response.msg.email !== undefined) {
            estado.innerHTML = response.msg.email;
        } else if (response.msg.password !== undefined) {
            estado.innerHTML = response.msg.password;
        }
    } else {
        estado.innerHTML = response.msg;
    }
}