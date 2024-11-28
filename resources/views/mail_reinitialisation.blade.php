<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de Mot de Passe</title>
</head>
<body>
    <h2>Réinitialisation de Mot de Passe</h2>
    <p>Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
    <a href="{{ route('password.reset', $token) }}">Réinitialiser le Mot de Passe</a>
</body>
</html>
