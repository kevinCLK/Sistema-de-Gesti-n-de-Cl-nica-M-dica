<form id="editarRegistroHorario" method="post">
    @csrf
    <input type="hidden" name="idHorario" value="{{ $obj->id }}">

    <div class="form-group">
        <label>Día</label>
        <select name="dia" class="form-control">
            <option value="Lunes" {{ $obj->dia == 'Lunes' ? 'selected' : '' }}>Lunes</option>
            <option value="Martes" {{ $obj->dia == 'Martes' ? 'selected' : '' }}>Martes</option>
            <option value="Miércoles" {{ $obj->dia == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
            <option value="Jueves" {{ $obj->dia == 'Jueves' ? 'selected' : '' }}>Jueves</option>
            <option value="Viernes" {{ $obj->dia == 'Viernes' ? 'selected' : '' }}>Viernes</option>
            <option value="Sábado" {{ $obj->dia == 'Sábado' ? 'selected' : '' }}>Sábado</option>
            <option value="Domingo" {{ $obj->dia == 'Domingo' ? 'selected' : '' }}>Domingo</option>
        </select>
    </div>

    <div class="form-group">
        <label>Hora Inicio</label>
        <input type="time" name="hora_inicio" value="{{ $obj->hora_inicio }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Hora Fin</label>
        <input type="time" name="hora_fin" value="{{ $obj->hora_fin }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Doctor</label>
        <select name="doctor_id" class="form-control">
            @foreach($doctores as $doctor)
                <option value="{{ $doctor->id }}" {{ $obj->doctor_id == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->nombres }} {{ $doctor->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Consultorio</label>
        <select name="consultorio_id" class="form-control">
            @foreach($consultorios as $consultorio)
                <option value="{{ $consultorio->id }}" {{ $obj->consultorio_id == $consultorio->id ? 'selected' : '' }}>
                    {{ $consultorio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
</form>

<script>
    $("#editarRegistroHorario").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/editarRegistroHorario',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                }
            }
        });
    });
</script>
