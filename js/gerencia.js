/* Gerenciador de usuario */

//ID USERS
var user1 = document.getElementById("user1");
var user2 = document.getElementById("user2");
var user3 = document.getElementById("user3");
var user4 = document.getElementById("user4");
var x1 = document.getElementById("x1");
var x2 = document.getElementById("x2");
var x3 = document.getElementById("x3");
var x4 = document.getElementById("x4");


//CONTAINERS
var containerUser1 = document.getElementById("containerUser1");
var containerUser2 = document.getElementById("containerUser2");
var containerUser3 = document.getElementById("containerUser3");
var containerUser4 = document.getElementById("containerUser4");
var container1 = document.querySelector(".container1");
var container2 = document.querySelector(".container2");
var container3 = document.querySelector(".container3");
var container4 = document.querySelector(".container4");
var containerimg = document.querySelector(".containerimg");


//FUNÇÔES
user1.addEventListener('click', function(){

    containerUser1.style.display = 'block' ;
    x1.style.display = 'block';

});
user2.addEventListener('click', function(){

    containerUser2.style.display = "block" ;
    x2.style.display = 'block';

});
user3.addEventListener('click', function(){

    containerUser3.style.display = "block" ;
    x3.style.display = 'block';

});
user4.addEventListener('click', function(){

    containerUser4.style.display = "block" ;
    x4.style.display = 'block';

});


//FECHAR
x1.addEventListener('click', function(){

    if(containerUser1.style.display == "block"){
        containerUser1.style.display = "none" ;
        containerimg.style.display = "none" ;
        container1.style.display = 'block' ;
    }

});
x2.addEventListener('click', function(){

    if ( containerUser2.style.display == "block"){
        containerUser2.style.display = "none" ;
        containerimg.style.display = "none" ;
        container2.style.display = 'block' ;
    }

});
x3.addEventListener('click', function(){

    if (containerUser3.style.display == "block") {
        containerUser3.style.display = "none";
        containerimg.style.display = "none" ;
        container3.style.display = 'block' ;
    }

});
x4.addEventListener('click', function(){

    if (containerUser4.style.display == "block") {
        containerUser4.style.display = "none" ;
        containerimg.style.display = "none" ;
        container4.style.display = 'block' ;
    }

});

