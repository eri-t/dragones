/**
 * Va a contener los nombres y ids de las categorías.
 *
 * @type {array}
 */
let aNombresCategorias = [];

/**
 * Va a contener la imagen a subir.
 *
 * @type {string}
 */
let imagen;

/**
 * Va a contener el texto de la acción del formulario: crear/editar.
 *
 * @type {string}
 */
let textoAccion = 'Agregar';

/**
 * Indica si el form muestra la acción de editar (en lugar de agregar, que se muestra por defecto).
 *
 * @type {boolean}
 */
let modoEdicion = false;

document.addEventListener('DOMContentLoaded', function () {

    const def = traerNombresCategorias();
    def.then(function () {
        listarTodos();
    });

    const mensaje = document.getElementById('mensaje');
    const loader = document.getElementById('loader');

    actualizarAccion();

    // Imagen
    const inputImagen = document.getElementById('poster');
    const respuesta = document.getElementById('preview');

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

    const botonAgregar = document.getElementById('botonAgregar');
    botonAgregar.addEventListener('click', function () {
        if (modoEdicion) {
            textoAccion = 'Agregar';
            actualizarAccion();
            // mostrar sección "Form Dragón"
            $('#collapseForm').collapse('show');

        }
        modoEdicion = false;
        console.log(modoEdicion);
    });

    function guardarDragon(id) {
        const inputNombre = document.getElementById('nombre');
        const inputCategoriaId = document.getElementById('categoria');
        const inputDescripcion = document.getElementById('descripcion');

        const data = {
            id: id,
            nombre: inputNombre.value,
            categorias_id: inputCategoriaId.value,
            descripcion: inputDescripcion.value,
            imagen: imagen,
        };

        let method;
        let path = '../api/dragones.php';

        if (id) {
            method = 'put';
            path += `?id=${id}`;
        } else {
            method = 'post';
        }

        fetch(path, {
                method: method,
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                toggleFormElements(formDragon, false);
                mensaje.classList.add('alert');
                if (responseData.success) {
                    mensaje.classList.add('alert-success');
                    // restablecer la img default:
                    respuesta.src = '../img/default.jpg';
                    loader.innerHTML = '';
                    cleanFormElements(formDragon);

                    // colapsar sección "Form Dragón"
                    $('#collapseForm').collapse('hide');

                    listarTodos();
                } else {
                    mensaje.classList.add('alert-danger');
                }
                mostrarMensaje(responseData);
            });
    }

    const formDragon = document.getElementById('formDragon');

    formDragon.addEventListener('submit', function (ev) {
        ev.preventDefault();
        loader.innerHTML = getLoader();
        toggleFormElements(formDragon, true);
        guardarDragon();
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

/**
 * Edita una fila por su pk.
 *
 * @param {int} id
 */

function editar(id) {
    modoEdicion = true;
    console.log(modoEdicion);
    textoAccion = 'Editar';
    actualizarAccion();

    // mostrar sección "Form Dragón"
    $('#collapseForm').collapse('show');

    fetch(`../api/dragones.php?id=${id}`, {
            method: 'get',
        })
        .then(rta => rta.json())
        .then(dragon => {
            const inputNombre = document.getElementById('nombre');
            const inputCategoriaId = document.getElementById('categoria');
            const inputDescripcion = document.getElementById('descripcion');

            inputNombre.value = dragon.nombre;
            // inputCategoriaId.selected = dragon.categorias_id;
            $('.select2').val(dragon.categorias_id);
            $('.select2').trigger('change');
            inputDescripcion.value = dragon.descripcion;



        });
}

/**
 * Actualiza el texto del submit del form.
 */
function actualizarAccion() {
    const accion = document.getElementById('accion');
    accion.innerHTML = textoAccion;
}

/**
 * Devuelve un objeto desde aNombresCategorias por su pk.
 *
 * @param {int} id
 * @return {object}
 */

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
                listarTodos();
                mensaje.classList.add('alert-success');
            } else {
                mensaje.classList.add('alert-danger');
            }
            mostrarMensaje(response);
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