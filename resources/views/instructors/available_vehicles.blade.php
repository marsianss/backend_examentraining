<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle beschikbare voertuigen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
        <h1>Alle beschikbare voertuigen</h1>
        <h2>Voor toewijzing aan {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Rijbewijscategorie</th>
                            <th>Kenteken</th>
                            <th>Bouwjaar</th>
                            <th>Brandstof</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableVehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->Type }}</td>
                            <td>{{ $vehicle->typeVoertuig->Rijbewijscategorie }}</td>
                            <td>{{ $vehicle->Kenteken }}</td>
                            <td>{{ date('d-m-Y', strtotime($vehicle->Bouwjaar)) }}</td>
                            <td>{{ $vehicle->Brandstof }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Wijzigen
                                </a>
                                <form method="POST" action="{{ route('instructors.assign-vehicle', ['instructorId' => $instructor->id, 'vehicleId' => $vehicle->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-plus-circle"></i> Toewijzen
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="{{ route('instructors.vehicles', $instructor->id) }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Terug naar voertuigen van instructeur
            </a>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Rijschool. Alle rechten voorbehouden.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>