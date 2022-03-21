function toastMessage(status, message) {
    let id =''
    switch (status) {
        case 'success':
            id = 'toast-success';
            break;
        case 'danger':
            id = 'toast-danger';
            break;
    }
    const toast = document.getElementById(id)
    const m = toast.querySelector('#message')
    m.innerHTML = message
    toggleCollapse(id)

}
