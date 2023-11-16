/* --- Pop-up Form Code for Signin in maintenance--- */

if (window.location.pathname.endsWith("maintenance.php")) {
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

  const maintenance = document.querySelector(".maintenance");
  const message = document.querySelector(".message");

  if (maintenance.classList.contains("notauthenticated")) {
    overlay.style.display = "block";
    toggleForms(signInForm, signUpForm);
    setLinkColor(signInLink, signUpLink);
    maintenance.style.display = "none";
  }
}

/* --- Code for the Carousel --- */

if (window.location.pathname.endsWith("index.html")) {
  console.log("Script is running.");
  const slider = document.querySelector(".items");
  const slides = slider.querySelectorAll(".item");

  let current = 0;

  // Define the interval for automatic sliding
  const interval = 3000; // 5000 milliseconds (5 seconds)

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
      window.location.href = "pages/table.html";
    });
  }

  // Start the automatic sliding
  const autoSlideInterval = setInterval(gotoNext, interval);
}

if (window.location.pathname.endsWith("table.html")) {
  /* --- Search Bar Code --- */

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

  /* --- Making table rows clickable --- */

  // Get all elements with the class "not-header"
  const rows = document.querySelectorAll(".not-header");

  // Add a click event listener to each row
  rows.forEach((row) => {
    row.addEventListener("click", function () {
      // Get the destination URL from the data-href attribute
      const destination = row.getAttribute("data-href");

      // Navigate to the destination URL
      window.location.href = destination;
    });
  });
}

const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

/* --- Code for the graph --- */

if (
  window.location.pathname.endsWith("bnb.html") ||
  window.location.pathname.endsWith("btc.html") ||
  window.location.pathname.endsWith("eth.html") ||
  window.location.pathname.endsWith("usdc.html") ||
  window.location.pathname.endsWith("usdt.html") ||
  window.location.pathname.endsWith("xrp.html")
) {
  new Chart("cryptoChart", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [
        {
          fill: false,
          lineTension: 0,
          backgroundColor: "#00ccff",
          borderColor: "#00ccff",
          data: yValues,
          pointRadius: 0,
          pointHoverRadius: 0,
        },
      ],
    },
    options: {
      legend: { display: false },
      scales: {
        x: {
          grid: {
            color: "rgba(0, 0, 0, 0)", // Remove grid lines for the X axis
          },
        },
        y: {
          grid: {
            color: "rgba(0, 0, 0, 0)", // Remove grid lines for the Y axis
          },
          ticks: {
            min: 6,
            max: 16,
          },
        },
      },
    },
  });
}
