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
        $('#aliments').DataTable({
            'order': [],
            'ajax': '../backend/aliments.php',
            'colums': [
                {"aliments":"id_aliment"},
                {"aliments":"nom"},
                {"aliments":"type"},
                {"aliments":"nb_calories"}
            ]
        });
    });
</script>