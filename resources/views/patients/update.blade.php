@extends('layouts.app')

@section('content')

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <div class="flex items-center justify-center">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-user mr-3"></i> Modification des informations du  patient
            </p>
            @if(session('status'))
            <div class="bg-blue-500 text-white">
                {{ session('status') }}
            </div>
            @endif
            <ul>
                @foreach ($errors->all() as $error)
                <li class="alert alert-danger"> {{ $error }} </li>
                @endforeach
            </ul>
            <form action="/update/traitement" method="POST">
                @csrf
                <input type="text" name="id" style="display:none;" value="{{ $patients->id}}">
                <div class="leading-loose">
                    <form class="p-10 bg-white rounded shadow-xl">
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="nom">Nom</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded @error('nom') border-2 border-red-400 bg-white-100 @enderror" id="nom" name="nom" type="text" required placeholder="Nom" aria-label="Nom" wire:model='nom' value="{{ $patients->nom}}">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="prenom">Prenom</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="prenom" name="prenom" type="text" required placeholder="Prenom" aria-label="Prenom" wire:model='prenom' value="{{ $patients->prenom}}">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="date_nais">Date de Naissance</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="date_nais" name="date_nais" type="date" required placeholder="Date de Naissance" aria-label="Date de Naissance" wire:model='date_nais' value="{{ $patients->date_nais}}">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="sexe">Sexe</label>
                            <select name="sexe" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="sexe">
                                <option value="H">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="email">Email</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="text" required placeholder="Email" aria-label="Email" wire:model='email' value="{{ $patients->email}}">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="telephone">Telephone</label>
                            <div class="flex">
                                <input class="w-1/6 px-5 py-1 text-gray-700 bg-gray-200 rounded-l" type="text" value="+221" readonly>
                                <input class="w-5/6 px-5 py-1 text-gray-700 bg-gray-200 rounded-r @error('telephone') border-2 border-red-400 bg-white-100 @enderror" id="telephone" name="telephone" type="text" required placeholder="774870882" aria-label="Telephone" wire:model='telephone' value="{{ $patients->telephone}}">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="adresse">Adresse</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="adresse" name="adresse" type="text" required placeholder="Adresse" aria-label="Adresse" wire:model='adresse' value="{{ $patients->adresse}}">
                        </div>
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-500 rounded" type="submit">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const telephoneInput = document.getElementById('telephone');
        const indicatif = '+221';

        telephoneInput.addEventListener('focus', function () {
            if (!telephoneInput.value.startsWith(indicatif)) {
                telephoneInput.value = indicatif;
            }
        });

        telephoneInput.addEventListener('keydown', function (event) {
            const startPosition = telephoneInput.selectionStart;
            const endPosition = telephoneInput.selectionEnd;
            
            if (startPosition < indicatif.length && (event.key === 'Backspace' || event.key === 'Delete')) {
                event.preventDefault();
            } else if (startPosition === 0 && event.key !== 'Backspace' && event.key !== 'Delete') {
                telephoneInput.setSelectionRange(indicatif.length, endPosition);
            }
        });

        telephoneInput.addEventListener('input', function () {
            if (!telephoneInput.value.startsWith(indicatif)) {
                telephoneInput.value = indicatif + telephoneInput.value.slice(indicatif.length);
            }
        });
    });
</script>

@endsection
