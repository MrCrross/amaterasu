if(localStorage.theme == 'dark') {
    document.querySelector('html').classList.add('dark');
    document.getElementById('moon').classList.toggle('hidden')
    document.getElementById('sun').classList.toggle('hidden')
    const avatar = document.getElementById('user-avatar')
    if (avatar) avatar.setAttribute('fill','#ffffff')
}
document.getElementById('switchTheme').addEventListener('click', function() {
    let htmlClasses = document.querySelector('html').classList;
    const moon = document.getElementById('moon').classList
    const sun = document.getElementById('sun').classList
    const avatar = document.getElementById('user-avatar')
    if(localStorage.theme=="dark") {
        if (avatar) avatar.setAttribute('fill','#000000')
        htmlClasses.remove('dark')
        localStorage.removeItem('theme')
        moon.toggle('hidden')
        sun.toggle('hidden')
    } else {
        if (avatar) avatar.setAttribute('fill','#ffffff')
        htmlClasses.add('dark')
        localStorage.theme='dark'
        moon.toggle('hidden')
        sun.toggle('hidden')
    }
});
