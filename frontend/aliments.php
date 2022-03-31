<table id="aliments" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Calories</th>
        </tr>
    </thead>
</table>


<script>
    $(document).ready(function () {
         $.ajax({
            url:"../backend/aliments.php",
            dataType:'json',
        })
        .done(function(response){
            console.log(response);
            $('#aliments').DataTable({
                data: response['data'],
                columns : [
                    {data:"id_aliment"},
                    {data:"nom"},
                    {data:"type"},
                    {data:"nb_calories"}
                ]
            });
        })
        .fail(function(){

        })
    });
    
</script>