document.addEventListener('DOMContentLoaded', function () {
    function traerTodos() {
        fetch('api/dragones.php')
            // Pedimos la respuesta parseada como JSON.
            .then(response => response.json())
            .then(dragones => {
                const div = document.getElementById('respuesta');
                let salida = "";
                for (let i = 0; i < dragones.length; i++) {
                    salida += `
                    <div class="card ml-4 mt-3 dragon" style="width: 18rem;">
                    <img class="card-img-top" src="${dragones[i].imagen}" alt="${dragones[i].nombre}">
                    <div class="card-body">
                        <details>
                            <summary class="h5">${dragones[i].nombre}</summary>
                            <p class="card-text">${dragones[i].descripcion}</p>
                        </details>
                    </div>
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