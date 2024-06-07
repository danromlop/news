/* mobile menu */

const menuMobile = document.querySelector(".mobile-menu");

menuMobile.addEventListener("click", mobileMenu);

function mobileMenu() {
    
    const mobileNav = document.querySelector(".header-login");

    mobileNav.classList.toggle("mostrar-mobile")
  }

  console.log("javascript")