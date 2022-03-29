<?php
// Requete pour avoir les 3 derniers repas manger et le nombre de Calorie:

// SELECT aliment.nom, aliment.nb_calories*repas.quantite*2 FROM repas 
// LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
// WHERE repas.login = "alexis.poirot@etu.imt-lille-douai.fr" 
// ORDER BY repas.date ASC LIMIT 3

// Requete pour les 3derniers sports pratiqué et le nombre de calorie: 

// SELECT aliment.nom, aliment.nb_calories*repas.quantite*2 FROM repas 
// LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
// WHERE repas.login = "alexis.poirot@etu.imt-lille-douai.fr" 
// ORDER BY repas.date ASC LIMIT 3


?>