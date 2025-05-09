<html>
<head>
    <title>Wijzigen voertuiggegevens</title>
</head>
<body>
    <h1>Wijzigen voertuiggegevens</h1>
    <form method="POST" action="{{ route('vehicle.update', $vehicle->Id) }}">
        @csrf
        <label for="Type">Type:</label>
        <input type="text" id="Type" name="Type" value="{{ $vehicle->Type }}" required><br>

        <label for="Brandstof">Brandstof:</label>
        <input type="text" id="Brandstof" name="Brandstof" value="{{ $vehicle->Brandstof }}" required><br>

        <label for="Kenteken">Kenteken:</label>
        <input type="text" id="Kenteken" name="Kenteken" value="{{ $vehicle->Kenteken }}" required><br>

        <button type="submit">Wijzig</button>
    </form>
</body>
</html>