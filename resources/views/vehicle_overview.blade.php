<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voertuiggegevens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
        <h1>Voertuiggegevens</h1>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Instructeurs</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach ($instructors as $instructor)
                                <a href="{{ route('instructors.vehicles', $instructor->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $instructor->Voornaam }}
                                            {{ $instructor->Tussenvoegsel ? $instructor->Tussenvoegsel . ' ' : '' }}
                                            {{ $instructor->Achternaam }}</strong>
                                        <div class="text-muted small">
                                            {{ $instructor->AantalSterren }} ⭐ | In dienst sinds: {{ \Carbon\Carbon::parse($instructor->DatumInDienst)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $instructor->voertuigInstructeurs->count() }}
                                        <i class="bi bi-car-front ms-1"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('instructors.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Terug naar instructeurs
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Selecteer een instructeur</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center" style="min-height: 200px;">
                            <div class="text-center">
                                <i class="bi bi-car-front" style="font-size: 4rem; color: #ddd;"></i>
                                <p class="mt-3 mb-0 text-muted">
                                    Selecteer een instructeur uit de lijst links om hun voertuigen te bekijken.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Rijschool. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
