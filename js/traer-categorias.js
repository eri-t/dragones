document.addEventListener('DOMContentLoaded', function () {
    function traerCategorias() {
        fetch('api/categorias.php')
            .then(response => response.json())
            .then(categorias => {
                const div = document.getElementById('categoria');
                let salida = "";
                for (let i = 0; i < categorias.length; i++) {
                    salida += `
                    <div class="card ml-4 mt-3 dragon" style="width: 18rem;">
                    <div class="card-body">
                        <p class="h5">${categorias[i].nombre}</p>
                        <p class="card-text">${categorias[i].id}</p>
                    </div>
                    </div>`;
                }
                div.innerHTML = salida;
            });
    }

    const elBoton = document.getElementById('btnTraerCategorias');

    elBoton.addEventListener('click', function () {
        traerCategorias();
    });
});