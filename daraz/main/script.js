let sliding = document.querySelectorAll(".slide");
let dots = document.querySelectorAll(".dot");
let index = 0;

function showSlide(i) {
  sliding.forEach((slide) => slide.classList.remove("active"));
  dots.forEach((dot) => dot.classList.remove("active"));

  sliding[i].classList.add("active");
  dots[i].classList.add("active");
}

// Next
document.querySelector(".next").addEventListener("click", () => {
  index = (index + 1) % sliding.length;
  showSlide(index);
});

// Prev
document.querySelector(".prev").addEventListener("click", () => {
  index = (index - 1 + sliding.length) % sliding.length;
  showSlide(index);
});

// Auto
setInterval(() => {
  index = (index + 1) % sliding.length;
  showSlide(index);
}, 3000);

//save on more app event
const img = document.getElementById("img");
const app = document.getElementById("qr");
img.style.display = "none";
app.addEventListener("click", (e) => {
  img.style.display = "block";
  e.stopPropagation();
});
document.addEventListener("click", () => {
  img.style.display = "none";
});

//event on cell center
const seller = document.getElementById("seller");
seller.addEventListener("click", () => {
  window.location.href = "/daraz/cell%20center/index.html";
  // window.open("CLONE/daraz/cell center/index.html", "_blank");
});

//event on help&center
const help = document.getElementById("help");
const helpbox =document.getElementById("box");

function hide()
{
  helpbox.style.display = "none";
}
hide();

help.addEventListener("click", (e) => {
  helpbox.style.display = "block";
  e.stopPropagation();
});

helpbox.addEventListener("click", (e) => {
  e.stopPropagation();
})
document.addEventListener("click", () => {
  hide();
})

//event on login
const log = document.getElementById("log");
const loginbox = document.getElementById("login");
loginbox.style.display = "none";

log.addEventListener("click", (e) => {
  loginbox.style.display = "block";
  e.stopPropagation(); //stop event bubbling
  e.preventDefault();// reload if its link
})

loginbox.addEventListener("click",(e)=>{
  e.stopPropagation();
});

document.addEventListener("click", () => {
  loginbox.style.display = "none";
})

//event on sign up
const signupbox = document.getElementsByClassName("signup")[0];
const sign = document.getElementById("sign");

signupbox.style.display = "none";
sign.addEventListener("click", (e) => {
  signupbox.style.display = "block";
  e.preventDefault();
  e.stopPropagation();
})

signupbox.addEventListener("click", (e) => {
  e.stopPropagation();
})
document.addEventListener("click", () => {
  signupbox.style.display = "none";
})

//event on Language change
const languagenav = document.getElementById("language");
const langbox = document.getElementsByClassName("lang")[0];

langbox.style.display = "none";
languagenav.addEventListener("click", (e) => {
  langbox.style.display = "block";
  e.preventDefault();
  e.stopPropagation();
})

langbox.addEventListener("click", (e) => {
  e.stopPropagation();
})
document.addEventListener("click", (e) => {
  langbox.style.display  ="none";
})