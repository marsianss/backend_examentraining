<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <ul>
        <li><a href="{{ route('vehicle.overview') }}">Voertuiggegevens</a></li>
    </ul>
    <h1>Instructeurs</h1>
    <ul>
        @foreach ($instructors as $instructor)
            <li>
                <a href="{{ route('instructor.vehicles', $instructor->id) }}">
                    {{ $instructor->Voornaam }} {{ $instructor->Tussenvoegsel }} {{ $instructor->Achternaam }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
