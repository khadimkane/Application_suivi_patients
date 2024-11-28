@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Changement de mot de passe</h2>
        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif
        {{-- {{ route('change-password') }} --}}
        <form action="{{route('update_password')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" class="w-full p-2 border rounded">
                @error('current_password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-gray-700">Nouveau mot de passe</label>
                <input type="password" name="new_password" id="new_password" class="w-full p-2 border rounded">
                @error('new_password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-gray-700">Confirmez le nouveau mot de passe</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Changer le mot de passe</button>
        </form>
    </div>
</div>
@endsection
