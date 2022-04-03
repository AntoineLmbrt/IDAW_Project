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

<div id="sports-form">
    <div class="box">
        <form>
            <ul>
                <li class="sports-form-item">
                    <label>Nom :</label>
                    <input type="text" id="nom" name="nom">
                </li>
                <li class="sports-form-item">
                    <label>Calories :</label>
                    <input type="number" id="calories" name="calories">
                </li>
                <li id="sports-form-buttons">
                    <button class="button" id="add">Ajouter</button>
                    <button class="button" id="edit">Modifier</button>
                    <button class="button" id="delete">Supprimer</button>
                </li>
            </ul>
        </form>
    </div>
</div>

<script src="js/sports.js"></script>