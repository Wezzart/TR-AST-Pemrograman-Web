const intro = document.getElementById("intro");
const loginBtn = document.getElementById("loginBtn");
const loginPage = document.getElementById("loginPage")

loginBtn.addEventListener("click", () => {
    intro.style.display = "none";
    loginPage.style.display = "flex";
})