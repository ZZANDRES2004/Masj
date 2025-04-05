document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('Contrasena');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordStrengthDiv = document.getElementById('passwordStrength');
    const passwordMatchDiv = document.getElementById('passwordMatch');
    const lengthRequirement = document.getElementById('length');
    const uppercaseRequirement = document.getElementById('uppercase');
    const lowercaseRequirement = document.getElementById('lowercase');
    const numberRequirement = document.getElementById('number');
    const specialRequirement = document.getElementById('special');
    const registroForm = document.getElementById('registroForm');

    passwordInput.addEventListener("input", () => {
        const value = passwordInput.value;
        let strength = "Débil";

        // Verificar requisitos de la contraseña
        const lengthValid = value.length >= 8;
        const uppercaseValid = /[A-Z]/.test(value);
        const lowercaseValid = /[a-z]/.test(value);
        const numberValid = /[0-9]/.test(value);
        const specialValid = /[^A-Za-z0-9]/.test(value);

        // Actualizar clases de los requisitos
        lengthRequirement.className = lengthValid ? "valid" : "invalid";
        uppercaseRequirement.className = uppercaseValid ? "valid" : "invalid";
        lowercaseRequirement.className = lowercaseValid ? "valid" : "invalid";
        numberRequirement.className = numberValid ? "valid" : "invalid";
        specialRequirement.className = specialValid ? "valid" : "invalid";

        const validRequirements = [lengthValid, uppercaseValid, lowercaseValid, numberValid, specialValid].filter(Boolean).length;

        let strengthText = '';
        let strengthClass = '';

        passwordStrengthDiv.textContent = strengthText;
        passwordStrengthDiv.className = `password-strength ${strengthClass}`;
    });

    confirmPasswordInput.addEventListener("input", () => {
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirmPasswordInput.value;

        if (passwordValue === confirmPasswordValue) {
            passwordMatchDiv.innerHTML = `<span class="Coinciden">Las contraseñas Coinciden</span>`;
            passwordMatchDiv.className = "password-match valid";
        } else {
            passwordMatchDiv.innerHTML = `<span class="NoCoinciden">Las contraseñas No coinciden</span>`;
            passwordMatchDiv.className = "password-match invalid";
        }
    });

    registroForm.addEventListener('submit', function(event) {
        const lengthValid = passwordInput.value.length >= 8;
        const uppercaseValid = /[A-Z]/.test(passwordInput.value);
        const lowercaseValid = /[a-z]/.test(passwordInput.value);
        const numberValid = /[0-9]/.test(passwordInput.value);
        const specialValid = /[^A-Za-z0-9]/.test(passwordInput.value);
        const passwordsMatch = confirmPasswordInput.value === passwordInput.value;

        if (!lengthValid || !uppercaseValid || !lowercaseValid || !numberValid || !specialValid || !passwordsMatch) {
            event.preventDefault(); // Evita que el formulario se envíe si la contraseña no es válida
            // No mostramos un alert, los indicadores visuales son suficientes
        }
    });

    // Inicialmente, marcamos todos los requisitos como inválidos (opcional, ya que la clase 'invalid' está en el HTML)
    const requirements = document.querySelectorAll('.password-requirements li');
    requirements.forEach(li => li.classList.add('invalid'));
});