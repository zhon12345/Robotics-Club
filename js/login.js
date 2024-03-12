function switchForm() {
    const forms = document.querySelectorAll(".login-form, .signup-form");

    forms.forEach(form => {
        form.classList.toggle("not-active")
    });
}