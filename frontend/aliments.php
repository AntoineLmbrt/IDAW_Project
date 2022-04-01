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
            var table=$('#aliments').DataTable({
                dom: '<"#buttons"B><"clear">lfrtip',
                buttons: [
                        {
                            text: 'My button',
                            action: function () {
                                alert( 'Button activated' );
                            }
                        }
                ],
                data: response['data'],
                columns : [
                    {data:"id_aliment"},
                    {data:"nom"},
                    {data:"type"},
                    {data:"nb_calories"}
                ],
            });
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })
    });
</script>