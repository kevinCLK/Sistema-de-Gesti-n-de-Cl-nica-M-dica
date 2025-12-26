<form id="editarRegistroEvento" method="post">
    @csrf
    <input type="hidden" name="idEvento" value="{{ $evento->id }}">

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Título</label>
            <input type="text" name="titulo" value="{{ $evento->titulo }}" class="form-control" placeholder="Título del evento">
            @error('titulo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            <label>Color</label>
            <input type="color" name="color" value="{{ $evento->color }}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Fecha y Hora de Inicio</label>
            <input type="datetime-local" name="inicio" value="{{ \Carbon\Carbon::parse($evento->inicio)->format('Y-m-d\TH:i') }}" class="form-control">
            @error('inicio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            <label>Fecha y Hora de Finalización</label>
            <input type="datetime-local" name="final" value="{{ \Carbon\Carbon::parse($evento->final)->format('Y-m-d\TH:i') }}" class="form-control">
            @error('final')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Doctor</label>
            <select name="doctor_id" class="form-control">
                @foreach($doctores as $doctor)
                    <option value="{{ $doctor->id }}" {{ $evento->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->nombre }}</option>
                @endforeach
            </select>
            @error('doctor_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            <label>Consultorio</label>
            <select name="consultorio_id" class="form-control">
                @foreach($consultorios as $consultorio)
                    <option value="{{ $consultorio->id }}" {{ $evento->consultorio_id == $consultorio->id ? 'selected' : '' }}>{{ $consultorio->nombre }}</option>
                @endforeach
            </select>
            @error('consultorio_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" id="boton" class="btn btn-primary">GUARDAR CAMBIOS</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
    </div>
</form>

<script>
    $("#editarRegistroEvento").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/editarRegistroEvento',
            type: 'POST',
            data: $("form").serialize(),
            success: function() {
                window.location = "";
            }
        });
    });
</script>
