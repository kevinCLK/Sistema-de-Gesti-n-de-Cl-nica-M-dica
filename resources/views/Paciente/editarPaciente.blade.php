<form id="editarRegistroPaciente" method="post">
  @csrf
  <input type="hidden" name="idPaciente" value="<?php echo $obj->id ?>"  >

    <div class="row">
        <div class="col-md-4 form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $obj->nombre ?>" class="form-control"  placeholder="Nombre completo">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <label>Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $obj->apellidos ?>" class="form-control"  placeholder="Apellidos">
            @error('apellidos')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <label>CI</label>
            <input type="text" name="ci" value="<?php echo $obj->ci ?>" class="form-control" placeholder="Solo números" maxlength="10">
            @error('ci')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Segunda fila -->
    <div class="row">
        <div class="col-md-4 form-group">
            <label>Número de Seguro</label>
            <input type="text" name="num_seguro" value="<?php echo $obj->num_seguro ?>" class="form-control" placeholder="Número de seguro">
            @error('num_seguro')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="<?php echo $obj->fecha_nacimiento ?>" class="form-control" required>
            @error('fecha_nacimiento')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <label>Género</label>
            <select name="genero" class="form-control" required>
            <option value="Masculino" <?php echo ($obj->genero == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
            <option value="Femenino" <?php echo ($obj->genero == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
            <option value="Otro" <?php echo ($obj->genero == 'Otro') ? 'selected' : '' ?>>Otro</option>
            </select>
            @error('genero')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Contacto -->
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Celular</label>
            <input type="tel" name="celular" value="<?php echo $obj->celular ?>" class="form-control"  placeholder="10 dígitos">
            @error('celular')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" value="<?php echo $obj->correo ?>" class="form-control"  placeholder="correo@ejemplo.com">
            @error('correo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Dirección y detalles adicionales -->
    <div class="form-group">
        <label>Dirección</label>
        <input type="text" name="direccion" value="<?php echo $obj->direccion ?>" class="form-control"  placeholder="Dirección completa">
    </div>

    <!-- Grupo Sanguíneo, Alergias y Contacto de Emergencia -->
    <div class="row">
        <div class="col-md-4 form-group">
            <label>Grupo Sanguíneo</label>
            <select name="grupo_sanguineo" class="form-control" required>
                <option value="A+" <?php echo $obj->grupo_sanguineo == 'A+' ? 'selected' : ''; ?>>A+</option>
                <option value="A-" <?php echo $obj->grupo_sanguineo == 'A-' ? 'selected' : ''; ?>>A-</option>
                <option value="B+" <?php echo $obj->grupo_sanguineo == 'B+' ? 'selected' : ''; ?>>B+</option>
                <option value="B-" <?php echo $obj->grupo_sanguineo == 'B-' ? 'selected' : ''; ?>>B-</option>
                <option value="O+" <?php echo $obj->grupo_sanguineo == 'O+' ? 'selected' : ''; ?>>O+</option>
                <option value="O-" <?php echo $obj->grupo_sanguineo == 'O-' ? 'selected' : ''; ?>>O-</option>
            </select>

        </div>

        <div class="col-md-4 form-group">
            <label>Alergias</label>
            <input type="text" name="alergias" value="<?php echo $obj->alergias ?>" class="form-control" placeholder="Especifique alergias">
            @error('alergias')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <label>Contacto de Emergencia</label>
            <input type="text" name="contacto_emergencia" value="<?php echo $obj->contacto_emegencia ?>"  class="form-control" placeholder="Nombre y teléfono de contacto">
            @error('contacto_emergencia')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Observaciones -->
    <div class="form-group">
        <label>Observaciones</label>
        <input name="observaciones" value="<?php echo $obj->observaciones?>" class="form-control"  placeholder="Observaciones relevantes"></input>
    </div>


  <div class="modal-footer">
    <button type="submit" id="boton" class="btn btn-primary" >GUARDAR DATOS</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>
  </div>

</form>


<script>
$("#editarRegistroPaciente").submit(function(event) {
  event.preventDefault();
  
  $.ajax({
    url: '/editarRegistroPaciente',
    type: 'POST',
    data: $("form").serialize(),
    success:function(){
      window.location="";
    }
  })
}); 
</script>