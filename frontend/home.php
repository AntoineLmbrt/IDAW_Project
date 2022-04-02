<h1 id="title">Dashboard</h1>
<div id="dashboard">
    <div class="box">
        <div id="graph"></div>
    </div>
    <div id="journalRepas"></div>
    <div id="journalSport"></div>
</div>

<script>

    // GRAPH

    // dimensions et couleur du graphique
    let color = '#2ED4AE';
    let radius = 150;
    let border = 20;
    let padding = 30;

    let boxSize = (radius + padding) * 2;

    // valeurs du graphique
    let value = 4300; // mettre vraie valeur
    let objective = 10000; //mettre vraie valeur

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



    $('body').ready(chargementDonnee());
    var nbCalorie = 0;
    var objectif=0
    function chargementDonnee(){
        // Dashboard
        $.ajax({
            url:'http://project/backend/utilisateur.php?function=objectif',
            dataType:'json',
        }).done(function(data){
            console.log("REQ AJAX SUCCED");
            nbCalorie+=parseInt(data);
            objectif=parseInt(data);
            // On récupère les calorie mangé
            $.ajax({
                url:'http://project/backend/repas.php?time=day',
                dataType:'json',
            }).done(function(data){
                console.log('REQ AJAX SUCCED');
                nbCalorie-=parseInt(data);
                // On récupère les calories dépensé
                $.ajax({
                    url:'http://project/backend/pratique.php?time=day',
                    dataType:'json',
                }).done(function(data){
                    console.log('REQ AJAX SUCCED');
                    nbCalorie+=parseInt(data);

                    $('#graphCalorie').append(`${nbCalorie}/${objectif}`)
                }).fail(function(){
                    console.log("REQ AJAX FAILED");
                })


            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })

        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })


        //Journal Repas
        journalRepas();
        //Journal Sport
        journalSport();
    }


    function journalRepas(){
        $.ajax({
            url:'http://project/backend/repas.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }

    function journalSport(){
        $.ajax({
            url:'http://project/backend/pratique.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }
</script>