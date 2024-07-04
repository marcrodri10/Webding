const scrollAnchors = document.querySelectorAll('.scroll-anchor')

scrollAnchors.forEach((anchor) => {
    $(document).ready(function () {
        $(anchor).click(function () {
            $('html, body').animate({
                scrollTop: $(anchor.getAttribute('data-to')).offset().top
            }, 1000); // Duración de la animación en milisegundos
        });
    });
})

/* const closeToastButton = document.querySelectorAll('.close-toast');

closeToastButton.forEach((closeToast) =>  {
    $(closeToast).click(() => {
        $(closeToast.closest('#toast-success')).remove();
    })
});
 */
document.addEventListener('DOMContentLoaded', function () {
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach((toast) => {
        if (toast) {
            if (toast.id === 'toast-danger') {
                $(document).ready(function () {
                    $('html, body').animate({
                        scrollTop: $('#confirm').offset().top
                    }, 1000); // Duración de la animación en milisegundos
                });
            }
            toast.style.display = 'flex';
            toast.classList.add('slide-in');

            setTimeout(() => {
                toast.classList.remove('slide-in');
                toast.classList.add('slide-out');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 500);
            }, 3000);
        }
    })
})
