function eliminar(id) {

    fetch(`api/dragones.php?id=${id}`, {
        method: 'delete',
    })

}