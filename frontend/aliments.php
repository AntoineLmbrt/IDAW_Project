<h1 id="title">Aliments</h1>
<table id="aliments" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Calories</th>
            <th>Protéines (g/100g)</th>
            <th>Glucides (g/100g)</th>
            <th>Lipides (g/100g)</th>
            <th>Glucose (g/100 g)</th>
            <th>Lactose (g/100 g)</th>
            <th>Alcool (g/100 g)</th>
            <th>Cholestérol (mg/100 g)</th>
            <th>Sel chlorure de sodium (g/100 g)</th>
            <th>Calcium (mg/100 g)</th>
            <th>Sucres (g/100 g)</th>
        </tr>
    </thead>
</table>
<table id="tableForm">
    <thead>
        <tr>
            <th></th>
            <th>Nom</th>
            <th>Type</th>
            <th>Calories</th>
            <th>Protéines (g/100g)</th>
            <th>Glucides (g/100g)</th>
            <th>Lipides (g/100g)</th>
            <th>Glucose (g/100 g)</th>
            <th>Lactose (g/100 g)</th>
            <th>Alcool (g/100 g)</th>
            <th>Cholestérol (mg/100 g)</th>
            <th>Sel chlorure de sodium (g/100 g)</th>
            <th>Calcium (mg/100 g)</th>
            <th>Sucres (g/100 g)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form id="form">
                <td>
                   <button class="button" id="ADD">ADD</button>
                   <button class="button" id="EDIT">EDIT</button>
                   <button class="button" id="DELETE">DELETE</button>
                </td>
                <td>
                    <input type="text" id="nom" name="nom">
                </td>
                <td>
                    <input type="text" id="type" name="type">
                </td>
                <td>
                    <input type="number" id="calories" name="calories">
                </td>
                <td>
                    <input type="number" id="proteines" name="proteines">
                </td>
                <td>
                    <input type="number" id="glucides" name="glucides">
                </td>
                <td>
                    <input type="number" id="lipides" name="lipides">
                </td>
                <td>
                    <input type="number" id="glucose" name="glucose">
                </td>
                <td>
                    <input type="number" id="lactose" name="lactose">
                </td>
                <td>
                    <input type="number" id="alcool" name="alcool">
                </td>
                <td>
                    <input type="number" id="cholesterol" name="cholestrol">
                </td>
                <td>
                    <input type="number" id="sel" name="sel">
                </td>
                <td>
                    <input type="number" id="calcium" name="calcium">
                </td>
                <td>
                    <input type="number" id="sucre" name="sucre">
                </td>
                
            </form>
        <tr>
    <tbody>
</table>


<script>
    var ligneSelected=null;
    $(document).ready(function () {
        $.ajax({
            url:"../backend/aliments.php",
            dataType:'json',
        })
        .done(function(response){
            console.log(response);
            var table=$('#aliments').DataTable({
                dom: 'lfrtip',
                data: response['data'],
                columns : [
                    {data:"id_aliment"},
                    {data:"nom"},
                    {data:"type"},
                    {data:"nb_calories"},
                    {data:"Protéines (g/100g) "},
                    {data:"Glucides (g/100g)"},
                    {data:"Lipides (g/100g)"},
                    {data:"Glucose (g/100 g)"},
                    {data:"Lactose (g/100 g)"},
                    {data:"Alcool (g/100 g)"},
                    {data:"Cholestérol (mg/100 g)"},
                    {data:"Sel chlorure de sodium (g/100 g)"},
                    {data:"Calcium (mg/100 g)"},
                    {data:"Sucres (g/ 100g)"}
                ],
                rowId:'id_aliment',
                scrollX: 200,
                scrollY: 350
            });
            
            
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        });
    });
    $('#aliments').on('draw.dt', function(){
        $('.odd').on('click', function(){
            selectionLigne(this.id);
        });
        $('.even').on('click', function(){
            selectionLigne(this.id);
        });
    });
    // Si on appuie sur EDIT
    $('#ADD').on("click", function(){
        event.preventDefault();
        
        $.ajax({
            url:'../backend/aliments.php',
            method: 'POST',
            dataType:'json',
            data:{
                function:"ADD",
                aliment:{
                    nom:$('#nom').val(),
                    type:$('#type').val(),
                    nb_calories:$('#calories').val(),
                },
                nutriments:{
                    "1": $('#proteines').val(),
                    "2": $('#glucides').val(),
                    "3": $('#lipides').val(),
                    "4": $('#sucre').val(),
                    "5": $('#glucose').val(),
                    "6": $('#lactose').val(),
                    "7": $('#alcool').val(),
                    "8": $('#cholesterol').val(),
                    "9": $('#sel').val(),
                    "10":$('#calcium').val(),
                }
            }
        }).done(function(data){
            console.log(data);
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })
    })

    // Si on appuie sur add
    $('#ADD').on("click", function(){
        event.preventDefault();

        $.ajax({
            url:'../backend/aliments.php',
            method: 'POST',
            dataType:'json',
            data:{
                function:"ADD",
                aliment:{
                    nom:$('#nom').val(),
                    type:$('#type').val(),
                    nb_calories:$('#calories').val(),
                },
                nutriments:{
                    "1": $('#proteines').val(),
                    "2": $('#glucides').val(),
                    "3": $('#lipides').val(),
                    "4": $('#sucre').val(),
                    "5": $('#glucose').val(),
                    "6": $('#lactose').val(),
                    "7": $('#alcool').val(),
                    "8": $('#cholesterol').val(),
                    "9": $('#sel').val(),
                    "10":$('#calcium').val(),
                }
            }
        }).done(function(data){
            if(data=='success'){
                table.draw();
            }else{
                console.log("SQL FAILED");
            }
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })
    })
    // A chaque changment de page, on réabonne toutes les lignes.
    function selectionLigne(idLigne){
        $('#'+ligneSelected).removeClass("selected");
        $('#'+idLigne).addClass("selected");
        ligneSelected=idLigne;
    }
</script>