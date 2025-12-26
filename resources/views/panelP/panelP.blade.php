@extends('principal')
@section('contenido')
<div class="row">
    <h3><b>Bienvenido: </b>{{ Auth::user()->email }} / <b>Rol:</b> {{ Auth::user()->roles->pluck('name')->first() }}
    </h3>
</div>
<hr>
<div class="row">
    <!-- Recuadro de Pacientes -->
    @can('pacientes.lista')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pacientesCount }}</h3>
                    <p>Pacientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-person-square"></i>
                </div>
                <a href="{{ route('pacientes.lista') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan

    <!-- Recuadro de Doctores -->
    @can('doctores.lista')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $doctoresCount }}</h3>
                    <p>Doctores</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="{{ route('doctores.lista') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan

    <!-- Recuadro de Consultorios -->
    @can('consultorios.lista')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $consultoriosCount }}</h3>
                    <p>Consultorios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital-alt"></i>
                </div>
                <a href="{{ route('consultorios.lista') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan

    <!-- Recuadro de Horarios -->
    @can('horarios.lista')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $horariosCount }}</h3>
                    <p>Horarios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('horarios.lista') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan

    <!-- Recuadro de Usuarios -->
    @can('usuarios.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $usuariosCount }}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('usuarios.index') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan
</div>
@can('horarios.cargar_datos_consultoriosUser')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">CALENDARIO DE DOCTORES</h3>
                </div>
                <div class="card-body">
                    <!-- Selección de Consultorio -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="consultorio_select">Consultorio</label>
                            <select name="consultorio" id="consultorio_select" class="form-control" required>
                                @foreach ($consultorios as $value1)
                                    <option value="{{ $value1->id }}">
                                        {{ $value1->nombre . ' ' . $value1->ubicacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Contenedor dinámico para información del consultorio -->
                    <div id="consultorio_info" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="card-title">Calendario de reserva de citas médicas</h3>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <label for="doctor_select" class="me-2">Doctores:</label>
                            <select name="doctor_id" id="doctor_select" class="form-control">
                                <option value="">Seleccione su doctor...</option>
                                @foreach($doctores as $doctore)
                                    <option value="{{ $doctore->id }}">
                                        {{ $doctore->nombres . " " . $doctore->apellidos . " - " . $doctore->especialidad }}
                                    </option>
                                @endforeach
                            </select>
                            <script>
                                $('#doctor_select').on('change', function () {
                                    var doctor_id = $('#doctor_select').val();
                                    var calendarEl = document.getElementById('calendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        initialView: 'dayGridMonth',
                                        locale: 'es',
                                        events: []
                                    });
                                    if (doctor_id) {
                                        $.ajax({
                                            url: "{{ url('/cargar_reserva_doctores/') }}/" + doctor_id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                console.log(data);

                                                var formattedEvents = data.map(function (event) {
                                                    return {
                                                        title: event.titulo,
                                                        start: new Date(event.inicio),
                                                        end: new Date(event.final),
                                                        color: event.color
                                                    };
                                                });

                                                calendar.addEventSource(formattedEvents);
                                                calendar.render();
                                            },
                                            error: function () {
                                                alert('Error al obtener los datos del consultorio.');
                                            }
                                        });
                                    } else {
                                        $('#doctor_info').html('');
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">Registrar Cita médica</button>
                        <a href="{{ url('/ver_reservas', Auth::User()->id) }}" class="btn btn-success ms-2">
                            <i class="bi bi-calendar2-check"></i> Ver las reservas
                        </a>
                    </div>
                    <!-- Modal -->
                    <form id="registrocita" method="post">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reserva de Cita médica</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Doctor</label>
                                                    <select name="doctor_id" class="form-control">
                                                        @foreach ($doctores as $doctore)
                                                            <option value="{{ $doctore->id }}">
                                                                {{ $doctore->nombres . " " . $doctore->apellidos . " - " . $doctore->especialidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fecha_reserva">Fecha de reserva</label>
                                                    <input type="date" name="fecha_reserva" id="fecha_reserva"
                                                        value="{{ date('Y-m-d') }}" class="form-control">
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function () {
                                                            const fechaReservaInput = document.getElementById('fecha_reserva');
                                                            fechaReservaInput.addEventListener('change', function () {
                                                                let selectedDate = this.value;
                                                                let today = new Date().toISOString().slice(0, 10);
                                                                if (selectedDate < today) {
                                                                    this.value = null;
                                                                    alert('No puede seleccionar una fecha pasada.');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="hora_reserva">Hora de reserva</label>
                                                    <input type="time" name="hora_reserva" id="hora_reserva"
                                                        class="form-control">
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function () {
                                                            const horaReservaInput = document.getElementById('hora_reserva');
                                                            horaReservaInput.addEventListener('change', function () {
                                                                let selectedTime = this.value;
                                                                if (selectedTime < '08:00' || selectedTime > '20:00') {
                                                                    this.value = null;
                                                                    alert('Por favor, seleccione una hora entre las 08:00 y las 20:00.');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endcan


@if(Auth::check() && Auth::user()->doctores)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="card-title">Calendario de reservas</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <td>Nro</td>
                                <td>Usuario</td>
                                <td>Fecha de reserva</td>
                                <td>Hora de reserva</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php    $contador = 1; ?>
                            @foreach($eventos as $evento)
                                @if(Auth::user()->doctores->id == $evento->doctor_id)
                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td>{{ $evento->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($evento->inicio)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($evento->inicio)->format('H:i') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endif





<script>
    $('#consultorio_select').on('change', function () {
        var consultorio_id = $(this).val();
        var url = "{{ route('horarios.cargar_datos_consultoriosUser', ':id') }}".replace(':id', consultorio_id);

        if (consultorio_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('#consultorio_info').html(data);
                },
                error: function () {
                    alert('Error al obtener los datos del consultorio');
                }
            });
        } else {
            $('#consultorio_info').html('');
        }
    });
</script>


<script>



    $("#registrocita").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: '/registrocita',
            type: 'POST',
            data: $("form").serialize(),
            success: function (response) {
                if (response.errors) {
                    // Muestra los errores en la vista
                    if (response.errors.hora_reserva) {
                        $('#hora_reserva').next('.text-danger').remove();
                        $('#hora_reserva').after('<span class="text-danger">' + response.errors.hora_reserva[0] + '</span>');
                    }
                } else {
                    window.location = ""; //
                }
            }
        });
    });



</script>



@endsection