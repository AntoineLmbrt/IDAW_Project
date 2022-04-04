<h1 id="title">Profil</h1>
<div id="profile">
    <div class="box">
        <table>
            <tr class="editable">
                <td class="profile-key">Nom :</td>
                <td class="profile-value" id="nom"></td>
            </tr>
            <tr class="editable">
                <td class="profile-key">Prénom :</td>
                <td class="profile-value" id="prenom"></td>
            </tr>
            <tr class="notEditable">
                <td class="profile-key">Email :</td>
                <td class="profile-value" id="login"></td>
            </tr>
            <tr class="editable">
                <td class="profile-key">Date de naissance :</td>
                <td class="profile-value" id="date_naissance"></td>
            </tr>
            <tr class="editable">
                <td class="profile-key">Sexe :</td>
                <td class="profile-value" id="sexe_libelle"></td>
            </tr>
        </table>
    </div>
</div>
<div id="profile-buttons">
    <button onclick="profileEdit()">Modification</button>
</div>

<script src="js/profil.js"></script>