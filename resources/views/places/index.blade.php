{{-- resources/views/places/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Places') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <h1>Places de Parking</h1>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Libre ?</th>
                </tr>
            </thead>
            <tbody>
                @foreach($places as $place)
                    <tr>
                        <td>{{ $place->numero }}</td>
                        <td>{{ $place->est_libre ? 'Oui' : 'Non' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
