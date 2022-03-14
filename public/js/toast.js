function toastMessage(id, message) {
    const toast = document.getElementById(id)
    const m = toast.querySelector('#message')
    m.innerHTML = message
    toggleCollapse(id)
}
