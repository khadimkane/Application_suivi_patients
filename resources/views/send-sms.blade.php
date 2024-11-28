<!-- resources/views/send-sms.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg">
        <div class="md:flex">
            <div class="w-full px-4 py-6">
                <div class="text-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Envoyer un SMS au patient</h2>
                </div>
                @if(session('status'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                    {{-- {{ route('send-sms') }} --}}
                @endif
                    @if(session('status'))
                      <div class="bg-blue-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('Fail') }}</span>
                      </div>
                       {{-- {{ route('send-sms') }} --}}
                    @endif
                <form action="{{ route('sendSms')}}" method="POST">
                    @csrf
                    <input type="hidden" name="appointement_id" value="{{ $appointements->id }}">
                    <div class="mb-4">
                        <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Numéro de téléphone</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" name="phone_number" value="{{ $appointements->patient->formatted_phone_number }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="message" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
