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
            "processing": true,
            "serverSide": true,
            'ajax': '../backend/aliments.php',
            'dataSrc': '',
            'columns': [
                {"data":"id_aliment"},
                {"data":"nom"},
                {"data":"type"},
                {"data":"nb_calories"}
            ]
        });
    });
</script>