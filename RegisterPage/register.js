document.addEventListener('DOMContentLoaded', () => {
    const roleSelect = document.getElementById('role');
    const nextButton = document.getElementById('nextButton');
    const roleForm = document.getElementById('roleForm');
    const doctorForm = document.getElementById('doctorForm');
    const staffForm = document.getElementById('staffForm');
    const errorMessage = document.getElementById('error-message');

    // Event listener for the "Next" button
    nextButton.addEventListener('click', () => {
        const selectedRole = roleSelect.value;

        if (selectedRole === 'doctor') {
            roleForm.style.display = 'none';
            doctorForm.style.display = 'block';
            staffForm.style.display = 'none';
        } else if (selectedRole === 'staff') {
            roleForm.style.display = 'none';
            staffForm.style.display = 'block';
            doctorForm.style.display = 'none';
        } else {
            errorMessage.textContent = 'Please select a role before proceeding.';
        }
    });

    

    // Form validation for doctor
    function validateDoctorForm() {
        const name = document.getElementById('doctorName').value;
        const email = document.getElementById('doctorEmail').value;
        const dob = document.getElementById('doctorDob').value;
        const specialization = document.getElementById('specialization').value;
        const experience = document.getElementById('experience').value;
        const password = document.getElementById('doctorPsw').value;

        if (!name || !email || !dob || specialization === 'select' || !experience || !password) {
            errorMessage.textContent = 'All fields are required for doctor registration.';
            return false;
        }

        if (!validateDate(dob)) {
            errorMessage.textContent = 'Invalid date format. Please use DD-MM-YYYY.';
            return false;
        }

        if (!validateAge(dob)) {
            errorMessage.textContent = 'You must be at least 25 years old to register.';
            return false;
        }

        if (!validatePassword(password)) {
            errorMessage.textContent = 'Password must contain at least one number, one uppercase, one lowercase letter, and be at least 8 characters long.';
            return false;
        }

        return true;
    }

    // Form validation for staff
    function validateStaffForm() {
        const name = document.getElementById('staffName').value;
        const email = document.getElementById('staffEmail').value;
        const dob = document.getElementById('staffDob').value;
        const department = document.getElementById('department').value;
        const password = document.getElementById('staffPsw').value;

        if (!name || !email || !dob || !department || !password) {
            errorMessage.textContent = 'All fields are required for staff registration.';
            return false;
        }

        if (!validateDate(dob)) {
            errorMessage.textContent = 'Invalid date format. Please use DD-MM-YYYY.';
            return false;
        }

        if (!validateAge(dob)) {
            errorMessage.textContent = 'You must be at least 25 years old to register.';
            return false;
        }

        if (!validatePassword(password)) {
            errorMessage.textContent = 'Password must contain at least one number, one uppercase, one lowercase letter, and be at least 8 characters long.';
            return false;
        }

        return true;
    }

    // Date validation (DD-MM-YYYY)
    function validateDate(date) {
        const datePattern = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
        return datePattern.test(date);
    }

    // Age validation: check if the user is at least 25 years old
    function validateAge(dateOfBirth) {
        const [day, month, year] = dateOfBirth.split('-').map(Number);
        const dob = new Date(year, month - 1, day); // month is 0-indexed

        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDifference = today.getMonth() - dob.getMonth();
        const dayDifference = today.getDate() - dob.getDate();

        // Adjust age if the birthdate hasn't occurred yet this year
        if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
            age--;
        }

        return age >= 25;
    }

    // Password validation: check if it matches criteria
    function validatePassword(password) {
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return passwordPattern.test(password);
    }
});

