{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("{{ asset('logo/medecin.jpg')}}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30%;
            margin: 0 auto;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
        }
        .image {
            width: 300px;
            height: 300px;
            background-image: url("{{ asset('logo/medecin.jpg')}}");
            background-size: cover;
            border-radius: 5px;
            display: none;
        }
        .logo {
            text-align: center;
            margin-bottom: 50px;
        }
        .logo img {
            width: 200px;
            height: 200px;
        }
        .form-control {
            margin-top: 5px;
            margin-bottom: 10px;
            position: relative;
        }
        .form-control label {
            display: block;
            margin-bottom: 5px;
        }
        .form-control input,
        .form-control select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Ensures padding is included in the total width and height */
        }
        .fas {
            position: absolute;
            left: 10px;
            top: 10px;
            font-size: 16px;
            color: #ccc;
        }
        .btn {
            background-color: #3380FF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
            width: 100%; /* Adjusted to match the width of input fields */
            box-sizing: border-box; /* Ensures padding is included in the total width and height */
        }
        .btn:hover {
            background-color: #3380FF;
        }
        .slogan {
            margin-top: 20px;
            color: #333;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

         .highlight {
            font-weight: bold;
            font-size: 20px; /* Increase font size */
            color: #3380FF; /* Match the color of the button */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image"></div>
        <div class="form-container">
            <div class="logo">
                 <p class="highlight"><strong>ASSANE & KHADIM ASSISTANCE MEDICALE.</strong></p>
                <p><strong>Sa Weer Gui Yaraam Mooy Sougnou Priorité.</strong></p>
                <div class="slogan">
                    <img src="{{ asset('logo/ak.png')}}"  alt="">
                </div>
                <p><strong>Connectez-vous pour accéder à notre application!</strong></p>
            </div>
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('submit_login') }}" method="post">
                @csrf
                <div class="form-control">
                    <label for="email"></label>
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <input type="email" id="email" placeholder="Entrer votre email" name="email">
                </div>
                <div class="form-control">
                    <label for="password"></label>
                    <i class="fas fa-key" aria-hidden="true"></i>
                    <input type="password" id="password" placeholder="Entrer votre mot de passe" name="password">
                </div>
                <div class="form-control">
                    <label for="type"></label>
                    <select id="type" name="type">
                        <option value="">Choississez un type </option>
                        <option value="Admin">Admin</option>
                        <option value="Medecin">Medecin</option>
                    </select>
                </div>
                <button type="submit" class="btn">Connexion</button>
            </form>
        </div>
    </div>
</body>
</html> --}}
