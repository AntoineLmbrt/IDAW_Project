// CREATION DU GRAPHE

var nbCalorie = 0;
var objectif = 0;
chargementDonnees();

// dimensions et couleur du graphique
let color = '#18A585';
let radius = 125;
let border = 15;
let padding = 25;

let boxSize = (radius + padding) * 2;

// valeurs du graphique
let value = nbCalorie;
let objective = objectif;

let start = 0;
let end = value/objective;

let count = Math.abs((end - start) / 0.01);
let step = end < start ? -0.01 : 0.01;

let arc = d3.arc()
    .startAngle(0)
    .innerRadius(radius)
    .outerRadius(radius - border);

let parent = d3.select('#graph');

let svg = parent.append('svg')
    .attr('width', boxSize)
    .attr('height', boxSize);

let g = svg.append('g')
    .attr('transform', 'translate(' + boxSize / 2 + ',' + boxSize / 2 + ')');

let meter = g.append('g')
    .attr('class', 'meter');

meter.append('path')
    .attr('class', 'background')
    .attr('fill', '#C9CACC')
    .attr('fill-opacity', 0.5)
    .attr('d', arc.endAngle(Math.PI * 2));

let foreground = meter.append('path')
    .attr('class', 'foreground')
    .attr('fill', color)
    .attr('fill-opacity', 1)

let front = meter.append('path')
    .attr('class', 'foreground')
    .attr('fill', color)
    .attr('fill-opacity', 1);

let nbCalories = meter.append('text')
    .attr('fill', color)
    .attr('text-anchor', 'middle');

function updateProgress(progress) {
    foreground.attr('d', arc.endAngle((Math.PI * 2) * progress));
    front.attr('d', arc.endAngle((Math.PI * 2) * progress));
    nbCalories.text(parseInt(progress * objective) + ' / ' + objective + ' Calories');
}

let progress = start;

(function graphLoading() {
    updateProgress(progress);
    if (count > 0) {
        count--;
        progress += step;
        setTimeout(graphLoading, 10);
    }
})();
    
// AJOUTER UNE SEANCE DE SPORT
$('#ajoutPratique').on('click', function(){
    event.preventDefault();
    if($('#inputSeanceDate').val() && $('#inputSportName').val() && $('#inputSeanceDuration').val()){
        $.ajax({
            url:'../backend/pratique.php',
            method: 'POST',
            dataType:'json',
            data:{
                nom:$('#inputSportName').val(),
                date:$('#inputSeanceDate').val(),
                temps:$('#inputSeanceDuration').val(),
            }
        }).done(function(data){
            console.log(data);
        }).fail(function(){
            console.log('FAILED');
        })
        location.reload();
    } else {
            console.log('Manque des champs')
    }
})

// AJOUTER UN REPAS
$('#ajoutRepas').on('click', function(){
    event.preventDefault();
    if($('#inputRepasDate').val() && $('#inputRepasName').val() && $('#inputRepasQuantity').val()){
        $.ajax({
            url:'../backend/repas.php',
            method: 'POST',
            dataType:'json',
            data:{
                nom:$('#inputRepasName').val(),
                quantite:$('#inputRepasQuantity').val(),
                date:$('#inputRepasDate').val(),
            }
        }).done(function(data){
            console.log(data);
        }).fail(function(){
            console.log('FAILED');
        })
        location.reload();
    }else{
            console.log('Manque des champs')
    }
})


function chargementDonnees(){
    // Dashboard
    $.ajax({
        url:'../backend/utilisateur.php?function=objectif',
        dataType:'json',
        async :false,
    }).done(function(data){
        console.log("REQ AJAX SUCCED");
        nbCalorie+=parseInt(data);
        objectif=parseInt(data);
        // On récupère les calories mangées
        $.ajax({
            url:'../backend/repas.php?time=day',
            dataType:'json',
            async :false,
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            nbCalorie-=parseInt(data);
            // On récupère les calories dépensées
            $.ajax({
                url:'../backend/pratique.php?time=day',
                dataType:'json',
                async :false,
            }).done(function(data){
                console.log('REQ AJAX SUCCED');
                nbCalorie+=parseInt(data);

                
            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })


        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })

    }).fail(function(){
        console.log("REQ AJAX FAILED");
    })

    chargementRepas();
    chargementSport();
    journalRepasDashboard();
    journalSportDashboard();
}

function chargementRepas(){
    
    $.ajax({
        url:"../backend/aliments.php",
        method: "GET",
        dataType: "json",
    })
    .done(function(data){
            for(let i in data['data']){
                $("#inputRepasName").append(`<option value="${data["data"][i]['nom']}"> ${data["data"][i]['nom']} </option>`);
            }
        
    })
    .fail(function(){
        console.log('REQ AJAX FAILED ...');
    })
}

function chargementSport(){
    
    $.ajax({
        url:"../backend/sports.php",
        method: "GET",
        dataType: "json",
    })
    .done(function(data){
            for(let i in data['data']){
                $("#inputSportName").append(`<option value="${data["data"][i]['nom']}"> ${data["data"][i]['nom']} </option>`);
            }
        
    })
    .fail(function(){
        console.log('REQ AJAX FAILED ...');
    })
}

function journalRepasDashboard(){
    $.ajax({
        url:'../backend/repas.php?time=3days',
        dataType:'json',
    }).done(function(data){
        console.log('REQ AJAX SUCCED');
        console.log(data);
        for(let i in data){
            $('#journalRepasDashboard table tbody' ).append(`<tr><td class="table-date">${data[i]['date']}</td><td class="table-item-name">${data[i]['nom']}</td><td class="table-quantity">${data[i]['quantite']}</td><td class="table-calories">${data[i]['aliment.nb_calories*repas.quantite']}</td></tr>`);
        }
        
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}

function journalSportDashboard(){
    $.ajax({
        url:'../backend/pratique.php?time=3days',
        dataType:'json',
    }).done(function(data){
        console.log('REQ AJAX SUCCED');
        console.log(data);
        for(let i in data){
            $('#journalSportDashboard table tbody' ).append(`<tr><td class="table-date">${data[i]['date']}</td><td class="table-item-name">${data[i]['nom']}</td><td class="table-duration">${data[i]['temps']} min</td><td class="table-calories">${data[i]['sport.nb_calories*pratique.temps/60']}</td></tr>`);
        }
    }).fail(function(){
        console.log('REQ AJAX FAILED')
    })
}