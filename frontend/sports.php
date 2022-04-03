<h1 id="title">Sports</h1>
<table id="sports" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Calories</th>
        </tr>
    </thead>
</table>

<p class ="info">Cliquer sur un sport pour le supprimer ou le modifier !</p>

<div id="aliments-form">
    <div class="box">
        <form>
            <ul>
                <li class="aliments-form-item">
                    <label>Nom :</label>
                    <input type="text" id="nom" name="nom">
                </li>
                <li class="aliments-form-item">
                    <label>Calories :</label>
                    <input type="number" id="calories" name="calories">
                </li>
                <li id="aliments-form-buttons">
                    <button class="button" id="add">Ajouter</button>
                    <button class="button" id="edit">Modifier</button>
                    <button class="button" id="delete">Supprimer</button>
                </li>
            </ul>
        </form>
    </div>
</div>

<script>
    var ligneSelected=null;
    var table=null;
    $(document).ready(function () {
        $.ajax({
            url:"../backend/sports.php",
            dataType:'json',
        })
        .done(function(response){
            console.log(response);
            table=$('#sports').DataTable({
                dom: 'lfrtip',
                data: response['data'],
                columns : [
                    {data:"id_sport"},
                    {data:"nom"},
                    {data:"nb_calories"},
                ],
                rowId:'id_sport',
                // scrollX: 200,
                scrollY: 350,
                language: {
                    lengthMenu: "Afficher _MENU_ aliments",
                    search: "Rechercher :",
                    info: "Page _PAGE_ sur _PAGES_",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant"
                    }
                }
            });
            
            
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        });
    });
    $('#sports').on('draw.dt', function(){
        $('.odd').on('click', function(){
            selectionLigne(this.id);
        });
        $('.even').on('click', function(){
            selectionLigne(this.id);
        });
    });

    // Si on appuie sur "Modifier"
    $('#edit').on("click", function(){
        event.preventDefault();
        if(ligneSelected!=null){
            newCol={
                id_sport: ligneSelected,
                nom:$('#nom').val(),
                nb_calories:$('#calories').val(),}
            $.ajax({
                url:'../backend/sports.php',
                method: 'POST',
                dataType:'json',
                data:{
                    function:"EDIT",
                    sport:{
                        id:ligneSelected,
                        nom:$('#nom').val(),
                        nb_calories:$('#calories').val(),
                    },
                }
            }).done(function(data){
                console.log(data);
                table.row("#"+ligneSelected).data(
                    newCol
                );
                table.draw();
            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })
        }
    })

    // Si on appuie sur add
    $('#add').on("click", function(){
        event.preventDefault();
        let newCol={
            nom:$('#nom').val(),
            nb_calories:$('#calories').val(),
        }
        $.ajax({
            url:'../backend/sports.php',
            method: 'POST',
            dataType:'json',
            data:{
                function:"ADD",
                sport:{
                    nom:$('#nom').val(),
                    nb_calories:$('#calories').val(),
                },
            }
        }).done(function(data){
            if(data['resultat']=='success'){
                newCol['id_sport']=""+data['id']+"";
                table.row.add(newCol);
                table.draw();
            }else{
                console.log("SQL FAILED");
            }
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })
    })
    // On supprime une ligne
    $('#delete').on("click", function(){
        event.preventDefault();
        if(ligneSelected!=null){
            let id=ligneSelected
            $.ajax({
                url:'../backend/sports.php?id_sport='+id,
                method: 'DELETE',
                dataType:'json',
            }).done(function(data){
                if(data['resultat']=='success'){
                    table.row("#"+id).remove();
                    table.draw();

                }else{
                    console.log("SQL FAILED");
                }
            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })
        }
    })

    // A chaque changment de page, on réabonne toutes les lignes. Et on rentre la selection dans le form
    function selectionLigne(idLigne){
        let lignes=['id','nom','calories']; 
        $('#'+ligneSelected).removeClass("selected");
        $('#'+idLigne).addClass("selected");
        ligneSelected=idLigne;
        let temp=0;
        $('#'+ligneSelected).children().each(function(){
            if(lignes[temp]=='id'){
                temp++;
            }else{
                document.getElementById(lignes[temp]).value = $(this).html();
                temp++;
            }
        });
    }
</script>