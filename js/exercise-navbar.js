const previousPos = window.document.documentElement.scrollTop;
const navbarEl = $("#navbar");
if (previousPos >= 150) {
  navbarEl.addClass("opaque");
} else {
  navbarEl.removeClass("opaque");
}

if (previousPos > window.innerHeight) {
  $("#scroll-top").fadeIn("fast");
} else {
  $("#scroll-top").fadeOut("fast");
}

const previousSize = window.innerWidth;
const hamburger = $("#hamburger");

// Menu button click handler
hamburger.click(function() {
  $("#menu").slideToggle(500);
});

// window resize handler
$(window).resize(function() {
  const width = window.innerWidth;
  const menu = $("#menu");
  if (width > 720) {
    if (menu.css("display") === "none") menu.css("display", "flex");
  } else {
    menu.css("display", "none");
  }
});

const documentElement = window.document.documentElement;
const scrollbarHeight =
  window.innerHeight * (window.innerHeight / document.body.offsetHeight);
const initalPos = documentElement.scrollTop;
const scrollHeight = documentElement.scrollHeight;

if (initalPos + scrollbarHeight > scrollHeight - 250) {
  $("#scroll-top").fadeIn("fast");
} else {
  $("#scroll-top").fadeOut("fast");
}

$(document).scroll(function() {
  const currentPos = documentElement.scrollTop;
  if (currentPos + scrollbarHeight > scrollHeight - 250) {
    $("#scroll-top").fadeIn("fast");
  } else {
    $("#scroll-top").fadeOut("fast");
  }
});

$(document).click(function(event) {
  if (event.target.className === "menu-item-link" && window.innerWidth <= 720) {
    $("#menu").slideUp();
  }
});
