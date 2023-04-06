(function() {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation') //custom vlaidated
    Array.prototype.slice.call(forms) //prevent summission
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()