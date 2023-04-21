const circle = document.getElementById('dark-light-circle');
const root = document.getElementById('root');

//get initial localStorage theme value
const localStorageTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'dark';

//set root theme depend on localStorage theme every time page is reload
root.setAttribute('data-bs-theme', localStorageTheme);

circle.addEventListener('click', function (e) {
    e.preventDefault();

    //get root theme
    const rootTheme = root.getAttribute('data-bs-theme');

    let newTheme = '';

    switch (rootTheme) {
        case 'light':
            newTheme = 'dark';
            break;
        case 'dark':
            newTheme = 'light';
            break;
        default:
            newTheme = 'dark';
    }

    //set new localstorage theme
    localStorage.setItem("theme", newTheme);
    //set new root theme
    root.setAttribute('data-bs-theme', newTheme);
})
