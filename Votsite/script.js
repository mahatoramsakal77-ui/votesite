
// Events on image sliding
// const sliding = document.querySelectorAll(".slide");
// let index = 0;
// function showslide(i)
// {
//   sliding.forEach((slide) => slide.classList.remove("active"));

//   sliding[i].classList.add("active");
// }
// document.querySelector(".next").addEventListener("click", () => {
//   index = (index + 1) % sliding.length;
//   showslide(index);
// });

// document.querySelector(".prev").addEventListener("click", () => {
//   index = (index - 1 + sliding.length) % sliding.length;
//   showslide(index);
// });
// setInterval(() => {
//   index = (index + 1) % sliding.length;
//   showslide(index);
// }, 3000);


// events on when user click on vote-here shows sign pop
const votebtn = document.querySelectorAll(".vote-btn");
votebtn.forEach(btn => {
  btn.addEventListener("click", () => {
  window.location.href  = "login/index.html";
})
});

