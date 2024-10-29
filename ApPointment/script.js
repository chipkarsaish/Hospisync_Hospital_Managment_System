document.getElementById('appointmentForm').addEventListener('submit', function(event) {
    let isValid = true;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const doctor = document.getElementById('doctor').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    // Basic validation
    if (name === '' || email === '' || phone === '' || doctor === '' || date === '' || time === '') {
        isValid = false;
        alert('All fields are required.');
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        isValid = false;
        alert('Please enter a valid email address.');
    }

    if (!isValid) {
        event.preventDefault();
    }
});

