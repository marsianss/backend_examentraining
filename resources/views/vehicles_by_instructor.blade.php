<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voertuigen van {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</title>
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
                        <a class="nav-link active" href="{{ route('vehicle.overview') }}">Voertuiggegevens</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Voertuigen van instructeur</h1>
            <div>
                <a href="{{ route('vehicle.overview') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Terug naar overzicht
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}</h4>
                        <div class="text-muted">{{ $instructor->AantalSterren }} ⭐ | In dienst sinds: {{ \Carbon\Carbon::parse($instructor->DatumInDienst)->format('d-m-Y') }}</div>
                    </div>
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Andere instructeur
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($instructors as $inst)
                                    @if($inst->id != $instructor->id)
                                        <li><a class="dropdown-item" href="{{ route('instructors.vehicles', $inst->id) }}">
                                            {{ $inst->Voornaam }} {{ $inst->Tussenvoegsel }} {{ $inst->Achternaam }}
                                        </a></li>
                                    @endif
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('vehicle.overview') }}">Alle instructeurs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($vehicles->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Categorie</th>
                                <th>Kenteken</th>
                                <th>Bouwjaar</th>
                                <th>Brandstof</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->Type }}</td>
                                    <td>{{ $vehicle->typeVoertuig ? $vehicle->typeVoertuig->Rijbewijscategorie : 'N/A' }}</td>
                                    <td>{{ $vehicle->Kenteken }}</td>
                                    <td>{{ date('d-m-Y', strtotime($vehicle->Bouwjaar)) }}</td>
                                    <td>{{ $vehicle->Brandstof }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-warning" title="Wijzigen voertuiggegevens">
                                                <i class="bi bi-pencil"></i> Wijzigen
                                            </a>
                                            <a href="{{ route('vehicle.edit', $vehicle->id) }}?reassign=true" class="btn btn-sm btn-info ms-1" title="Voertuig opnieuw toewijzen">
                                                <i class="bi bi-arrow-left-right"></i> Hertoewijzen
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        Deze instructeur heeft nog geen voertuigen toegewezen gekregen.
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('instructors.available-vehicles', $instructor->id) }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Voertuig toevoegen
                </a>
            </div>
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
