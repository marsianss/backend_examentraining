<html>
<head>
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

        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Selecteer een instructeur</h5>
            </div>
            <div class="card-body">
                <form class="d-flex" method="GET" action="" id="instructorForm">
                    <select class="form-select me-2" id="instructor" name="instructor" onchange="if (this.value) { window.location.href = '/instructeur/' + this.value + '/voertuigen'; }">
                        <option value="">-- Kies een instructeur --</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">
                                {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel ? $instructor->Tussenvoegsel . ' ' : '' }}{{ $instructor->Achternaam }} ({{ $instructor->AantalSterren }} ⭐)
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary" onclick="if (document.getElementById('instructor').value) { window.location.href = '/instructeur/' + document.getElementById('instructor').value + '/voertuigen'; }">
                        <i class="bi bi-search"></i> Bekijken
                    </button>
                </form>
                <p class="mt-3 mb-0 text-muted">
                    <i class="bi bi-info-circle"></i> Selecteer een instructeur uit de dropdown om hun voertuigen te bekijken.
                </p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('instructors.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Terug naar instructeurs
            </a>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Rijschool. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
