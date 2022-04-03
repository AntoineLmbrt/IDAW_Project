<h1 id="title">Dashboard</h1>
<div id="dashboard">
    <div id="dashboard-first-column">
        <div class="box graph">
            <h2 class="dashboard-title">Calories quotidiennes :</h2>
            <div id="graph"></div>
        </div>
        <div class="box buttons">
            <h2 class="dashboard-title">Options :</h2>
            <a href="index.php?page=aliments"><div class="btn">Ajouter un aliment</div></a>
            <a href="index.php?page=sport"><div class="btn">Ajouter un sport</div></a>
            <a href="index.php?page=profil"><div class="btn">Profil</div></a>
        </div>
    </div>
    <div id="dashboard-second-column">
        <div class="box journal">
            <div id="journalRepas">
                <h2 class="dashboard-title">Derniers repas :</h2>
                <form>
                    <table id="repas">
                        <thead>
                            <tr>
                                <th class="table-date">Date</th>
                                <th class="table-item-name">Aliment</th>
                                <th class="table-duration">Quantité</th>
                                <th class="table-calories">Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="table-date"><input type="date" id="inputRepasDate" name="date"></th>
                                <th class="table-item-name"><select id="inputRepasName" name="nom"></select></th>
                                <th class="table-quantity"><input type="text" id="inputRepasQuantity" name="quantite"></th>
                                <th class="table-calories"></th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" id="ajoutRepas">Ajouter un repas</button>
                </form>
            </div>
        </div>
        <div class="box journal">
            <div id="journalSport">
                <h2 class="dashboard-title">Dernières séances de sport :</h2>
                <form>
                    <table id="pratique">
                        <thead>
                            <tr>
                                <th class="table-date">Date</th>
                                <th class="table-item-name">Sport</th>
                                <th class="table-duration">Durée (en min)</th>
                                <th class="table-calories">Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="table-date"><input type="date" id="inputSeanceDate" name="date"></th>
                                <th class="table-item-name"><select id="inputSportName" name="nom"></select></th>
                                <th class="table-duration"><input type="text" id="inputSeanceDuration" name="quantite"></th>
                                <th class="table-calories"></th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" id='ajoutPratique'>Ajouter une séance</button>
                </form>
            </div>
        </div>
    </div>
    <div id="journalSport"></div>
</div>

<script src="js/dashboard.js"></script>