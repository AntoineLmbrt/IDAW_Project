<h1 id="title">Inscription</h1>
<form id="signup-form" onSubmit="onFormSubmit()">
    <ul>
        <li>
            <label>Nom et Prénom</label>
            <input type="text" name="inputNom" id="inputNom" class="two-fields" placeholder="Nom">
            <input type="text" name="inputPrenom" id="inputPrenom" class="two-fields" placeholder="Prénom">
        </li>
        <li>
            <label>Email</label>
            <input type="email" name="inputLogin" id="inputEmail" class="one-field" placeholder="Email">
        </li>
        <li>
            <label>Mot de passe</label>
            <input type="password" name="inputPassword" id="inputPassword" class="one-field" placeholder="Mot de passe">
        </li>
        <li>
            <label>Date de naissance</label>
            <input type="date" name="inputDate" id="inputDate">
        </li>
        <li>
            <label>Sexe</label>
            <select name="sexe" id="inputSexe"></select>
        </li>
        <li>
            <input type="submit" value="Inscription" />
        </li>
    </ul>
</form>
<script src="js/signup.js"></script>