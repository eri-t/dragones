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
    let imgChanged = false; // Flag para cuando se carga una imagen nueva
    const inputImagen = document.getElementById('poster');
    const preview = document.getElementById('preview');

    inputImagen.addEventListener('change', function (ev) {
        // Instanciamos la clase FileReader.
        const reader = new FileReader;

        reader.addEventListener('load', function () {
            imagen = reader.result;

            // Mostramos una previsualización de la imagen a subir.
            preview.src = imagen;

            // Actualizamos el flag:
            imgChanged = true;
        });

        reader.readAsDataURL(this.files[0]);
    });

    const botonAgregar = document.getElementById('botonAgregar');
    botonAgregar.addEventListener('click', function (ev) {

        if (modoEdicion) {
            // evitar que se colapse el form:
            ev.stopPropagation();
            textoAccion = 'Agregar';
            actualizarAccion();
            cleanFormElements(formDragon);
        }
        modoEdicion = false;
    });

    function guardarDragon() {
        const inputId = document.getElementById('pk');
        const inputNombre = document.getElementById('nombre');
        const inputCategoriaId = document.getElementById('categoria');
        const inputDescripcion = document.getElementById('descripcion');

        const id = inputId.value;

        const data = {
            nombre: inputNombre.value,
            categorias_id: inputCategoriaId.value,
            descripcion: inputDescripcion.value,
        };

        // enviar la imagen sólo si se cambió:
        if (imgChanged) {
            data.imagen = imagen;
        }

        let method = '';
        let path = 'api/dragones.php';

        if (id) {
            method = 'put';
            path += `?id=${id}`;
        } else {
            method = 'post';
        }

        console.log(data);

        fetch(path, {
                method: method,
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
                console.log(responseData);
                toggleFormElements(formDragon, false);
                mensaje.classList.add('alert');
                if (responseData.success) {
                    mensaje.classList.add('alert-success');
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
        $('.select2').val('');
        $('.select2').trigger('change');
        // restablecer la img default:
        preview.src = 'img/default.jpg';
    }

});

/**
 * Trae los nombres de las categorías
 * @returns {Promise<void>} 
 */
function traerNombresCategorias() {
    return fetch('api/categorias.php')
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

/**
 * Listamos todos los dragones con sus correspondientes datos, traídos de la base de datos.
 */
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
                        <td> ${getCategory(dragones[i].categorias_id).nombre} </td> 
                        <td> ${dragones[i].descripcion} </td> 
                        <td> <img src="img/${dragones[i].imagen}" alt="${dragones[i].nombre}" class="img-fluid"> </td> 
                        <td>
                            
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
    textoAccion = 'Editar';
    actualizarAccion();
    window.scrollTo(0, 0);

    // mostrar sección "Form Dragón"
    $('#collapseForm').collapse('show');

    fetch(`api/dragones.php?id=${id}`, {
            method: 'get',
        })
        .then(rta => rta.json())

        .then(response => {

            if (response.result.success == true) {
                const dragon = response.data;

                const inputId = document.getElementById('pk');
                const inputNombre = document.getElementById('nombre');
                const inputDescripcion = document.getElementById('descripcion');
                const inputImagen = document.getElementById('poster');
                const inputCategoriaId = document.getElementById('categoria');

                inputId.value = id;
                inputNombre.value = dragon.nombre;
                inputDescripcion.value = dragon.descripcion;

                // Recuperar imagen:

                // https://stackoverflow.com/questions/47119426/how-to-set-file-objects-and-length-property-at-filelist-object-where-the-files-a/47172409#47172409
                const dT = new ClipboardEvent('').clipboardData || // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                    new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
                dT.items.add(new File(['file'], '../img/' + dragon.imagen));
                inputImagen.files = dT.files;

                preview.src = 'img/' + dragon.imagen;

                // categoría:
                $('.select2').val(dragon.categorias_id);
                $('.select2').trigger('change');

            } else {
                // mostrar mensaje de error
                mensaje.classList.add('alert', 'alert-danger');
                mostrarMensaje(response.result);
            }


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
    fetch(`api/dragones.php?id=${id}`, {
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
 * @param response
 */

function mostrarMensaje(response) {
    if (response.msg.nombre !== undefined || response.msg.categorias_id !== undefined) {
        if (response.msg.nombre !== undefined && response.msg.categorias_id !== undefined) {
            mensaje.innerHTML = response.msg.nombre + " /" + response.msg.categorias_id;
        } else if (response.msg.nombre !== undefined) {
            mensaje.innerHTML = response.msg.nombre;
        } else if (response.msg.categorias_id !== undefined) {
            mensaje.innerHTML = response.msg.categorias_id;
        }
    } else {
        mensaje.innerHTML = response.msg;
    }
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