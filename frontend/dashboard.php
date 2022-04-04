<h1 id="title">Dashboard</h1>
<div id="dashboard">
    <div id="dashboard-first-column">
        <div class="box graph">
            <h2 class="dashboard-title">Calories quotidiennes :</h2>
            <div id="graph"></div>
            <div id="graph-info">
                <p class="info">Ce graphique vous informe du nombre de calories que vous pouvez manger aujourd'hui</p>
            </div>
        </div>
        <div class="box buttons">
            <h2 class="dashboard-title">Options :</h2>
            <a href="index.php?page=aliments"><div class="btn">Ajouter un aliment</div></a>
            <a href="index.php?page=sports"><div class="btn">Ajouter un sport</div></a>
            <a href="index.php?page=profil"><div class="btn">Profil</div></a>
        </div>
    </div>
    <div id="dashboard-second-column">
        <div class="box journal">
            <div id="journalRepasDashboard">
                <h2 class="dashboard-title">Derniers repas :</h2>
                <form>
                    <table>
                        <thead>
                            <tr>
                                <th class="table-date">Date</th>
                                <th class="table-item-name">Aliment</th>
                                <th class="table-quantity">Quantité</th>
                                <th class="table-calories">Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-date"><input type="datetime-local" id="inputRepasDate" name="date"></th>
                                <td class="table-item-name"><select id="inputRepasName" name="nom"></select></th>
                                <td class="table-quantity"><input type="text" id="inputRepasQuantity" name="quantite"></th>
                                <td class="table-calories"></th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" id="ajoutRepas">Ajouter un repas</button>
                </form>
            </div>
        </div>
        <div class="box journal">
            <div id="journalSportDashboard">
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
                                <td class="table-date"><input type="datetime-local" id="inputSeanceDate" name="date"></td>
                                <td class="table-item-name"><select id="inputSportName" name="nom"></select></td>
                                <td class="table-duration"><input type="text" id="inputSeanceDuration" name="quantite"></td>
                                <td class="table-calories"></td>
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