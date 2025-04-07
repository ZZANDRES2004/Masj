document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("Contraseña");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordStrengthDiv = document.getElementById("passwordStrength");
    const passwordMatchDiv = document.getElementById("passwordMatch");
    const lengthRequirement = document.getElementById("length");
    const uppercaseRequirement = document.getElementById("uppercase");
    const lowercaseRequirement = document.getElementById("lowercase");
    const numberRequirement = document.getElementById("number");
    const specialRequirement = document.getElementById("special");
    const registroForm = document.getElementById("registroForm");

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

        const validRequirements = [
            lengthValid,
            uppercaseValid,
            lowercaseValid,
            numberValid,
            specialValid,
        ].filter(Boolean).length;

        let strengthText = "";
        let strengthClass = "";

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

    registroForm.addEventListener("submit", function (event) {
        const lengthValid = passwordInput.value.length >= 8;
        const uppercaseValid = /[A-Z]/.test(passwordInput.value);
        const lowercaseValid = /[a-z]/.test(passwordInput.value);
        const numberValid = /[0-9]/.test(passwordInput.value);
        const specialValid = /[^A-Za-z0-9]/.test(passwordInput.value);
        const passwordsMatch =
            confirmPasswordInput.value === passwordInput.value;

        if (
            !lengthValid ||
            !uppercaseValid ||
            !lowercaseValid ||
            !numberValid ||
            !specialValid ||
            !passwordsMatch
        ) {
            event.preventDefault(); // Evita que el formulario se envíe si la contraseña no es válida
            // No mostramos un alert, los indicadores visuales son suficientes
        }
    });

    // Inicialmente, marcamos todos los requisitos como inválidos (opcional, ya que la clase 'invalid' está en el HTML)
    const requirements = document.querySelectorAll(".password-requirements li");
    requirements.forEach((li) => li.classList.add("invalid"));
});

document.addEventListener("DOMContentLoaded", function () {
    // Inputs que deben aceptar solo letras
    const soloTextoInputs = [
        "PrimerNombre",
        "SegundoNombre",
        "PrimerApellido",
        "SegundoApellido",
    ];

    soloTextoInputs.forEach(function (campo) {
        const input = document.querySelector(`input[name="${campo}"]`);
        if (input) {
            input.addEventListener("input", function () {
                this.value = this.value.replace(/[0-9]/g, ""); // Elimina números
            });
        }
    });

    // Inputs que deben aceptar solo números
    const soloNumerosInputs = ["NumDocumento", "NumeroCelular"];

    soloNumerosInputs.forEach(function (campo) {
        const input = document.querySelector(`input[name="${campo}"]`);
        if (input) {
            input.addEventListener("input", function () {
                this.value = this.value.replace(/[^0-9]/g, ""); // Elimina todo excepto números
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const fechaNacimientoInput = document.querySelector(
        'input[name="FechaNacimiento"]'
    );
    const registroForm = document.getElementById("registroForm");

    // Set the maximum date (today - 18 years)
    function updateMaxDate() {
        const today = new Date();
        const maxDate = new Date(
            today.getFullYear() - 18,
            today.getMonth(),
            today.getDate()
        );

        // Format the date as YYYY-MM-DD for the input max attribute
        const maxDateFormatted = maxDate.toISOString().split("T")[0];
        fechaNacimientoInput.setAttribute("max", maxDateFormatted);

        return maxDate;
    }

    // Initial setup
    const maxDate = updateMaxDate();

    // Add validation on input change
    fechaNacimientoInput.addEventListener("change", function () {
        const selectedDate = new Date(this.value);
        const errorContainer = this.parentNode.nextElementSibling;

        // Remove any existing custom error messages
        const existingCustomError = document.getElementById("edad-error");
        if (existingCustomError) {
            existingCustomError.remove();
        }

        // Check if date is valid and user is at least 18
        if (this.value && selectedDate > maxDate) {
            // Create custom error message
            const errorMsg = document.createElement("p");
            errorMsg.id = "edad-error";
            errorMsg.className = "error";
            errorMsg.textContent =
                "Debes ser mayor de 18 años para registrarte.";

            // Insert after the existing error container
            errorContainer.after(errorMsg);

            // Set custom validity for the form validation API
            this.setCustomValidity(
                "Debes ser mayor de 18 años para registrarte."
            );
        } else {
            // Clear custom validity if date is valid
            this.setCustomValidity("");
        }
    });

    // Add form submission validation
    registroForm.addEventListener("submit", function (event) {
        const selectedDate = new Date(fechaNacimientoInput.value);

        // Check if date is valid and user is at least 18
        if (fechaNacimientoInput.value && selectedDate > maxDate) {
            event.preventDefault(); // Prevent form submission

            // Ensure error message is shown and scroll to it
            if (!document.getElementById("edad-error")) {
                const errorMsg = document.createElement("p");
                errorMsg.id = "edad-error";
                errorMsg.className = "error";
                errorMsg.textContent =
                    "Debes ser mayor de 18 años para registrarte.";

                const errorContainer =
                    fechaNacimientoInput.parentNode.nextElementSibling;
                errorContainer.after(errorMsg);
            }

            // Scroll to the date input
            fechaNacimientoInput.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
        }
    });
});
