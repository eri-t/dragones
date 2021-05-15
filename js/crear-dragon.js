document.addEventListener('DOMContentLoaded', function () {
<<<<<<< HEAD
=======
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

>>>>>>> main
    function crearDragon() {
        const inputNombre = document.getElementById('nombre');
        const inputCategoriaId = document.getElementById('categoria');
        const inputDescripcion = document.getElementById('descripcion');
<<<<<<< HEAD
=======

>>>>>>> main
        const data = {
            nombre: inputNombre.value,
            categorias_id: inputCategoriaId.value,
            descripcion: inputDescripcion.value,
<<<<<<< HEAD
        };
=======
            imagen: imagen,
        };

>>>>>>> main
        fetch('../api/dragones.php', {
                method: 'post',
                body: JSON.stringify(data),
            })
            .then(rta => rta.json())
            .then(responseData => {
<<<<<<< HEAD
                console.log("Respuesta del POST dragones.php: ", responseData);
=======
                toggleFormElements(formCrear, false);
                loader.innerHTML = '';
>>>>>>> main
            });
    }

    const formCrear = document.getElementById('formCrear');

    formCrear.addEventListener('submit', function (ev) {
        ev.preventDefault();
<<<<<<< HEAD
        crearDragon();
    });
=======

        // Ponemos el logo de carga
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
>>>>>>> main
});