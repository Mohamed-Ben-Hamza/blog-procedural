var toggle = document.querySelector('.toggle')

const navList=document.querySelectorAll('.nav-list')


toggle.addEventListener('click',function(){
    navList.forEach(element => {
        element.classList.toggle('hide')
    });
})


var scrollToTopBtn = document.getElementById("scrollToTopBtn");
var rootElement = document.documentElement;

function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: "50px",
    behavior: "smooth",
    
  });
}
scrollToTopBtn.addEventListener("click", scrollToTop);

$(function(){
    $('.linkAjax').on('click',function(event){
        event.preventDefault();
        var object=$(this).data('id')
        
        console.log(object);
    
    })
    
    });
    