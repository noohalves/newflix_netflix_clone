var calendario = document.getElementById('calendario');
var home = document.getElementById('btn_esconder');
var home2 = document.getElementById('dashboard');
var email = document.getElementById('email_button');
var comentario = document.getElementById('comentario');
var lupa = document.getElementById('lupa');

var calendario2 = document.getElementById('calendario2');
var home3 = document.getElementById('dashboard2');
var email2 = document.getElementById('email_button2');
var comentario2 = document.getElementById('comentario2');

var addc = document.getElementById('addc');
var addf = document.getElementById('addf');
var adds = document.getElementById('adds');
var menu_painel = document.querySelector('.menu_painel');

var containercalendario = document.querySelector(".c_bla");
var containerhome = document.querySelector('.tudo_mobile');
var containeremail = document.querySelector('.email');
var containerpesquisar = document.getElementById('pesquisar');
var containerContent = document.getElementById('content');
var containerContentF = document.getElementById('contentF');
var containerContentS = document.getElementById('contentS');
var containerContentEP = document.getElementById('contentEP');
var lupa2 = document.getElementById('lupa2');
var x = window.matchMedia("(max-width: 952px)")

// Passando para os Style Hidden
containercalendario.style.visibility = 'hidden';
containeremail.style.visibility = 'hidden';
containerContent.style.visibility = 'hidden';
containerContentF.style.visibility = 'hidden';
containerContentS.style.visibility = 'hidden';
lupa2.style.display = 'none';
containerpesquisar.style.width = '0px';
lupa.style.display = 'block';




//var containersino = document.querySelector('.sino_depois');
/*var item = document.getElementById("sino");
item.addEventListener("mouseover", func, false);
item.addEventListener("mouseout", func1, false);

function func()
{  // not needed since item is already global, 
   // I am assuming this is here just because it's sample code?
   // var item = document.getElementById("button"); 
    containersino.style.transition = 'all 0.5s';
    containersino.style.visibility = 'visible'; //transition
    containersino.style.opacity = '1';
}

function func1()
{  
    containersino.style.transition = 'all 0.5s';
    containersino.style.visibility = 'hidden';
    containersino.style.opacity = '0';
}*/

addf.addEventListener('click', function(){
  if(containerContentF.style.visibility === 'hidden'){
    //Filmes
    containerContentF.style.transition = 'all 0.5s';
    containerContentF.style.visibility = 'visible'; //transition
    containerContentF.style.opacity = '1';
    //Calendario    
    containercalendario.style.transition = 'all 0.5s';
    containercalendario.style.visibility = 'hidden'; //transition
    containercalendario.style.opacity = '0';
    //home
    containerhome.style.transition = 'all 0.5s';
    containerhome.style.visibility = 'hidden';
    containerhome.style.opacity = '0';
    //email
    containeremail.style.transition = 'all 0.5s';
    containeremail.style.visibility = 'hidden';
    containeremail.style.opacity = '0';
    //Serie
    containerContentS.style.transition = 'all 0.5s';
    containerContentS.style.visibility = 'hidden';
    containerContentS.style.opacity = '0';
    //Content
    containerContent.style.transition = 'all 0.5s';
    containerContent.style.visibility = 'hidden';
    containerContent.style.opacity = '0';
    //EPSODIOS
    containerContentEP.style.transition = 'all 0.5s';
    containerContentEP.style.visibility = 'hidden';
    containerContentEP.style.opacity = '0';
    if (x.matches) { // If media query matches
      menu_painel.style.width = '0px';
      home.innerHTML = "↪";
    }  
  }
});

adds.addEventListener('click', function(){
  if(containerContentS.style.visibility === 'hidden'){
    //Series
    containerContentS.style.transition = 'all 0.5s';
    containerContentS.style.visibility = 'visible'; //transition
    containerContentS.style.opacity = '1';
    //Calendario    
    containercalendario.style.transition = 'all 0.5s';
    containercalendario.style.visibility = 'hidden'; //transition
    containercalendario.style.opacity = '0';
    //home
    containerhome.style.transition = 'all 0.5s';
    containerhome.style.visibility = 'hidden';
    containerhome.style.opacity = '0';
    //email
    containeremail.style.transition = 'all 0.5s';
    containeremail.style.visibility = 'hidden';
    containeremail.style.opacity = '0';
    //Content
    containerContent.style.transition = 'all 0.5s';
    containerContent.style.visibility = 'hidden';
    containerContent.style.opacity = '0';
    //Filme
    containerContentF.style.transition = 'all 0.5s';
    containerContentF.style.visibility = 'hidden';
    containerContentF.style.opacity = '0';
    //EPSODIOS
    containerContentEP.style.transition = 'all 0.5s';
    containerContentEP.style.visibility = 'hidden';
    containerContentEP.style.opacity = '0';

    if (x.matches) { // If media query matches
      menu_painel.style.width = '0px';
      home.innerHTML = "↪";
    }  ;
  }
});

