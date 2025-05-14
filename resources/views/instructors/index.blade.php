<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeurs in dienst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .car-icon {
            font-size: 1.5rem;
            color: #444;
            display: block;
            text-align: center;
        }
        h1 {
            text-decoration: underline;
        }
    </style>
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
                        <a class="nav-link active" href="{{ route('instructors.index') }}">Instructeurs in dienst</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle.overview') }}">Voertuiggegevens</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Instructeurs in dienst</h1>
        <p>Aantal instructeurs: {{ $instructors->count() }}</p>

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>Tussenvoegsel</th>
                            <th>Achternaam</th>
                            <th>Mobiel</th>
                            <th>Datum in dienst</th>
                            <th>Aantal sterren</th>
                            <th>Voertuigen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instructors as $instructor)
                        <tr>
                            <td>{{ $instructor->Voornaam }}</td>
                            <td>{{ $instructor->Tussenvoegsel }}</td>
                            <td>{{ $instructor->Achternaam }}</td>
                            <td>{{ $instructor->Mobiel }}</td>
                            <td>{{ \Carbon\Carbon::parse($instructor->DatumInDienst)->format('d-m-Y') }}</td>
                            <td>{{ $instructor->AantalSterren }}</td>
                            <td class="text-center">
                                <a href="{{ route('instructors.vehicles', $instructor->id) }}">
                                    @foreach($instructor->voertuigInstructeurs as $index => $voertuigInstructeur)
                                        @if ($index < 3)
                                            <i class="bi bi-car-front car-icon"></i>
                                        @endif
                                    @endforeach
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
