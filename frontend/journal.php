<h1 id="title">Journal</h1>
<div id="journalAdd">
    <div class="box">

    </div>
</div>
<div id="journal">
    <div id="journal-buttons">
        <div class="box">
            <button onclick="displayRepas()">Repas</button>
            <button onclick="displaySport()">Sports</button>
        </div>
    </div>
    <div class="scroll-box">
        <table>
            <thead>
                <tr>
                    <th class="column1">Date</th>
                    <th class="column2">Aliment</th>
                    <th class="column3">Quantité</th>
                    <th class="column4">Calories</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="info">Pour ajouter un élément, rendez-vous sur le dashboard !</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script src="js/journal.js">