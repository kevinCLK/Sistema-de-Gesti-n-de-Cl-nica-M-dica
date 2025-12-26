<form id="editarRegistroConsultorio" method="post">
  @csrf
  <input type="hidden" name="idConsultorio" value="{{ $obj->id }}">

  <div class="row">
      <div class="col-md-6 form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" value="{{ $obj->nombre }}" class="form-control" placeholder="Nombre del consultorio" required>
          @error('nombre')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>

      <div class="col-md-6 form-group">
          <label>Ubicación</label>
          <input type="text" name="ubicacion" value="{{ $obj->ubicacion }}" class="form-control" placeholder="Ubicación" required>
          @error('ubicacion')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>

  <div class="row">
      <div class="col-md-4 form-group">
          <label>Capacidad</label>
          <input type="number" name="capacidad" value="{{ $obj->capacidad }}" class="form-control" placeholder="Capacidad máxima" required>
          @error('capacidad')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>

      <div class="col-md-4 form-group">
          <label>Teléfono</label>
          <input type="text" name="telefono" value="{{ $obj->telefono }}" class="form-control" placeholder="Teléfono (opcional)">
      </div>

      <div class="col-md-4 form-group">
          <label>Especialidad</label>
          <input type="text" name="especialidad" value="{{ $obj->especialidad }}" class="form-control" placeholder="Especialidad" required>
          @error('especialidad')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>

  <div class="form-group">
      <label>Estado</label>
      <select name="estado" class="form-control" required>
          <option value="Disponible" {{ $obj->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
          <option value="Ocupado" {{ $obj->estado == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
          <option value="Mantenimiento" {{ $obj->estado == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
      </select>
      @error('estado')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>

  <div class="modal-footer">
      <button type="submit" id="boton" class="btn btn-primary">GUARDAR DATOS</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
  </div>
</form>

<script>
$("#editarRegistroConsultorio").submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: '/editarRegistroConsultorio',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response.message);
            location.reload();
        },
        error: function(xhr) {
            alert("Error al actualizar el consultorio.");
        }
    });
});
</script>
