@extends('layouts.app')

@section('content')
    <h1>Liste des Places de Parking</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
                <tr>
                    <td>{{ $place->numero }}</td>
                    <td>{{ $place->est_libre ? 'Libre' : 'Occupée' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
