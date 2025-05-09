<html>
<head>
    <title>Voertuigen van {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</title>
</head>
<body>
    <h1>Voertuigen van {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Type</th>
                <th>Brandstof</th>
                <th>Kenteken</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->Type }}</td>
                    <td>{{ $vehicle->Brandstof }}</td>
                    <td>{{ $vehicle->Kenteken }}</td>
                    <td><a href="{{ route('vehicle.edit', $vehicle->id) }}">Wijzigen</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
