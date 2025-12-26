<form id="editarRegistroDoctor" method="post">
  @csrf
  <input type="hidden" name="idDoctor" value="{{ $obj->id }}">

  <div class="row">
      <div class="col-md-6 form-group">
          <label>Nombres</label>
          <input type="text" name="nombres" value="{{ $obj->nombres }}" class="form-control" placeholder="Nombres del doctor" required>
          @error('nombres')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>

      <div class="col-md-6 form-group">
          <label>Apellidos</label>
          <input type="text" name="apellidos" value="{{ $obj->apellidos }}" class="form-control" placeholder="Apellidos del doctor" required>
          @error('apellidos')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>

  <div class="row">
      <div class="col-md-4 form-group">
          <label>Teléfono</label>
          <input type="text" name="telefono" value="{{ $obj->telefono }}" class="form-control" placeholder="Teléfono de contacto" required>
          @error('telefono')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>

      <div class="col-md-4 form-group">
          <label>Licencia Médica</label>
          <input type="text" name="licencia_medica" value="{{ $obj->licencia_medica }}" class="form-control" placeholder="Número de licencia médica" required>
          @error('licencia_medica')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>

      <div class="col-md-4 form-group">
          <label>Especialidad</label>
          <input type="text" name="especialidad" value="{{ $obj->especialidad }}" class="form-control" placeholder="Especialidad médica" required>
          @error('especialidad')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>

  <div class="form-group">
      <label>Usuario Asociado</label>
      <select name="user_id" class="form-control" required>
          @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ $obj->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
          @endforeach
      </select>
      @error('user_id')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>

  <div class="modal-footer">
      <button type="submit" id="boton" class="btn btn-primary">GUARDAR DATOS</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
  </div>
</form>

<script>
$("#editarRegistroDoctor").submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: '/editarRegistroDoctor',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response.message);
            location.reload();
        },
        error: function(xhr) {
            alert("Error al actualizar el doctor.");
        }
    });
});
</script>
