document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("input[name='password']");
  
    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.classList.toggle("bx-show");
      this.classList.toggle("bx-hide");
    });
  });
  