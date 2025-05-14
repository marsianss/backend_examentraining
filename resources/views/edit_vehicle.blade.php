<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzigen voertuiggegevens</title>
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
        <h1>Wijzigen voertuiggegevens</h1>

        <div class="card mt-4">
            <div class="card-body">
                <form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="Type" class="form-label">Type:</label>
                        <input type="text" class="form-control" id="Type" name="Type" value="{{ $vehicle->Type }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Brandstof" class="form-label">Brandstof:</label>
                        <input type="text" class="form-control" id="Brandstof" name="Brandstof" value="{{ $vehicle->Brandstof }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Kenteken" class="form-label">Kenteken:</label>
                        <input type="text" class="form-control" id="Kenteken" name="Kenteken" value="{{ $vehicle->Kenteken }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Bouwjaar" class="form-label">Bouwjaar:</label>
                        <input type="date" class="form-control" id="Bouwjaar" name="Bouwjaar" value="{{ $vehicle->Bouwjaar }}" {{ isset($isAssigned) && $isAssigned ? 'readonly' : '' }}>
                        @if(isset($isAssigned) && $isAssigned)
                            <small class="text-muted">Bouwjaar kan niet worden gewijzigd voor voertuigen die al zijn toegewezen.</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Wijzig</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Annuleren</a>
                </form>
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
