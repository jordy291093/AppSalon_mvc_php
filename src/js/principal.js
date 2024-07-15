document.addEventListener('DOMContentLoaded', function(){
    password();
  });

  function password() {
    const eye = document.querySelector(".fa-eye");
    eye.addEventListener("click", verPass);
  }
  
  function verPass() {
    const pass = document.getElementById('password');
    const eye = document.querySelector(".fa-eye");
    const eyeslash = document.querySelector(".fa-eye-slash");
  
    if (pass.type === "password") {
      pass.type = "text";
      eye.classList.remove('fa-eye');
      eye.classList.add('fa-eye-slash');
    } else {
      pass.type = "password";
      eyeslash.classList.remove('fa-eye-slash');
      eyeslash.classList.add('fa-eye');
    }
  }