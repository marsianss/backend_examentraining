<html>
<head>
    <title>Voertuiggegevens</title>
</head>
<body>
    <h1>Voertuiggegevens</h1>
    <form method="GET" action="{{ route('instructor.vehicles', ['id' => '']) }}" id="instructorForm">
        <label for="instructor">Selecteer een instructeur:</label>
        <select id="instructor" name="instructor" onchange="document.getElementById('instructorForm').action = '{{ route('instructor.vehicles', '') }}/' + this.value; document.getElementById('instructorForm').submit();">
            <option value="">-- Kies een instructeur --</option>
            @foreach ($instructors as $instructor)
                <option value="{{ $instructor->id }}">
                    {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}
                </option>
            @endforeach
        </select>
    </form>
</body>
</html>
