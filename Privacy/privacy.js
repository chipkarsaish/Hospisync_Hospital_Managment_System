document.getElementById('accept-btn').addEventListener('click', function() {
    alert('Thank you for accepting the privacy policy!');
    window.location.href='appointment.html'
});

document.getElementById('decline-btn').addEventListener('click', function() {
    alert('You declined the privacy policy. Returning to home page.');
    window.location.href = 'home.html';  
});
