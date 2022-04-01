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
<<<<<<< HEAD
                    {data:"nb_calories"}
                ],
                scrollY: 400
=======
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
                    {data:"Sucres (g/ 100g)"},
                ],
>>>>>>> bfdb42afedeb0338ea5aac2baef826df4f7628c2
            });
        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })
    });
</script>