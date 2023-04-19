import './bootstrap'
import "../sass/app.scss"
import "venobox/dist/venobox.css";
import VenoBox from "venobox"
import * as bootstrap from 'bootstrap'

import Swal from 'sweetalert2'



// show/hide comments functions
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

//venobox
new VenoBox({
    selector: '.venobox'
})

//sweet alert
window.showToast = (msg, icon = 'success') => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon,
        title: msg
    })

}

//charts js admin dashboard
import "./admin/charts";

//invoke post-like handler function
import "./likePost";

//handle dark light mode
import "./handleDarkLightMode"
