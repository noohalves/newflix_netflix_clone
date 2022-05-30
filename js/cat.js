function uploadFilme() {

    if($('#title').val() == ""){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Título Vazio !";
    }else if($('#description').val() == ""){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Descrição Vazia !";
    }else if($('#capa').val() == ""){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Imagem 'capa' Vazia !";
    }else if($('#fundo').val() == ""){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Imagem 'fundo' Vazia !";
    }else if($('#filme').val() == "" && $('#filmelink').val() == "" ){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "nenhum arquivo 'Filme' Selecionado!";
    }else if($('#filme').val() != "" && $('#filmelink').val() != "" ){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Dois 'Filme' foi Selecionado!";
    }else if($('#idade').val() == "" || $('#idade').val() > "18" || $('#idade').val() < "10"){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Idade errada ou vazia, coloque entre 10 a 18!";
    }else if($('#destaque').val() == "" || $('#destaque').val() < "0" || $('#destaque').val() > "1"){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "coloque 1 ou 0, sendo 0 não aparecera como destaque, 1 ficara em destaque!";
    }else if($('#categoria').val() == ""){
        document.getElementById("respostaFalse").style.display = "block";
        document.getElementById("respostaFalse").innerHTML = "Selecione uma categoria!";
    }else{
        var form_data = new FormData(document.getElementById("form_update_filme"));
        $.ajax({
            type: "POST",
            url: 'cat.php',
            data: form_data, 
            contentType: false,
            cache: false,
            processData:false
        }).done(function(response) {
            $('#contentF').empty().html(response);
        });


    }
    
}
function uploadSerie() {

    if($('#titleSerie').val() == ""){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Título Vazio !";
    }else if($('#descriptionSerie').val() == ""){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Descrição Vazia !";
    }else if($('#capaSerie').val() == ""){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Imagem 'capa' Vazia !";
    }else if($('#fundoSerie').val() == ""){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Imagem 'fundo' Vazia !";
    }else if($('#idadeSerie').val() == "" || $('#idadeSerie').val() > "18" || $('#idadeSerie').val() < "10"){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Idade errada ou vazia, coloque entre 10 a 18!";
    }else if($('#destaqueSerie').val() == "" || $('#destaqueSerie').val() < "0" || $('#destaque').val() > "1"){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "coloque 1 ou 0, sendo 0 não aparecera como destaque, 1 ficara em destaque!";
    }else if($('#categoriaSerie').val() == ""){
        document.getElementById("respostaFalseSerie").style.display = "block";
        document.getElementById("respostaFalseSerie").innerHTML = "Selecione uma categoria!";
    }else{
        var form_data = new FormData(document.getElementById("form_update_serie"));
        $.ajax({
            type: "POST",
            url: 'cat.php',
            data: form_data, 
            contentType: false,
            cache: false,
            processData:false
        }).done(function(response) {
            $('#contentS').empty().html(response);
        });


    }
  
}
function sendEp() {
    var errorEP = document.getElementById('errorEP');
    if($('#titleEp').val() == ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "Titulo vazio !"
    }else if($('#descriptionEp').val() == ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "Descrição vazia !"
    }else if($('#linkEp').val() == "" && $('#EpFile').val() == ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "Preencha um dos dois campos, Link ou File..."
    }else if($('#linkEp').val() != "" && $('#EpFile').val() != ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "Não pode enviar os dois, Link ou File..."
    }else if($('#EpFile').val() != ""){
        var validos = /(\.mp4)$/i;
        var file = $('#EpFile').get(0).files["0"].name;
        if(validos.test(file) != true){
            $('#errorEP').css('opacity',1)
            $('#errorEP').css('visibility','visible')
            errorEP.textContent = "este arquivo não esta no formado .mp4"
        }else if($('#tempEp').val() == ""){
            $('#errorEP').css('opacity',1)
            $('#errorEP').css('visibility','visible')
            errorEP.textContent = "coloque a Temporada 1, 2, 3 ..."
        }else if($('#ordemEp').val() == ""){
            $('#errorEP').css('opacity',1)
            $('#errorEP').css('visibility','visible')
            errorEP.textContent = "Coloque ordem dos epsodios 0, 1, 2 ..."
        }else if($('#tempEp').val() < 0){
            $('#errorEP').css('opacity',1)
            $('#errorEP').css('visibility','visible')
            errorEP.textContent = "numeros negativos nao é aceito !!"
        }else if($('#ordemEp').val() < 0){
            $('#errorEP').css('opacity',1)
            $('#errorEP').css('visibility','visible')
            errorEP.textContent = "numeros negativos nao é aceito !!"
        }else {
            var form_data = new FormData(document.getElementById("form_ep"));
            $.ajax({
                type: "POST",
                url: 'cat.php',
                data: form_data, 
                contentType: false,
                cache: false,
                processData:false
            }).done(function(response) {
                $('.AddEP').empty().html(response);
            });
        }
    }else if($('#tempEp').val() == ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "coloque a Temporada 1, 2, 3 ..."
    }else if($('#ordemEp').val() == ""){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "Coloque ordem dos epsodios 0, 1, 2 ..."
    }else if($('#tempEp').val() < 0){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "numeros negativos nao é aceito !!"
    }else if($('#ordemEp').val() < 0){
        $('#errorEP').css('opacity',1)
        $('#errorEP').css('visibility','visible')
        errorEP.textContent = "numeros negativos nao é aceito !!"
    }else {
        var form_data = new FormData(document.getElementById("form_ep"));
        $.ajax({
            type: "POST",
            url: 'cat.php',
            data: form_data, 
            contentType: false,
            cache: false,
            processData:false
        }).done(function(response) {
            $('.AddEP').empty().html(response);
        });
    }
}

