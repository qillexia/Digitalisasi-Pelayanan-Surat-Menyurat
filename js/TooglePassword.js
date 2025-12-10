const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#InputPassword");
const icon = togglePassword.querySelector("span");

togglePassword.addEventListener("click", function () {
  // 1. Ubah tipe input dari password ke text (atau sebaliknya)
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  // 2. Ubah ikon mata (garis miring atau terbuka)
  if (type === "password") {
    icon.innerText = "visibility_off"; // Mata tertutup
  } else {
    icon.innerText = "visibility"; // Mata terbuka
  }
});
