<?php
// Begin maken aan de sessie
session_start();
$Host = "127.0.0.1";
$User = "root";
$Password = "";
$DBName = "netnix";  

if (!isset($_SESSION['loggedin'])) {
    // not logged in
    header("Location: login.php?lang=$lang");
    exit();
}
?>
<!DOCTYPE html>
<!--
INF1C Informatica NHL STENDEN
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php"); ?>
                <h1 class="rightrow">Ownership of Site; Agreement to Terms of Use</h1>               
                <p>These Terms and Conditions of Use (the "Terms of Use") apply to the Apple web site located at www.apple.com, and all associated sites linked to www.apple.com by Apple, its subsidiaries and affiliates, including Apple sites around the world (collectively, the "Site").</p>
                <p>The Site is the property of Apple Inc. ("Apple") and its licensors.</p>
                <p>BY USING THE SITE, YOU AGREE TO THESE TERMS OF USE; IF YOU DO NOT AGREE, DO NOT USE THE SITE.</p>
                <p>Apple reserves the right, at its sole discretion, to change, modify, add or remove portions of these Terms of Use, at any time.</p>
                <p>It is your responsibility to check these Terms of Use periodically for changes. Your continued use of the Site following the posting of changes will mean that you accept and agree to the changes.</p>
                <p>As long as you comply with these Terms of Use, Apple grants you a personal, non-exclusive, non-transferable, limited privilege to enter and use the Site.</p>
                <h1 class="rightrow">Accounts, Passwords and Security</h1>
                <p>Certain features or services offered on or through the Site may require you to open an account (including setting up an Apple ID and password).</p>
                <p>You are entirely responsible for maintaining the confidentiality of the information you hold for your account, including your password, and for any and all activity that occurs under your account as a result of your failing to keep this information secure and confidential.</p>
                <p>You agree to notify Apple immediately of any unauthorized use of your account or password, or any other breach of security.</p>
                <p>You may be held liable for losses incurred by Apple or any other user of or visitor to the Site due to someone else using your Apple ID, password or account as a result of your failing to keep your account information secure and confidential.</p>
                <p>You may not use anyone else’s Apple ID, password or account at any time without the express permission and consent of the holder of that Apple ID, password or account.</p>
                <p>Apple cannot and will not be liable for any loss or damage arising from your failure to comply with these obligations.</p>
                <h1 class="rightrow">Disclaimer</h1>
                <p>APPLE DOES NOT PROMISE THAT THE SITE OR ANY CONTENT, SERVICE OR FEATURE OF THE SITE WILL BE ERROR-FREE OR UNINTERRUPTED, OR THAT ANY DEFECTS WILL BE CORRECTED, OR THAT YOUR USE OF THE SITE WILL PROVIDE SPECIFIC RESULTS.</p>
                <p>THE SITE AND ITS CONTENT ARE DELIVERED ON AN "AS-IS" AND "AS-AVAILABLE" BASIS.</p>
                <p>ALL INFORMATION PROVIDED ON THE SITE IS SUBJECT TO CHANGE WITHOUT NOTICE.</p>
                <p>APPLE CANNOT ENSURE THAT ANY FILES OR OTHER DATA YOU DOWNLOAD FROM THE SITE WILL BE FREE OF VIRUSES OR CONTAMINATION OR DESTRUCTIVE FEATURES.</p>
                <p>APPLE DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING ANY WARRANTIES OF ACCURACY, NON-INFRINGEMENT, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.</p>
                <p>APPLE DISCLAIMS ANY AND ALL LIABILITY FOR THE ACTS, OMISSIONS AND CONDUCT OF ANY THIRD PARTIES IN CONNECTION WITH OR RELATED TO YOUR USE OF THE SITE AND/OR ANY APPLE SERVICES.</p>
                <p>YOU ASSUME TOTAL RESPONSIBILITY FOR YOUR USE OF THE SITE AND ANY LINKED SITES.</p>
                <p>YOUR SOLE REMEDY AGAINST APPLE FOR DISSATISFACTION WITH THE SITE OR ANY CONTENT IS TO STOP USING THE SITE OR ANY SUCH CONTENT.</p>
                <p>THIS LIMITATION OF RELIEF IS A PART OF THE BARGAIN BETWEEN THE PARTIES.</p>
                <?php include ("includes/footer.php"); ?>
            </div>
        </div>
    </body>
</html>