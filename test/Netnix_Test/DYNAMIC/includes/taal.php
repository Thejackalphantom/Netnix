<?php
//if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true)
//{
//    header("location: login.php");
//    exit;
//}
if (!isset($_SESSION['lang']))
{
    $_SESSION['lang'] = "nl";
}
$taal = $_SESSION['lang'];
switch($taal)
{
    case "nl":
        $header=array(
            "CATAGORIE",
            "ACCOUNT",
            "UPLOAD",
            "FAVORIETEN",
            "Log uit",
            "U bent ingelogd als: "
        );
        $account=array(
            "Uw account",
            "Naam",
            "Student nummer",
            "Uw account",
            "Beschrijving",
            "U heeft nog geen videos geupload."
        );
        $login=array(
            "Vul alle velden in om in te loggen",
            "ongeldig wachtwoord",
            "Ongeldig wachtwoord/gebruikersnaam ingevoerd",
            "Vul a.u.b. uw login gegevens in.",
            "Gebruikersnaam",
            "Wachtwoord",
            "U bent de eerste bezoeker!",
            "Vul uw gebruikersnaam in.",
            "Deze naam is al in gebruik.",
            "Uw account is aangemaakt.",
            "Student nummer",
            "Maak hier uw account aan.",
            "Voornaam",
            "Achternaam"
        );
        $index=array(
            "AANBEVOLEN"
        );
        $addfavorite=array(
            "Toegevoegd aan favorieten!",
            "<p>Favoriet toevoegen is mislukt.</p>"
        );
        $favoriteList=array(
            "Er zijn geen video's",
            "Beschrijving"
        );
        $error="Er is iets misgegaan. Probeer het later opnieuw";
        break;
    case "en":
        $header=array(
            "CATAGORY",
            "ACCOUNT",
            "UPLOAD",
            "FAVOURITES",
            "Log out",
            "You are logged in as: "
        );
        $account=array(
            "Your account",
            "Name",
            "Student ID",
            "Your account",
            "Description",
            "You haven't uploaded any video's yet."
        );
        $login=array(
            "Please fill in all fields to log in",
            "invalid password",
            "Invalid username/password inserted",
            "Please fill in your login details.",
            "Username",
            "Password",
            "You are the first visitor!",
            "Fill in your username.",
            "Username already taken.",
            "Your account has been created.",
            "Student ID",
            "Create your account here.",
            "First name",
            "Last name"
        );
        $index=array(
            "RECOMMENDED"
        );
        $addfavorite=array(
            "Added to favourites!",
            "<p>Favourite failed to add</p>"
        );
        $favoriteList=array(
            "No videos found",
            "Description"
        );
        $error="Something went wrong. Try again later.";
        break;
}