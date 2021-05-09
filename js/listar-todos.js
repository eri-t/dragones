document.addEventListener('DOMContentLoaded', function () {
    function listarTodos() {
        fetch('api/dragones.php')
            .then(response => response.json())
            .then(dragones => {
                const div = document.getElementById('respuesta');
                let salida = "";
                for (let i = 0; i < dragones.length; i++) {
                    salida += `
                    <tr>
                        <th scope="row"> ${dragones[i].id} </th>
                        <td> ${dragones[i].nombre} </td>
                        <td> ${dragones[i].categorias_id} </td> 
                        <td> ${dragones[i].descripcion} </td> 
                        <td> <img src="${dragones[i].imagen}" alt="${dragones[i].nombre}" class="img-fluid"> </td> 
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-light">Acciones</button>
                                <button type="button" class="btn btn-outline-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Botón desplegable</span>
                                </button>
                                <div class="dropdown-menu" id="${dragones[i].id}">
                                    <a
                                        class="dropdown-item"
                                        href="#" class="botonEditar"
                                        >
                                        Editar...
                                    </a>
                                    <div class="dropdown-divider"></div>

                                    <button
                                        type="button"
                                        class="dropdown-item text-center"
                                        onclick = "eliminar(${dragones[i].id})"
                                        >
                                        Borrar
                                    </button>

                                </div>
                            </div>
                        </td>
                    </tr>`;
                }
                div.innerHTML = salida;
            });
    }

    listarTodos();

});