const circle = document.getElementById('dark-light-circle')
const root = document.getElementById('root')

//get initial localStorage theme value
const theme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'dark'

//set theme depend on localStorage every time page is reload
root.setAttribute('data-bs-theme', theme)


circle.addEventListener('click', function (e) {
    e.preventDefault()

    if (root.getAttribute('data-bs-theme') == "light") {
        localStorage.setItem("theme", "dark")
    } else if (root.getAttribute('data-bs-theme') == "dark") {
        localStorage.setItem("theme", "light")
    }
    root.setAttribute('data-bs-theme', localStorage.getItem('theme'))
})