addc.addEventListener('click', function(){
  if(containerContent.style.visibility === 'hidden'){
    //Content
    containerContent.style.transition = 'all 0.5s';
    containerContent.style.visibility = 'visible'; //transition
    containerContent.style.opacity = '1';
    //Calendario    
    containercalendario.style.transition = 'all 0.5s';
    containercalendario.style.visibility = 'hidden'; //transition
    containercalendario.style.opacity = '0';
    //home
    containerhome.style.transition = 'all 0.5s';
    containerhome.style.visibility = 'hidden';
    containerhome.style.opacity = '0';
    //email
    containeremail.style.transition = 'all 0.5s';
    containeremail.style.visibility = 'hidden';
    containeremail.style.opacity = '0';
    //Serie
    containerContentS.style.transition = 'all 0.5s';
    containerContentS.style.visibility = 'hidden';
    containerContentS.style.opacity = '0';
    //Filme
    containerContentF.style.transition = 'all 0.5s';
    containerContentF.style.visibility = 'hidden';
    containerContentF.style.opacity = '0';
    //EPSODIOS
    containerContentEP.style.transition = 'all 0.5s';
    containerContentEP.style.visibility = 'hidden';
    containerContentEP.style.opacity = '0';
    if (x.matches) { // If media query matches
      menu_painel.style.width = '0px';
      home.innerHTML = "↪";
    }  
  }
});

calendario.addEventListener('click', function(){
    //containercalendario
    if(containercalendario.style.visibility === 'hidden'){
        
        containercalendario.style.transition = 'all 0.5s';
        containercalendario.style.visibility = 'visible'; //transition
        containercalendario.style.opacity = '1';
        //home
        containerhome.style.transition = 'all 0.5s';
        containerhome.style.visibility = 'hidden';
        containerhome.style.opacity = '0';
        //email
        containeremail.style.transition = 'all 0.5s';
        containeremail.style.visibility = 'hidden';
        containeremail.style.opacity = '0';
        //Content
        containerContent.style.transition = 'all 0.5s';
        containerContent.style.visibility = 'hidden'; //transition
        containerContent.style.opacity = '0';
        //Serie
        containerContentS.style.transition = 'all 0.5s';
        containerContentS.style.visibility = 'hidden';
        containerContentS.style.opacity = '0';
        //Filme
        containerContentF.style.transition = 'all 0.5s';
        containerContentF.style.visibility = 'hidden';
        containerContentF.style.opacity = '0';
        //EPSODIOS
        containerContentEP.style.transition = 'all 0.5s';
        containerContentEP.style.visibility = 'hidden';
        containerContentEP.style.opacity = '0';
        if (x.matches) { // If media query matches
          menu_painel.style.width = '0px';
          home.innerHTML = "↪";
        }  
    }

});
calendario2.addEventListener('click', function(){
  //containercalendario
  if(containercalendario.style.visibility === 'hidden'){
      
      containercalendario.style.transition = 'all 0.5s';
      containercalendario.style.visibility = 'visible'; //transition
      containercalendario.style.opacity = '1';
      //home
      containerhome.style.transition = 'all 0.5s';
      containerhome.style.visibility = 'hidden';
      containerhome.style.opacity = '0';
      //email
      containeremail.style.transition = 'all 0.5s';
      containeremail.style.visibility = 'hidden';
      containeremail.style.opacity = '0';
      //Content
      containerContent.style.transition = 'all 0.5s';
      containerContent.style.visibility = 'hidden'; //transition
      containerContent.style.opacity = '0';
      //Serie
      containerContentS.style.transition = 'all 0.5s';
      containerContentS.style.visibility = 'hidden';
      containerContentS.style.opacity = '0';
      //Filme
      containerContentF.style.transition = 'all 0.5s';
      containerContentF.style.visibility = 'hidden';
      containerContentF.style.opacity = '0';
      //EPSODIOS
      containerContentEP.style.transition = 'all 0.5s';
      containerContentEP.style.visibility = 'hidden';
      containerContentEP.style.opacity = '0';
      if (x.matches) { // If media query matches
        menu_painel.style.width = '0px';
        home.innerHTML = "↪";
      }     
  }

});

