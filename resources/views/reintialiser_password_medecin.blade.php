<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reintialisatiion mot de passe</title>
    <!-- Ajoutez le lien vers Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('/logo/medecin.jpg')}}');">
        <div class="w-full max-w-md">
            <!-- Image au-dessus du formulaire -->
            <div class="text-center mb-4">
                <img src="{{ asset('logo/ak.png')}}" alt="Image" class="mt-4 mx-auto w-32">
            </div>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <!-- Titre "ESPACE MEDECIN" -->
                <h2 class="text-center text-2xl font-bold mb-4 text-blue-500">ESPACE MEDECIN</h2>
                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form id="resetPasswordFormMedecin" action="{{route('send-reset-link')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="medecinName" class="block text-gray-700 text-sm font-bold mb-2">Nom du médecin:</label>
                        <input type="text" class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="medecinName" name="medecinName" required>
                    </div>
                    <div class="mb-6">
                        <label for="medecinEmail" class="block text-gray-700 text-sm font-bold mb-2">Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe :</label>
                        <input type="email" class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="medecinEmail" name="medecinEmail" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script pour afficher le formulaire de réinitialisation de mot de passe des médecins -->
    <script>
        document.querySelector('.forgot-password').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('resetPasswordForm').classList.remove('hidden');
        });
    </script>
</body>
</html>
