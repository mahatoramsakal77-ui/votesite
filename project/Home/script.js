// sliding boxes one after another
const slider = document.querySelector(".boxes2");
slider.innerHTML += slider.innerHTML;

// burger sliding
const burger = document.querySelector(".burger");
const close = document.querySelector(".close");
const menu = document.querySelector(".menus");

function hide()
{
  burger.style.display = "none";
}

burger.addEventListener("click", () => {
    menu.classList.add("active");
  hide();
  close.style.display = "block";
  
});

close.addEventListener("click", () =>{
  menu.classList.remove('active');
  
       burger.style.display = "block";
       close.style.display = "none";

})