home.addEventListener('click', function(){
    //containercalendario

    if(menu_painel.style.width == '0px') {
      home.innerHTML = "↩";
      menu_painel.style.transition = 'all 0.5s';
      menu_painel.style.width = '100%';
      
    }else{
      home.innerHTML = "↪";
      menu_painel.style.transition = 'all 0.5s';
      menu_painel.style.width = '0px';
      
    }
    
});

function myFunction(x) {
  if (x.matches) { // If media query matches
    menu_painel.style.width = "0px";
  } else {
    menu_painel.style.width = "22%";
  }
}

myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes

home2.addEventListener('click', function(){
  //containercalendario
  if(containerhome.style.visibility === 'hidden'){

      containerhome.style.transition = 'all 0.5s';
      containerhome.style.visibility = 'visible'; //transition
      containerhome.style.opacity = '1';
      //home
      containercalendario.style.transition = 'all 0.5s';
      containercalendario.style.visibility = 'hidden';
      containercalendario.style.opacity = '0';
      //email
      containeremail.style.transition = 'all 0.5s';
      containeremail.style.visibility = 'hidden';
      containeremail.style.opacity = '0';
      //Content
      containerContent.style.transition = 'all 0.5s';
      containerContent.style.visibility = 'hidden'; //transition
      containerContent.style.opacity = '0';
      //Serie
      containerContentS.style.transition = 'all 0.5s';
      containerContentS.style.visibility = 'hidden';
      containerContentS.style.opacity = '0';
      //Filme
      containerContentF.style.transition = 'all 0.5s';
      containerContentF.style.visibility = 'hidden';
      containerContentF.style.opacity = '0';
      //EPSODIOS
      containerContentEP.style.transition = 'all 0.5s';
      containerContentEP.style.visibility = 'hidden';
      containerContentEP.style.opacity = '0';
      if (x.matches) { // If media query matches
        menu_painel.style.width = '0px';
        home.innerHTML = "↪";
      }  
  }

});

home3.addEventListener('click', function(){
  //containercalendario
  if(containerhome.style.visibility === 'hidden'){
      containerhome.style.transition = 'all 0.5s';
      containerhome.style.visibility = 'visible'; //transition
      containerhome.style.opacity = '1';
      //home
      containercalendario.style.transition = 'all 0.5s';
      containercalendario.style.visibility = 'hidden';
      containercalendario.style.opacity = '0';
      //email
      containeremail.style.transition = 'all 0.5s';
      containeremail.style.visibility = 'hidden';
      containeremail.style.opacity = '0';
      //Content
      containerContent.style.transition = 'all 0.5s';
      containerContent.style.visibility = 'hidden'; //transition
      containerContent.style.opacity = '0';
      //Serie
      containerContentS.style.transition = 'all 0.5s';
      containerContentS.style.visibility = 'hidden';
      containerContentS.style.opacity = '0';
      //Filme
      containerContentF.style.transition = 'all 0.5s';
      containerContentF.style.visibility = 'hidden';
      containerContentF.style.opacity = '0';
      //EPSODIOS
      containerContentEP.style.transition = 'all 0.5s';
      containerContentEP.style.visibility = 'hidden';
      containerContentEP.style.opacity = '0';
      if (x.matches) { // If media query matches
        menu_painel.style.width = '0px';
        home.innerHTML = "↪";
      }  
  }

});

