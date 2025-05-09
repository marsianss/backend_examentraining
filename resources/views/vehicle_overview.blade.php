<html>
<head>
    <title>Voertuiggegevens</title>
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
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">
                                {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Voertuiggegevens</h1>
        <p>Selecteer een instructeur uit de dropdown bovenaan om hun voertuigen te bekijken.</p>
    </div>
</body>
</html>
