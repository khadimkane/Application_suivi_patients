<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('/logo/13.jpg')}}');">
        <div class="w-full max-w-md">
            <div class="text-center mb-4">
                <img src="{{ asset('logo/ak.png')}}" alt="Image" class="mt-4 mx-auto w-32">
            </div>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-center text-2xl font-bold mb-4 text-blue-500">Nouveau mot de passe</h2>
                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('password.update')  }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse Email:</label>
                        <input type="email" class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Nouveau Mot de Passe:</label>
                        <input type="password" class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le Nouveau Mot de Passe:</label>
                        <input type="password" class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Réinitialiser le Mot de Passe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
