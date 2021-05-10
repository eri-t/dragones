document.addEventListener('DOMContentLoaded', function () {
    function crearDragon() {
        // Armamos los datos a enviar como un objeto de JS para poder serializarlo a JSON para su
        // envio al endpoint REST.
        const inputNombre = document.getElementById('nombre');
        const inputPrecio = document.getElementById('precio');
        const inputIdCategoria = document.getElementById('id_categoria');
        const inputIdMarca = document.getElementById('id_marca');
        const inputDescripcion = document.getElementById('descripcion');
        const data = {
            nombre: inputNombre.value,
            precio: inputPrecio.value,
            id_categoria: inputIdCategoria.value,
            id_marca: inputIdMarca.value,
            descripcion: inputDescripcion.value,
        };

        // Hacemos la llamada de Ajax.
        // Va a ser el mismo endpoint que usamos para traer los datos.
        // La diferencia, es que va a ser por POST.
        fetch('api/productos.php', {
                method: 'post',
                // Stringificamos la data a JSON para su envío.
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                console.log("Respuesta del POST productos.php: ", responseData);
            });
    }

    const formAlta = document.getElementById('form-alta');

    formAlta.addEventListener('submit', function (ev) {
        ev.preventDefault();

        crearDragon();
    });
});