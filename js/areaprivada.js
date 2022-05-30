;

 window.onscroll = function() {
    myFunction();


  };
  
  function myFunction() {
    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        document.getElementById("top").classList.add('top-backgroud');
    } else {
        document.getElementById("top").classList.remove('top-backgroud');
    }
  }


var pesquisar = document.getElementById('search-icon');
var containerPesquisar = document.getElementById('search-bar');
containerPesquisar.style.width = '0px';
  
  pesquisar.addEventListener('click',function(){
    if(containerPesquisar.style.width == '0px'){
        containerPesquisar.style.width = '15%';
        pesquisar.style.left = '82%';
    }else{
        containerPesquisar.style.width = '0px';
        pesquisar.style.left = '68%';
    }
  })  

  $('#search-bar').keyup(function(){
      var containerTest = document.querySelector('.search');
      var containerResultado = document.querySelector('.resultado');
      containerTest.style.display = 'block';
      containerResultado.style.display = 'none';

      $('#search_bar_form').submit(function(){

          if(document.getElementById("search-bar").value == ""){
              containerTest.style.display = 'block';
              containerResultado.style.display = 'none';   
          }else {
              containerTest.style.display = 'none';
              containerResultado.style.display = 'flex';
          }
          var dados = $(this).serialize();

          $.ajax({
              url: 'processa.php',
              method: 'post',
              dataType: 'html',
              data: dados,
              success: function(data){
                  $('.resultado').empty().html(data);
              }
              
          });
          
          
          return false;
      });
      
      
      $('#search_bar_form').trigger('submit');

      

  });

var containerBalao = document.querySelector('.balao_play');
var item = document.querySelectorAll("[id='inf_filmes']");

for(var i = 0; i < item.length; i++) {
    item[i].addEventListener("mouseover", func, false);
    item[i].addEventListener("mouseout", func1, false);
}
  
function func()
{  // not needed since item is already global, 
   // I am assuming this is here just because it's sample code?
   // var item = document.getElementById("button"); 
   containerBalao.style.transition = 'visibility 0.5s, opacity 0.5s linear';
   containerBalao.style.visibility = 'visible'; //transition
   containerBalao.style.opacity = '1';
}

function func1()
{  
    containerBalao.style.transition = 'visibility 0.5s, opacity 0.5s linear';
    containerBalao.style.visibility = 'hidden';
    containerBalao.style.opacity = '0';
}


//redericionamento
$(function() {
    timeout = setTimeout(function() {
        window.location.href = "../home.php";
    }, 120000);
});

$(document).on('mousemove', function() {
    if (timeout !== null) { 
        clearTimeout(timeout);
    }
    timeout = setTimeout(function() {
        window.location.href = "../home.php";
    }, 120000);
});