email.addEventListener('click', function(){
    //containercalendario
    if(containeremail.style.visibility === 'hidden'){
        containeremail.style.transition = 'all 0.5s';
        containeremail.style.visibility = 'visible'; //transition
        containeremail.style.opacity = '1';
        //home
        containercalendario.style.transition = 'all 0.5s';
        containercalendario.style.visibility = 'hidden';
        containercalendario.style.opacity = '0';
        //email
        containerhome.style.transition = 'all 0.5s';
        containerhome.style.visibility = 'hidden';
        containerhome.style.opacity = '0';
        //Content
        containerContent.style.transition = 'all 0.5s';
        containerContent.style.visibility = 'hidden'; //transition
        containerContent.style.opacity = '0';
        //Serie
        containerContentS.style.transition = 'all 0.5s';
        containerContentS.style.visibility = 'hidden';
        containerContentS.style.opacity = '0';
        //Filme
        containerContentF.style.transition = 'all 0.5s';
        containerContentF.style.visibility = 'hidden';
        containerContentF.style.opacity = '0';
        //EPSODIOS
        containerContentEP.style.transition = 'all 0.5s';
        containerContentEP.style.visibility = 'hidden';
        containerContentEP.style.opacity = '0';
        if (x.matches) { // If media query matches
          menu_painel.style.width = '0px';
          home.innerHTML = "↪";
        }  
    }

});
email2.addEventListener('click', function(){
  //containercalendario
  if(containeremail.style.visibility === 'hidden'){
      containeremail.style.transition = 'all 0.5s';
      containeremail.style.visibility = 'visible'; //transition
      containeremail.style.opacity = '1';
      //home
      containercalendario.style.transition = 'all 0.5s';
      containercalendario.style.visibility = 'hidden';
      containercalendario.style.opacity = '0';
      //email
      containerhome.style.transition = 'all 0.5s';
      containerhome.style.visibility = 'hidden';
      containerhome.style.opacity = '0';
      //Content
      containerContent.style.transition = 'all 0.5s';
      containerContent.style.visibility = 'hidden'; //transition
      containerContent.style.opacity = '0';
      //Serie
      containerContentS.style.transition = 'all 0.5s';
      containerContentS.style.visibility = 'hidden';
      containerContentS.style.opacity = '0';
      //Filme
      containerContentF.style.transition = 'all 0.5s';
      containerContentF.style.visibility = 'hidden';
      containerContentF.style.opacity = '0';
      //EPSODIOS
      containerContentEP.style.transition = 'all 0.5s';
      containerContentEP.style.visibility = 'hidden';
      containerContentEP.style.opacity = '0';
      if (x.matches) { // If media query matches
        menu_painel.style.width = '0px';
        home.innerHTML = "↪";
      }  
  }

});

lupa.addEventListener('click', function(){
  //containercalendario
  if(containerpesquisar.style.width === '0px'){
      containerpesquisar.style.width = '200px';
      containerpesquisar.style.transition = 'width 0.5s, left 0.5s linear';
      lupa2.style.display = 'block';
      lupa.style.display = 'none';
  }

});
lupa2.addEventListener('click', function(){
  //containercalendario
  if(containerpesquisar.style.width === '200px'){
      containerpesquisar.style.width = '0px';
      lupa2.style.display = 'none';
      lupa.style.display = 'block';
  }

});

//CALENDARIO
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
	    locale: 'pt-br',
      //initialDate: '2020-09-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      eventSources: [
        {
          url: '/painel/list_date.php', // use the `url` property
          color: 'blue',    // an option!
          textColor: 'white'  // an option!
        }
      ],
      eventContent: function(arg) {
        let arrayOfDomNodes = []
        // title event
        let titleEvent = document.createElement('div')
        if(arg.event._def.title) {
          titleEvent.innerHTML = arg.event._def.title
          titleEvent.classList = "fc-event-title fc-sticky"
        }

        // image event
        let imgEventWrap = document.createElement('div')
        if(arg.event.extendedProps.image_url) {
          let imgEvent = '<img src="'+arg.event.extendedProps.image_url+'" width="30" height="40">'
          imgEventWrap.classList = "fc-event-img"
          imgEventWrap.innerHTML = imgEvent;
        }

        arrayOfDomNodes = [ titleEvent,imgEventWrap ]

        return { domNodes: arrayOfDomNodes }
      },
      extraParams: function() {
        return {
          cachebuster: new Date().valueOf()
        };
      }
      
    });

    calendar.render();
});

//FIM CALENDARIO

//STARS
$(document).ready(function() {
  // Gets the span width of the filled-ratings span
  // this will be the same for each rating
  var star_rating_width = $('.fill-ratings span').width();
  // Sets the container of the ratings to span width
  // thus the percentages in mobile will never be wrong
  $('.star-ratings').width(star_rating_width);
});
