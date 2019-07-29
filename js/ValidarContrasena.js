
var password, password2;

password = document.getElementById('Password1');
password2 = document.getElementById('Password2');

password.onchange = password2.onkeyup = passwordMatch;

function passwordMatch() {
  if(password.value !== password2.value)
      password2.setCustomValidity('Las contraseñas no coinciden.');
  else
      password2.setCustomValidity('');
}
