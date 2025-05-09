<html>
<head>
    <title>Voertuigen van {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Voertuiggegevens</a>
            <div class="collapse navbar-collapse">
                <form class="d-flex" method="GET" action="" id="instructorForm">
                    <select class="form-select me-2" id="instructor" name="instructor" onchange="if (this.value) { window.location.href = '/instructeur/' + this.value + '/voertuigen'; }">
                        <option value="">-- Kies een instructeur --</option>
                        @foreach ($instructors as $inst)
                            <option value="{{ $inst->id }}" {{ $inst->id == $instructor->id ? 'selected' : '' }}>
                                {{ $inst->Voornaam }} {{ $inst->Tussenvoegsel }} {{ $inst->Achternaam }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Voertuigen van {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</h1>

        <table class="table table-striped">
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
                        <td><a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Wijzigen</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
