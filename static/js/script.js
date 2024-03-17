// Function to generate a strong password
function generatePassword() {
    const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
    let password = "";
    for (let i = 0; i < 8; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById("password").value = password;
}

// Event listener for checkbox
document.getElementById("generate_password").addEventListener("change", function() {
    if (this.checked) {
        generatePassword();
    } else {
        document.getElementById("password").value = "";
    }
});


function hideMessage() {
    var msgDiv = document.getElementById('msgDiv');
    if (msgDiv) {
        msgDiv.style.display = 'none';
    }
}
// Hide message after 5 seconds
setTimeout(hideMessage, 2000);