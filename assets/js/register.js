$(document).ready(() => {
  
  $("#hideLogin").click(() => {
    $('#loginForm').hide();
    $('#registerForm').show();
  })

  $("#hideRegister").click(() => {
    $('#registerForm').hide();
    $('#loginForm').show();
  })
});