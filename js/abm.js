var aNombresCategorias = [];

document.addEventListener('DOMContentLoaded', function () {

    const def = traerNombresCategorias();
    def.then(function () {
        listarTodos();
    });

    const mensaje = document.getElementById('mensaje');
    const loader = document.getElementById('loader');

    // Imagen
    const inputImagen = document.getElementById('poster');
    const respuesta = document.getElementById('preview');

    /**
     * Va a contener la imagen a subir.
     *
     * @type {string}
     */
    let imagen;

    inputImagen.addEventListener('change', function (ev) {
        // Instanciamos la clase FileReader.
        const reader = new FileReader;

        reader.addEventListener('load', function () {
            imagen = reader.result;

            // Mostramos una previsualización de la imagen a subir.
            respuesta.src = imagen;
            respuesta.alt = "Dragón seleccionado para subir";
        });

        reader.readAsDataURL(this.files[0]);
    });

    function crearDragon() {
        const inputNombre = document.getElementById('nombre');
        const inputCategoriaId = document.getElementById('categoria');
        const inputDescripcion = document.getElementById('descripcion');

        const data = {
            nombre: inputNombre.value,
            categorias_id: inputCategoriaId.value,
            descripcion: inputDescripcion.value,
            imagen: imagen,
        };

        fetch('../api/dragones.php', {
                method: 'post',
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                toggleFormElements(formCrear, false);
                mensaje.classList.add('alert');
                if (responseData.success) {
                    mensaje.classList.add('alert-success');
                    // restablecer la img default:
                    respuesta.src = '../img/default.jpg';
                    loader.innerHTML = '';
                    cleanFormElements(formCrear);

                    // colapsar sección "Crear Dragón"
                    $('#collapseCrear').collapse('hide');

                    listarTodos();
                } else {
                    mensaje.classList.add('alert-danger');
                }
                mostrarMensaje(responseData);
            });
    }

    const formCrear = document.getElementById('formCrear');

    formCrear.addEventListener('submit', function (ev) {
        ev.preventDefault();

        loader.innerHTML = getLoader();
        toggleFormElements(formCrear, true);

        crearDragon();
    });

    /**
     * Retorna el HTML del loader para Ajax.
     *
     * @returns {string}
     */
    function getLoader() {
        return `<div class="lds-ring"><div></div><div></div><div></div><div></div></div>`;
    }

    /**
     * Deshabilita todos los campos y botones del form.
     *
     * @param {HTMLFormElement} form
     * @param {boolean} disabled
     */
    function toggleFormElements(form, disabled = true) {
        const elems = form.querySelectorAll('input, select, textarea, button');
        elems.forEach(item => item.disabled = disabled);
    }

    /**
     * Limpia todos los campos del form.
     *
     * @param {HTMLFormElement} form
     */
    function cleanFormElements(form) {
        const elems = form.querySelectorAll('input, select, textarea');
        elems.forEach(item => item.value = '');
    }
});

function traerNombresCategorias() {
    return fetch('../api/categorias.php')
        .then(response => response.json())
        .then(categorias => {
            for (let i = 0; i < categorias.length; i++) {
                let fila = {
                    id: categorias[i].id,
                    nombre: categorias[i].nombre
                };
                aNombresCategorias.push(fila);
            }
        });
}

function listarTodos() {
    fetch('../api/dragones.php')
        .then(response => response.json())
        .then(dragones => {
            const div = document.getElementById('respuesta');
            let salida = "";

            for (let i = 0; i < dragones.length; i++) {
                salida += `
                    <tr>
                        <th scope="row"> ${dragones[i].id} </th>
                        <td> ${dragones[i].nombre} </td>
                        <td> ${getCategory(dragones[i].categorias_id).nombre} </td> 
                        <td> ${dragones[i].descripcion} </td> 
                        <td> <img src="../img/${dragones[i].imagen}" alt="${dragones[i].nombre}" class="img-fluid"> </td> 
                        <td>
                            <div class="btn-group">
                                <button
                                    type="button"
                                    class="btn btn-outline-light dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                        >
                                        Acciones
                                    </button>

                                <div class="dropdown-menu">
                                    <button
                                        type="button"
                                        class="dropdown-item text-center"
                                        onclick = "editar(${dragones[i].id})"
                                            >
                                            Editar...
                                    </button>

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

function getCategory(pk) {
    return aNombresCategorias.find(obj => {
        return obj.id == pk;
    });
}

/**
 * Elimina una fila por su pk.
 *
 * @param {int} id
 */

function eliminar(id) {
    fetch(`../api/dragones.php?id=${id}`, {
            method: 'delete',
        })
        .then(rta => rta.json())
        .then(response => {
            mensaje.classList.add('alert');
            if (response.success) {
                mensaje.classList.add('alert-success');
            } else {
                mensaje.classList.add('alert-danger');
            }
            mostrarMensaje(response);
            listarTodos();
        });
}

/**
 * Muestra el mensaje en la vista
 */

function mostrarMensaje(response) {
    mensaje.innerHTML = response.msg;
    setTimeout(
        function () {
            quitarMensaje();
        }, 3000
    );
}

/**
 * Quita el mensaje de la vista
 */

function quitarMensaje() {
    mensaje.classList.remove('alert', 'alert-danger', 'alert-success');
    mensaje.innerHTML = '';
}