//INPUT FUNCAO
                        
var valueCapa = document.getElementsByClassName("valueCapa")[0];
var capa = document.getElementById("capa");

if(capa){
    valueCapa.addEventListener("click", function(){
        capa.click();
    });
    capa.addEventListener("change", function(){
    var nome = "Não há arquivo selecionado. Selecionar arquivo...";
    if(capa.files.length > 0) nome = capa.files[0].name;
        valueCapa.innerHTML = nome;
    });

}

var valueFundo = document.getElementsByClassName("valueFundo")[0];
var fundo = document.getElementById("fundo");

if(fundo){
    valueFundo.addEventListener("click", function(){
        fundo.click();
    });
    fundo.addEventListener("change", function(){
    var nome = "Não há arquivo selecionado. Selecionar arquivo...";
    if(fundo.files.length > 0) nome = fundo.files[0].name;
        valueFundo.innerHTML = nome;
    });

}

var valueTrailer = document.getElementsByClassName("valueTrailer")[0];
var trailer = document.getElementById("trailer");

if(trailer){
    valueTrailer.addEventListener("click", function(){
        trailer.click();
    });
    trailer.addEventListener("change", function(){
    var nome = "Não há arquivo selecionado. Selecionar arquivo...";
    if(trailer.files.length > 0) nome = trailer.files[0].name;
        valueTrailer.innerHTML = nome;
    });

}

var valueFilme = document.getElementsByClassName("valueFilme")[0];
var filme = document.getElementById("filme");

if(filme){
    valueFilme.addEventListener("click", function(){
        filme.click();
    });
    filme.addEventListener("change", function(){
    var nome = "Não há arquivo selecionado. Selecionar arquivo...";
    if(filme.files.length > 0) nome = filme.files[0].name;
        valueFilme.innerHTML = nome;
    });

}

var valueEpFile = document.getElementsByClassName("valueEpFile")[0];
var EpFile = document.getElementById("EpFile");

if(EpFile){
    valueEpFile.addEventListener("click", function(){
        EpFile.click();
    });
    EpFile.addEventListener("change", function(){
    var nome = "Não há arquivo selecionado. Selecionar arquivo...";
    if(EpFile.files.length > 0) nome = EpFile.files[0].name;
        valueEpFile.innerHTML = nome;
    });

}