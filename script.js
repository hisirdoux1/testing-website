// MOBILE NAVIGATION

const menuButton = document.getElementById("menuButton");
const navLinks = document.getElementById("navLinks");

menuButton.addEventListener("click", function () {
    const menuIsOpen = navLinks.classList.toggle("open");

    menuButton.classList.toggle("is-open", menuIsOpen);

    menuButton.setAttribute(
        "aria-expanded",
        menuIsOpen
    );
});


// Close the mobile menu after selecting a navigation link

const navigationItems = document.querySelectorAll(
    "#navLinks a"
);

navigationItems.forEach(function (navigationItem) {
    navigationItem.addEventListener("click", function () {
        navLinks.classList.remove("open");
        menuButton.classList.remove("is-open");

        menuButton.setAttribute(
            "aria-expanded",
            "false"
        );
    });
});


// NAVIGATION BACKGROUND WHEN SCROLLING

const siteHeader = document.getElementById("siteHeader");

window.addEventListener("scroll", function () {
    if (window.scrollY > 20) {
        siteHeader.classList.add("scrolled");
    } else {
        siteHeader.classList.remove("scrolled");
    }
});


// CONTACT FORM DEMONSTRATION

const contactForm = document.getElementById("contactForm");
const formMessage = document.getElementById("formMessage");

contactForm.addEventListener("submit", function (event) {
    event.preventDefault();

    formMessage.textContent =
        "Message submitted successfully. This is currently a demo form.";

    contactForm.reset();

    setTimeout(function () {
        formMessage.textContent = "";
    }, 5000);
});


// AUTOMATIC CURRENT YEAR

const currentYear = document.getElementById("currentYear");

currentYear.textContent = new Date().getFullYear();