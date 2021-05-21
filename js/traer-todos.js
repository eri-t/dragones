document.addEventListener('DOMContentLoaded', function () {
    function traerTodos() {
        fetch('api/dragones.php')
            .then(response => response.json())
            .then(dragones => {
                const div = document.getElementById('respuesta');
                let salida = "";
                for (let i = 0; i < dragones.length; i++) {
                    salida += `
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                    <div class="card dragon">
                        <img class="card-img-top" src="img/${dragones[i].imagen}" alt="${dragones[i].nombre}">
                        <div>
                            <a class="text-white btn btn-block mb-0 py-3" data-toggle="collapse" href="#collapse${dragones[i].id}" role="button" aria-expanded="false" aria-controls="collapse${dragones[i].id}">
                                ${dragones[i].nombre}
                            </a>
                        </div>
                    </div>

                    <div class="collapse mt-2" id="collapse${dragones[i].id}">
                        <div class="card card-body">
                            <p>${dragones[i].descripcion}</p>
                        </div>
                    </div>
                    </div>
                    `;
                }
                div.innerHTML = salida;
            });
    }

    const elBoton = document.getElementById('btnTraerTodos');

    elBoton.addEventListener('click', function () {
        traerTodos();
    });
});