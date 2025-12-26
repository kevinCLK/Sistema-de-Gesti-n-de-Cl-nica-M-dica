<form id="editarRegistroUser " method="post" >
  @csrf
  <input type="hidden" name="idUsuario" value="<?php echo $obj->id ?>"  >

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="<?php echo $obj->name ?>" class="form-control"  placeholder="Nombre completo">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?php echo $obj->email ?>" class="form-control"  placeholder="correo@ejemplo.com">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control"  placeholder="Contraseña">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

  <div class="modal-footer">
    <button type="submit" id="boton" class="btn btn-primary" >GUARDAR DATOS</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>
  </div>

</form>

<script>
$("#editarRegistroUser ").submit(function(event) {
  event.preventDefault();
  
  $.ajax({
    url: '/editarRegistroUser',
    type: 'POST',
    data: $("form").serialize(),
    success:function(){
      window.location="";
    }
  })
}); 
</script>