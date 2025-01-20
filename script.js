// script.js

// This function is called when registration is successful
function showSuccessMessage() {
    document.getElementById('success-message').style.display = 'block';
    setTimeout(function() {
        location.reload(); // Reload the page after 3 seconds
    }, 3000); // Wait 3 seconds before reloading
}
