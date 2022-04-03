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
                                <th>Date</th>
                                <th>Aliment</th>
                                <th>Quantité</th>
                                <th>Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><input type="date" id="dateRepas" name="date"></th>
                                <th><select id="nomRepas" name="nom"></select></th>
                                <th><input type="text" id="qteRepas" name="quantite"></th>
                                <th></th>
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
                                <th>Date</th>
                                <th>Sport</th>
                                <th>Durée (en min)</th>
                                <th>Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><input type="date" id="dateSeance" name="date"></th>
                                <th><select id="nomSport" name="nom"></select></th>
                                <th><input type="text" id="dureeSeance" name="quantite"></th>
                                <th></th>
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