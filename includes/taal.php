<?php
$taal = $_SESSION['lang'];
switch($taal)
{
    case "nl":
        $header=array(
            "CATEGORIE",
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
            "Voornaam",
            "Achternaam"
        );
        $index=array(
            "Willekeurige video's",
            " Geüploade video's "
        );
        $videoshow=array(
            "Titel",
            "Favoriet",
            "Beschrijving",
            "Geen reacties gevonden.",
            "Toegevoegd aan favorieten!",
            "Favoriet toevoegen is mislukt."
        );
        $favoriteList=array(
            "Je hebt nog geen favoriten."
        );
        $upload=array(
            "Upload hier uw videos",
            "Upload alstublieft uw video",
            "Titel",
            "Beschrijving",
            "Wiskunde",
            "PHP",
            "Informatiemanagement",
            "HTML",
            "C#",
            "Java",
            "Databases",
            "Economy",
            "Nederlands",
            "Dit bestand is niet een video, upload alstublieft een video.",
            "Bedankt voor het uploaden van een video."
        );
        $hotelschool=array(
            "Nederlands",
            "Economie",
            "Wiskunde"
        );
        $informatica=array(
            "Informatiemanagement"
        );
        $pabo=array(
            "Nederlands",
            "Economie",
            "Wiskunde"
        );
        $videoAdminShow=array(
            "U bent op de admin pagina.",
            "Geen video gevonden.",
            "Beschrijving"
        );
        $admin=array(
            "U bent op de admin pagina.",
            "Er zijn geen videos aanwezig voor controle."
        );
        $footer=array(
            "Volg ons:"
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
            "StudentID",
            "First name",
            "Last name"
        );
        $index=array(
            "Random videos",
            "Uploaded videos"
        );
        $videoshow=array(
            "Title",
            "Favorite",
            "Description",
            "No comments found.",
            "Added to favourites!",
            "<p>Favourite failed to add</p>"
        );
        $favoriteList=array(
            "You don't have any favorites yet."
        );
        $upload=array(
            "Upload your video here",
            "Please upload your video",
            "Title",
            "Description",
            "Math",
            "PHP",
            "Information management",
            "HTML",
            "C#",
            "Java",
            "Databases",
            "Economy",
            "Dutch",
            "This is not the correct file type, please upload a video!",
            "Thank you for uploading a video!"
        );
        $hotelschool=array(
            "Dutch",
            "Economy",
            "Math"
        );
        $informatica=array(
            "Information management"
        );
        $pabo=array(
            "Dutch",
            "Economy",
            "Math"
        );
        $videoAdminShow=array(
            "You're on the admin page.",
            "There is no video found.",
            "Description"
        );
        $admin=array(
            "You are on the admin page.",
            "There are no videos awaiting judgement."
        );
        $footer=array(
            "Follow us:"
        );
        $error="Something went wrong. Try again later.";
        break;
}