import './bootstrap'
import "../sass/app.scss"
import * as bootstrap from 'bootstrap'

window.openModal = () => {
    const myModal = new bootstrap.Modal('#postCreateModal', {
        keyboard: false
    })
    myModal.show()
}

window.viewComments = (id) => {
    document.getElementById("hideComments" + id).classList.remove('d-none');
    document.getElementById('VMC' + id).classList.add('d-none');
    document.getElementById('HC' + id).classList.remove('d-none');
}

window.hideComments = (id) => {
    document.getElementById("hideComments" + id).classList.add('d-none');
    document.getElementById('VMC' + id).classList.remove('d-none');
    document.getElementById('HC' + id).classList.add('d-none');
}
