
function validateForm() {
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  // Validate email structure
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('Invalid email address');
    return false;
  }

  // Validate password strength
  var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  if (!passwordRegex.test(password)) {
    alert('Password must be at least 8 characters, include one special character, one uppercase character, and one number.');
    return false;
  }

  return true; // Allow the form submission if both email and password are valid
}

