//Responsive Cart button
function openNav() {
    document.getElementById("mySidebar").style.width = "25vw";
    if (window.innerWidth < 750) {
        document.getElementById("mySidebar").style.width = "35vw";
    }
}
        
function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
}

//Header Follows scroll
window.addEventListener('scroll',function(){
    let header = document.querySelector('header');

    if(document.URL.indexOf("index.php") >= 0){ 
        header.classList.toggle('scrollingActive', window.scrollY > 330);
    }
    else{
        header.classList.toggle('scrollingActive', window.scrollY > -100);
    }
})

window.onscroll = function() {stickyFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function stickyFunction() {
    if(document.URL.indexOf("index.php") >= 0){ 
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    }
}
