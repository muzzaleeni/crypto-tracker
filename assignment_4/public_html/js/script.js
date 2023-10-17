// Reference elements
const overlay = document.getElementById("form");
const signInMainLink = document.getElementById("signin-main-btn");
const signInLink = document.getElementById("signin-btn");
const signUpLink = document.getElementById("signup-btn");
const signInForm = document.getElementById("signin");
const signUpForm = document.getElementById("signup");

// Define the interval for automatic sliding
const interval = 3000; // 5000 milliseconds (5 seconds)

// Function to toggle forms
function toggleForms(formToShow, formToHide) {
  formToShow.style.display = "block";
  formToHide.style.display = "none";
}

// Function to set link colors
function setLinkColor(activeLink, inactiveLink) {
  activeLink.style.color = "#00ccff";
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

signInLink.addEventListener("click", () => {
  toggleForms(signInForm, signUpForm);
  setLinkColor(signInLink, signUpLink);
});

signInMainLink.addEventListener("click", () => {
  overlay.style.display = "block";
  toggleForms(signInForm, signUpForm);
  setLinkColor(signInLink, signUpLink);
});

signUpLink.addEventListener("click", () => {
  toggleForms(signUpForm, signInForm);
  setLinkColor(signUpLink, signInLink);
});

// Carousel to show 8 cryptocurrencies
const slider = document.querySelector(".items");
const slides = document.querySelectorAll(".item");

let current = 0;

updateSlideClasses(); 

// Function to go to the next slide
function gotoNext() {
  current = (current + 1) % slides.length;
  updateSlideClasses();
}

// Function to update slide classes
function updateSlideClasses() {
  for (let i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active", "prev", "next");
  }
  const prev = (current - 1 + slides.length) % slides.length;
  const next = (current + 1) % slides.length;
  slides[current].classList.add("active");
  slides[prev].classList.add("prev");
  slides[next].classList.add("next");
  slides[current].addEventListener("click", () => {
    // Replace "desired-page.html" with the desired URL
    window.location.href = "table.html";
  });
}

// Start the automatic sliding
const autoSlideInterval = setInterval(gotoNext, interval);

// Function for search bar
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");

  // Check if elements exist
  if (table && table.getElementsByTagName("tr")) {
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];

      // Check if td exists
      if (td) {
        txtValue = td.textContent || td.innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}
