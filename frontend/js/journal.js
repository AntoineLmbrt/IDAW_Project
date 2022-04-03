journalRepas();

function displayRepas() {
    $('#journal tbody').html('');
    $('#journal #column2').html('Aliment');
    $('#journal #column3').html('Quantité');
    journalRepas();
}

function displaySport() {
    $('#journal tbody').html('');
    $('#journal #column2').html('Sport');
    $('#journal #column3').html('Durée (en min)');
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
            $('#journal tbody').append(`<tr><td>${data[i]['date']}</td><td>${data[i]['nom']}</td><td>${data[i]['quantite']}</td><td>${data[i]['aliment.nb_calories*repas.quantite']}</td></tr>`);
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
            $('#journal tbody' ).append(`<tr><td class="table-date">${data[i]['date']}</td><td class="table-item-name">${data[i]['nom']}</td><td class="table-duration">${data[i]['temps']} min</td><td class="table-calories">${data[i]['sport.nb_calories*pratique.temps/60']}</td></tr>`);
        }
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}