function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    const pattern = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/;
    return pattern.test(password);
}

function validatePhone(phone) {
    const pattern = /^[0-9]{10}$/;  
    return pattern.test(phone);
}

function checkEmptyFields(form) {
    const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    for (let input of inputs) {
        if (input.value.trim() === '') {
            alert("Please fill out all fields.");
            return false;
        }
    }
    return true;
}

function validateForm(event) {
    const form = event.target;
    const email = form.querySelector('input[type="email"]').value;
    const password = form.querySelector('input[type="password"]').value;
    const phone = form.querySelector('input[type="text"][placeholder="Phone"]').value;

    // Check for empty fields
    if (!checkEmptyFields(form)) {
        event.preventDefault();
        return false;
    }

    // Check email
    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
    }

    // Check password
    if (!validatePassword(password)) {
        alert("Password must be at least 8 characters long, include a capital letter, a number, and a special character.");
        event.preventDefault();
        return false;
    }

    // Check phone number
    if (!validatePhone(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        event.preventDefault();
        return false;
    }

    // If all validations pass
    return true;
}

// Attach validation to forms
userRegisterForm.addEventListener('submit', validateForm);