<?php
// Vul hier jouw eigen Outlook-adres in:
$ontvanger = "timothyveryser@hotmail.be";

// Veiligheid: e-mails filteren/valideren
$voornaam = htmlspecialchars(trim($_POST['voornaam'] ?? ''));
$achternaam = htmlspecialchars(trim($_POST['achternaam'] ?? ''));
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$telefoon = htmlspecialchars(trim($_POST['telefoon'] ?? ''));
$bericht = htmlspecialchars(trim($_POST['bericht'] ?? ''));

if (!$voornaam || !$achternaam || !$email || !$bericht) {
    // Redirect met foutmelding of laat een fout zien
    echo "Vul alle velden correct in.";
    exit;
}

$onderwerp = "Nieuw contactbericht van $voornaam $achternaam";
$body = "Naam: $voornaam $achternaam\n";
$body .= "E-mail: $email\n";
if ($telefoon) $body .= "Telefoon: $telefoon\n";
$body .= "\nBericht:\n$bericht\n";

// Specificeer de afzender (evt. je eigen domein!)
// Gebruik bij voorkeur een mailadres van je eigen domein om SPAM te voorkomen
$headers = "From: ".$voornaam." <website@jouwdomein.be>\r\n";
$headers .= "Reply-To: $email\r\n";

if (mail($ontvanger, $onderwerp, $body, $headers)) {
    // Gelukt: redirect naar bedankpagina of toon succesmelding
    echo "Bedankt voor je bericht! We nemen spoedig contact met je op.";
} else {
    echo "Er is een fout opgetreden bij het versturen. Probeer het later opnieuw.";
}
?>
