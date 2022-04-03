var ligneSelected=null;
var table=null;

// AFFICHAGE ET OPTIONS DE LA DATATABLE ALIMENTS
$(document).ready(function () {
    $.ajax({
        url:"../backend/aliments.php",
        dataType:'json',
    })
    .done(function(response){
        console.log(response);
        table=$('#aliments').DataTable({
            dom: 'lfrtip',
            data: response['data'],
            columns : [
                {data:"id_aliment"},
                {data:"nom"},
                {data:"type"},
                {data:"nb_calories"},
            ],
            rowId:'id_aliment',
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


$('#aliments').on('draw.dt', function(){
    $('.odd').on('click', function(){
        selectionLigne(this.id);
    });
    $('.even').on('click', function(){
        selectionLigne(this.id);
    });
});

// MODIFICATION D'UN ALIMENT
$('#edit').on("click", function(){
    event.preventDefault();
    if(ligneSelected!=null){
        newCol={
            id_aliment: ligneSelected,
            nom:$('#nom').val(),
            type:$('#type').val(),
            nb_calories:$('#calories').val(),}
        $.ajax({
            url:'../backend/aliments.php',
            method: 'POST',
            dataType:'json',
            data:{
                function:"EDIT",
                aliment:{
                    id:ligneSelected,
                    nom:$('#nom').val(),
                    type:$('#type').val(),
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

// AJOUT D'UN ALIMENT
$('#add').on("click", function(){
    event.preventDefault();
    let newCol={
        nom:$('#nom').val(),
        type:$('#type').val(),
        nb_calories:$('#calories').val(),
    }
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
        }
    }).done(function(data){
        if(data['resultat']=='success'){
            newCol['id_aliment']=""+data['id']+"";
            table.row.add(newCol);
            table.draw();
        }else{
            console.log("SQL FAILED");
        }
    }).fail(function(){
        console.log("REQ AJAX FAILED");
    })
})

// SUPRESSION D'UN ALIMENT
$('#delete').on("click", function(){
    event.preventDefault();
    if(ligneSelected!=null){
        let id=ligneSelected
        $.ajax({
            url:'../backend/aliments.php?id_aliment='+id,
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
    let lignes=['id','nom','type','calories']; 
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