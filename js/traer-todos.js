document.addEventListener('DOMContentLoaded', function () {
    function traerTodos() {
        fetch('api/dragones.php')
            // Pedimos la respuesta parseada como JSON.
            .then(response => response.json())
            .then(dragones => {
                const div = document.getElementById('respuesta');
                let salida = "";
                for (let i = 0; i < dragones.length; i++) {
                    salida += `<div>
                                <h2>${dragones[i].nombre}</h2>
                                <p>Descripción:</p>
                                <p>${dragones[i].descripcion}</p>
                            </div>`;
                }
                div.innerHTML = salida;
            });
    }

    const elBoton = document.getElementById('btnTraerTodos');

    elBoton.addEventListener('click', function () {
        traerTodos();
    });
});