journalRepas();

function displayRepas() {
    $('#journal tbody').html('');
    $('#journal .column2').html('Aliment');
    $('#journal .column3').html('Quantité');
    journalRepas();
}

function displaySport() {
    $('#journal tbody').html('');
    $('#journal .column2').html('Sport');
    $('#journal .column3').html('Durée (en min)');
    journalSport();
}

function journalRepas(){
    $.ajax({
        url:'../backend/repas.php?time=all',
        dataType:'json',
    }).done(function(data){
        console.log('REQ AJAX SUCCED');
        console.log(data);
        for(let i in data){
            $('#journal tbody').append(`<tr><td class="column1">${data[i]['date']}</td><td class="column2">${data[i]['nom']}</td><td class="column3">${data[i]['quantite']}</td><td class="column4">${data[i]['aliment.nb_calories*repas.quantite']}</td></tr>`);
        }
        
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}

function journalSport(){
    $.ajax({
        url:'../backend/pratique.php?time=all',
        dataType:'json',
    }).done(function(data){
        console.log('REQ AJAX SUCCED');
        console.log(data);
        for(let i in data){
            $('#journal tbody' ).append(`<tr><td class="column1">${data[i]['date']}</td><td class="column2">${data[i]['nom']}</td><td class="column3">${data[i]['temps']} min</td><td class="column4">${data[i]['sport.nb_calories*pratique.temps/60']}</td></tr>`);
        }
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}