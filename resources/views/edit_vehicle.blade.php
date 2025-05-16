<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzigen voertuiggegevens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
        <h1>Wijzigen voertuiggegevens</h1>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($isReassigning) && $isReassigning)
            <div class="alert alert-info mt-3">
                <strong>Voertuig hertoewijzen:</strong> Selecteer een andere instructeur om dit voertuig over te dragen.
            </div>
        @endif

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

                    <div class="mb-3">
                        <label for="instructor_id" class="form-label {{ isset($isReassigning) && $isReassigning ? 'fw-bold text-primary' : '' }}">
                            {{ isset($isReassigning) && $isReassigning ? 'Hertoewijzen aan instructeur:' : 'Toegewezen aan instructeur:' }}
                        </label>
                        <select class="form-select {{ isset($isReassigning) && $isReassigning ? 'border-primary' : '' }}" 
                                id="instructor_id" name="instructor_id" 
                                {{ isset($isReassigning) && $isReassigning ? 'autofocus' : '' }}>
                            <option value="">-- Selecteer een instructeur --</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ isset($currentInstructorId) && $currentInstructorId == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel ? $instructor->Tussenvoegsel . ' ' : '' }}{{ $instructor->Achternaam }} ({{ $instructor->AantalSterren }} ⭐)
                                </option>
                            @endforeach
                        </select>
                        @if(isset($isAssigned) && $isAssigned)
                            @if(isset($isReassigning) && $isReassigning)
                                <small class="text-primary">Selecteer een nieuwe instructeur om het voertuig over te dragen.</small>
                            @else
                                <small class="text-muted">Wijzig de instructeur om het voertuig opnieuw toe te wijzen.</small>
                            @endif
                        @else
                            <small class="text-muted">Selecteer een instructeur om het voertuig toe te wijzen (optioneel).</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($isReassigning) && $isReassigning ? 'Hertoewijzen' : 'Wijzigen' }}
                    </button>
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
