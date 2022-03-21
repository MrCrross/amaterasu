//Предпоказ изображения
function handleFileSelect(evt) {
    const file = evt.target.files; // FileList object
    const div = evt.target.parentNode.parentNode.parentNode.querySelector('#temp-img')// div
    const img = evt.target.parentNode.parentNode.parentNode.querySelector('#img')// IMG
    const span = evt.target.parentNode.querySelector('span')// IMG
    const f = file[0];
    // Only process image files.
    if (!file.length || (!f.type.match('image/jpeg') && !f.type.match('image/png'))) {
        img.src = ''
        img.alt = ''
        img.title = ''
        img.classList.add('hidden')
        div.classList.remove('hidden')
        span.innerHTML='Файла нет'
    } else {
        const reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                img.src = e.target.result
                img.alt = escape(theFile.name)
                img.title = escape(theFile.name)
                span.innerHTML='Файл есть'
                img.classList.remove('hidden')
                div.classList.add('hidden')
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

if (document.querySelector('#createContainer'))
    document.querySelector('#createContainer').addEventListener('change', function (e) {
        if (e.target && e.target.matches('#file')) {
            handleFileSelect(e)
        }
    })
if (document.querySelector('#editContainer'))
    document.querySelector('#editContainer').addEventListener('change', function (e) {
        if (e.target && e.target.matches('#file')) {
            handleFileSelect(e)
        }
    })
