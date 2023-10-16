// Reference elements
const overlay = document.getElementById("form");
const signInMainLink = document.getElementById("signin-main-btn");
const signInLink = document.getElementById("signin-btn");
const signUpLink = document.getElementById("signup-btn");
const signInForm = document.getElementById("signin");
const signUpForm = document.getElementById("signup");

// Function to toggle forms
function toggleForms(formToShow, formToHide) {
  formToShow.style.display = "block";
  formToHide.style.display = "none";
}

// Function to set link colors
function setLinkColor(activeLink, inactiveLink) {
  activeLink.style.color = "orange";
  inactiveLink.style.color = "#c0c0c0";
}

// Function to close the popup
function closePopup(event) {
  if (event.target === overlay) {
    overlay.style.display = "none";
  }
}

// Event listeners
overlay.addEventListener("click", closePopup);

signInLink.addEventListener("click", function (event) {
  toggleForms(signInForm, signUpForm);
  setLinkColor(signInLink, signUpLink);
});

signInMainLink.addEventListener("click", function (event) {
  overlay.style.display = "block";
  toggleForms(signInForm, signUpForm);
  setLinkColor(signInLink, signUpLink);
});

signUpLink.addEventListener("click", function (event) {
  toggleForms(signUpForm, signInForm);
  setLinkColor(signUpLink, signInLink);
});
