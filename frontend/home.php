<h1 id="title">Dashboard</h1>
<div id="dashboard">
    <div id="dashboard-first-column">
        <div class="box graph">
            <h2 class="dashboard-title">Calories quotidiennes :</h2>
            <div id="graph"></div>
        </div>
        <div class="box buttons">
            <h2 class="dashboard-title">Options :</h2>
            <a href="index.php?page=aliments"><div class="btn">Ajouter un aliment</div></a>
            <a href="index.php?page=sport"><div class="btn">Ajouter un sport</div></a>
            <a href="index.php?page=profil"><div class="btn">Profil</div></a>
        </div>
    </div>
    <div id="dashboard-second-column">
        <div class="box journal">
            <div id="journalRepas">
                <h2 class="dashboard-title">Derniers repas :</h2>
                <form>
                    <table id="repas">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Aliment</th>
                                <th>Quantité</th>
                                <th>Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><input type="date" id="dateRepas" name="date"></th>
                                <th><select id="nomRepas" name="nom"></select></th>
                                <th><input type="text" id="qteRepas" name="quantite"></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" id="ajoutRepas">Ajouter un repas</button>
                </form>
            </div>
        </div>
        <div class="box journal">
            <div id="journalSport">
                <h2 class="dashboard-title">Dernieres séances de sport :</h2>
                <form>
                    <table id="pratique">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sport</th>
                                <th>Durée (en min)</th>
                                <th>Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form id='pratiqueForm'>
                                    <th><input type="date" id="dateSeance" name="date"></th>
                                    <th><select id="nomSport" name="nom"></select></th>
                                    <th><input type="text" id="dureeSeance" name="quantite"></th>
                                    <th></th>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" id='ajoutPratique'>Ajouter une séance</button>
                </form>
            </div>
        </div>
    </div>
    <div id="journalSport"></div>
</div>

<script>
    //gestion bouton
    $('#ajoutPratique').on('click', function(){
        event.preventDefault();
        if($('#dateSeance').val() && $('#nomSport').val() && $('#dureeSeance').val()){
            $.ajax({
                url:'../backend/pratique.php',
                method: 'POST',
                dataType:'json',
                data:{
                    nom:$('#nomSport').val(),
                    date:$('#dateSeance').val(),
                    temps:$('#dureeSeance').val(),
                }
            }).done(function(data){
                console.log(data);
            }).fail(function(){
                console.log('FAILED');
            })
        }else{
             console.log('Manque des champs')
        }
    })

    $('#ajoutRepas').on('click', function(){
        event.preventDefault();
        if($('#dateRepas').val() && $('#nomRepas').val() && $('#qteRepas').val()){
            $.ajax({
                url:'../backend/repas.php',
                method: 'POST',
                dataType:'json',
                data:{
                    nom:$('#nomRepas').val(),
                    quantite:$('#qteRepas').val(),
                    date:$('#dateRepas').val(),
                }
            }).done(function(data){
                console.log(data);
            }).fail(function(){
                console.log('FAILED');
            })
        }else{
             console.log('Manque des champs')
        }
    })


    // GRAPH
    var nbCalorie = 0;
    var objectif=0;
    chargementDonnee();
    
    // dimensions et couleur du graphique
    let color = '#2ED4AE';
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

    function chargementDonnee(){
        // Dashboard
        $.ajax({
            url:'../backend/utilisateur.php?function=objectif',
            dataType:'json',
            async :false,
        }).done(function(data){
            console.log("REQ AJAX SUCCED");
            nbCalorie+=parseInt(data);
            objectif=parseInt(data);
            // On récupère les calorie mangé
            $.ajax({
                url:'../backend/repas.php?time=day',
                dataType:'json',
                async :false,
            }).done(function(data){
                console.log('REQ AJAX SUCCED');
                nbCalorie-=parseInt(data);
                // On récupère les calories dépensé
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
        //Journal Repas
        journalRepas();
        //Journal Sport
        journalSport();
    }

    function chargementRepas(){
        
        $.ajax({
            url:"../backend/aliments.php",
            method: "GET",
            dataType: "json",
        })
        .done(function(data){
                for(let i in data['data']){
                    $("#nomRepas").append(`<option value="${data["data"][i]['nom']}"> ${data["data"][i]['nom']} </option>`);
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
                    $("#nomSport").append(`<option value="${data["data"][i]['nom']}"> ${data["data"][i]['nom']} </option>`);
                }
            
        })
        .fail(function(){
            console.log('REQ AJAX FAILED ...');
        })
    }


    function journalRepas(){
        $.ajax({
            url:'../backend/repas.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            for(let i in data){
                $('#repas tbody' ).append(`<tr><th>${data[i]['date']}</th><th>${data[i]['nom']}</th><th>${data[i]['quantite']}</th><th>${data[i]['aliment.nb_calories*repas.quantite']}</th></tr>`);
            }
            
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }

    function journalSport(){
        $.ajax({
            url:'../backend/pratique.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            for(let i in data){
                $('#pratique tbody' ).append(`<tr><th>${data[i]['date']}</th><th>${data[i]['nom']}</th><th>${data[i]['temps']} min</th><th>${data[i]['sport.nb_calories*pratique.temps/60']}</th></tr>`);
            }
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }
</script>