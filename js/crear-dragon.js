document.addEventListener('DOMContentLoaded', function () {
    function crearDragon() {
        const inputNombre = document.getElementById('nombre');
        const inputCategoriaId = document.getElementById('categoria');
        const inputDescripcion = document.getElementById('descripcion');
        const data = {
            nombre: inputNombre.value,
            categorias_id: inputCategoriaId.value,
            descripcion: inputDescripcion.value,
        };
        fetch('../api/dragones.php', {
                method: 'post',
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                console.log("Respuesta del POST dragones.php: ", responseData);
            });
    }

    const formCrear = document.getElementById('formCrear');

    formCrear.addEventListener('submit', function (ev) {
        ev.preventDefault();
        crearDragon();
    });
});