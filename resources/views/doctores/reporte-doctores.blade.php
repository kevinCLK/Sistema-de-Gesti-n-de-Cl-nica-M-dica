<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Doctores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <table class="table table-borderless" style="font-size: 8pt">
            <tr>
                <td style="text-align: center">
                    <h4>{{ $configuracion->nombre }}</h4>
                    <p>{{ $configuracion->direccion }}<br>
                    {{ $configuracion->telefono }} <br>
                    {{ $configuracion->correo }}</p>
                </td>
                <td width="330px"></td>
                <td>
                    @if ($configuracion->logo)
                        <img src="{{ url('storage/' . $configuracion->logo) }}" alt="asdfasdfasdf" width="80px">
                    @else   
                        <span>No disponible</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Lista de Doctores -->
        <div class="header">
            <h2>Lista de Doctores</h2>
        </div>
        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Licencia Médica</th>
                    <th>Especialidad</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $index => $doctor)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $doctor->nombres }}</td>
                        <td>{{ $doctor->apellidos }}</td>
                        <td>{{ $doctor->telefono }}</td>
                        <td>{{ $doctor->licencia_medica }}</td>
                        <td>{{ $doctor->especialidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    
</body>
</html>
