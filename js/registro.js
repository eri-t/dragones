document.addEventListener('DOMContentLoaded', function (){
    const formRegistro = document.getElementById('formRegistro');

    function crearUsuario() {
        const inputUsuario = document.getElementById('usuario');
        const inputEmail = document.getElementById('email');
        const inputPassword = document.getElementById('password');

        const data = {
            usuario: inputUsuario.value,
            email: inputEmail.value,
            password: inputPassword.value,
        };
        console.log('respuesta del json', data);

        fetch('api/registro.php', {
            method: 'post',
            body: JSON.stringify(data),
        })

            .then(rta => rta.json())
            .then(responseData => {
               console.log('respuesta del Post', responseData);
            });
    }

    formRegistro.addEventListener('submit', function (ev){
        ev.preventDefault();

        crearUsuario();
    });
});

