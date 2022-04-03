// DECONNEXION
$('#logout').on("click", () => {
    console.log('test');
    $(location).prop('href', 'index.php?logout')
});