document.addEventListener('DOMContentLoaded', function () {
    function traerTodos() {
        fetch('api/dragones.php')
            .then(response => response.json())
            .then(dragones => {
                const div = document.getElementById('respuesta');
                let salida = "";
                for (let i = 0; i < dragones.length; i++) {
                    salida += `
                    <div class="card ml-4 mt-3 dragon" style="width: 18rem;">
                        <img class="card-img-top" src="${dragones[i].imagen}" alt="${dragones[i].nombre}">
                        <div class="card-body">
                            <h5 class="card-title">${dragones[i].nombre}</h5>
                            <p class="card-text">${dragones[i].descripcion}</p>
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