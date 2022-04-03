<h1 id="title">Aliments</h1>
<table id="aliments" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Calories</th>
            <!-- <th>Protéines (g/100g)</th>
            <th>Glucides (g/100g)</th>
            <th>Lipides (g/100g)</th>
            <th>Glucose (g/100 g)</th>
            <th>Lactose (g/100 g)</th>
            <th>Alcool (g/100 g)</th>
            <th>Cholestérol (mg/100 g)</th>
            <th>Sel chlorure de sodium (g/100 g)</th>
            <th>Calcium (mg/100 g)</th>
            <th>Sucres (g/100 g)</th> -->
        </tr>
    </thead>
</table>

<p class ="info">Cliquer sur un aliment pour le supprimer ou le modifier !</p>

<div id="aliments-form">
    <div class="box">
        <form>
            <ul>
                <li class="aliments-form-item">
                    <label>Nom :</label>
                    <input type="text" id="nom" name="nom">
                </li>
                <li class="aliments-form-item">
                    <label>Type :</label>
                    <input type="text" id="type" name="type">
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

<script src="js/aliments.js"></script>