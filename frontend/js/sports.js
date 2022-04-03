var ligneSelected=null;
var table=null;

// AFFICHAGE ET OPTIONS DE LA DATATABLE SPORTS
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
            scrollY: 350,
            language: {
                lengthMenu: "Afficher _MENU_ sports",
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

// MODIFICATION D'UN SPORT
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

// AJOUT D'UN SPORT
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

// SUPRESSION D'UN SPORT
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

// CHANGEMENT DE PAGE : MISE À JOUR DES LIGNES
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