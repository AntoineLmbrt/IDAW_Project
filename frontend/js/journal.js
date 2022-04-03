journalRepas();

function displayRepas() {
    $('#journal tbody').remove();
    $('#journal #column2').html('Aliment');
    $('#journal #column3').html('Quantité');
    journalRepas();
}

function displaySport() {
    $('#journal tbody').remove();
    $('#journal #column2').html('Sport');
    $('#journal #column3').html('Durée (en min)');
    journalSport();
}

function journalRepas(){
    $.ajax({
        url:'../backend/repas.php?time=month',
        dataType:'json',
    }).done(function(data){
        console.log('REQ AJAX SUCCED');
        console.log(data);
        for(let i in data){
            $('#journal tbody').append(`<tr><th>${data[i]['date']}</th><th>${data[i]['nom']}</th><th>${data[i]['quantite']}</th><th>${data[i]['aliment.nb_calories*repas.quantite']}</th></tr>`);
        }
        
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}