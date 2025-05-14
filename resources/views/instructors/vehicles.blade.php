<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Door instructeur gebruikte voertuigen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Rijschool</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructors.index') }}">Instructeurs in dienst</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle.overview') }}">Voertuiggegevens</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Door instructeur gebruikte voertuigen</h1>
        <h2>{{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</h2>

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Rijbewijscategorie</th>
                            <th>Kenteken</th>
                            <th>Merk</th>
                            <th>Bouwjaar</th>
                            <th>Brandstof</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->Type }}</td>
                            <td>{{ $vehicle->typeVoertuig->Rijbewijscategorie }}</td>
                            <td>{{ $vehicle->Kenteken }}</td>
                            <td>{{ $vehicle->Type }}</td>
                            <td>{{ date('d-m-Y', strtotime($vehicle->Bouwjaar)) }}</td>
                            <td>{{ $vehicle->Brandstof }}</td>
                            <td>
                                <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Wijzigen
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('instructors.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Terug naar instructeurs
            </a>
            <a href="{{ route('instructors.available-vehicles', $instructor->id) }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Toevoegen Voertuig
            </a>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Rijschool. Alle rechten voorbehouden.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>
