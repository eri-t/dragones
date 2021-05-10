document.addEventListener('DOMContentLoaded', function () {
    function crearFormDragon() {
        let contenedor = document.getElementById('contenedorAgregar');

        let row = document.createElement('div');
        row.className = 'row';
        contenedor.appendChild(row);

        let col = document.createElement('div');
        col.className = 'col-4';
        row.appendChild(col);

        let card = document.createElement('div');
        card.className = 'card card-agregar text-left';
        contenedor.appendChild(card);

        let h2 = document.createElement('h2');
        h2.className = 'card-header';
        h2.innerHTML('Agregar Dragón');
        card.appendChild(h2);

        let body = document.createElement('div');
        body.className = 'card-body';
        card.appendChild(body);

        let h3 = document.createElement('h3');
        h3.className = 'h6 pb-1 border-bottom mb-3 col-12';
        h3.innerHTML('Datos del Dragón');
        body.appendChild(h3);

        let form = document.createElement('form');
        body.appendChild(form);

        row = document.createElement('div');
        row.className = 'row';
        form.appendChild(row);

        col = document.createElement('div');
        col.className = 'col-4';
        row.appendChild(col);

        let figure = document.createElement('figure');
        figure.className = 'figure';
        col1.appendChild(figure);

        let img = document.createElement('img');
        img.className = 'img-fluid rounded';
        img.src = "../img/chinese-dragons.jpg";
        img.alt = 'Dragón';
        figure.appendChild(img);

    }

    const botonAgregar = document.getElementById('agregarDragon');

    botonAgregar.addEventListener('click', function () {
        crearFormDragon();
    });
});