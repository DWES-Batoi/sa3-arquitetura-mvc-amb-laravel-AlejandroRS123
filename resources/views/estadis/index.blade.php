@extends('layouts.app')
@section('title', "Guia d'Estadis")

@section('content')
<h1 class="text-3xl font-bold text-green-dark mb-6">Guia d'Estadis</h1>

@if (session('success'))
<div class="bg-green-light text-green-dark p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
    <a href="{{ route('estadis.create') }}" class="bg-green-medium text-white font-bold px-3 py-2 rounded">Nou estadi</a>
</p>

<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Estadi</th>
            <th class="border border-gray-300 p-2">Ciutat</th>
            <th class="border border-gray-300 p-2">Capacitat</th>
            <th class="border border-gray-300 p-2">Equip principal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estadis as $key => $estadi)
        <tr class="hover:bg-gray-100">
            <td class="border border-gray-300 p-2">
                <a href="{{ route('estadis.show', $key) }}" class="font-bold text-green-medium hover:underline">{{ $estadi['nom'] }}</a>
            </td>
            <td class="border border-gray-300 p-2">{{ $estadi['ciutat'] }}</td>
            <td class="border border-gray-300 p-2">{{ $estadi['capacitat'] }}</td>
            <td class="border border-gray-300 p-2">{{ $estadi['equipPrincipal'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection