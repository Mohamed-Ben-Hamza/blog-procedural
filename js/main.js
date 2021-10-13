var toggle = document.querySelector('.toggle')
console.log(toggle);
const navList=document.querySelectorAll('.nav-list')


toggle.addEventListener('click',function(){
    navList.forEach(element => {
        element.classList.toggle('hide')
    });
})


