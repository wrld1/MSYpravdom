"use strict";

const isMobile = {
  Android: function () {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function () {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function () {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function () {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function () {
    return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
  },
  any: function () {
    return (
      isMobile.Android() ||
      isMobile.BlackBerry() ||
      isMobile.iOS() ||
      isMobile.Opera() ||
      isMobile.Windows()
    );
  },
};

let menuArrows = document.querySelectorAll(".arrow");

// if (isMobile.any()) {
//   document.body.classList.add("_touch");
//   if (menuArrows.length > 0) {
//     for (let index = 0; index < menuArrows.length; index++) {
//       const menuArrow = menuArrows[index];
//       menuArrow.addEventListener("click", (e) => {
//         menuArrow.parentElement.classList.toggle("_active");
//       });
//     }
//   }
// } else {
//   document.body.classList.add("_pc");
// }

if (menuArrows.length > 0) {
  for (let index = 0; index < menuArrows.length; index++) {
    const menuArrow = menuArrows[index];
    menuArrow.addEventListener("click", (e) => {
      menuArrow.parentElement.classList.toggle("_active");
    });
  }
}

if (isMobile.any()) {
  document.body.classList.add("_touch");
} else {
  document.body.classList.add("_pc");
}

//Burger menu

const iconMenu = document.querySelector(".menu__icon");
const menuBody = document.querySelector(".menu__body");
if (iconMenu) {
  iconMenu.addEventListener("click", function (e) {
    document.body.classList.toggle("_lock");
    iconMenu.classList.toggle("_active");
    menuBody.classList.toggle("_active");
  });
}

//Smooth Scroll
const menuLinks = document.querySelectorAll(".menu__link[data-goto]");

if (menuLinks.length > 0) {
  menuLinks.forEach((menuLink) => {
    menuLink.addEventListener("click", onMenuLinkClick);
  });

  function onMenuLinkClick(e) {
    const menuLink = e.target;
    if (menuLink.dataset.goto && document.querySelector(menuLink.dataset.goto)) {
      const gotoBlock = document.querySelector(menuLink.dataset.goto);
      const gotoBlockValue =
        gotoBlock.getBoundingClientRect().top +
        scrollY -
        document.querySelector("header").offsetHeight;

      if (iconMenu.classList.contains("_active")) {
        document.body.classList.remove("_lock");
        iconMenu.classList.remove("_active");
        menuBody.classList.remove("_active");
      }
      window.scrollTo({
        top: gotoBlockValue,
        behavior: "smooth",
      });
      e.preventDefault();
    }
  }
}

//Header bg toggle

const header = document.querySelector("header");
const sectionOne = document.querySelector(".full-screen");

const sectionOneOptions = {
  rootMargin: "-200px 0px 0px 0px",
};

const sectionOneObserver = new IntersectionObserver(function (entries, sectionOneObserver) {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      header.classList.add("header__scrolled");
    } else {
      header.classList.remove("header__scrolled");
    }
  });
}, sectionOneOptions);

sectionOneObserver.observe(sectionOne);

//menu-links animation on scroll

const li = document.querySelectorAll(".menu__link");
const sec = document.querySelectorAll(".section");

function activeMenu() {
  let len = sec.length;
  while (--len && window.scrollY + 97 < sec[len].offsetTop) {}
  li.forEach((link) => link.classList.remove("link-active"));
  li[len].classList.add("link-active");
}
activeMenu();
window.addEventListener("scroll", activeMenu);
