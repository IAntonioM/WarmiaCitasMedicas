
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addNewModalLabel">Registrar Usaurios</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="input-box"  action="{{route('registrarUsuario')}}" method="POST">
              @csrf
              <div class="row g-3">
              <div class="form-floating mb-3">
                <input
                  type="text" 
                  class="form-control @error('nombres')  border border-danger @enderror" 
                  name="nombres" 
                  id="nombres" 
                  placeholder="nombres"
                  value="{{old('nombres')}}"
                >
                <label class=" @error('nombres') text-danger @enderror" for="nombres">Nombres *</label>
                @error('nombres')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input 
                  type="text" 
                  class="form-control @error('apellidos')  border border-danger @enderror" 
                  name="apellidos" 
                  id="apellidos" 
                  placeholder="apellidos"
                  value="{{old('apellidos')}}"
                >
                <label class=" @error('apellidos') text-danger @enderror"  for="apellidos">Apellidos *</label>
                @error('apellidos')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input 
                  type="number" 
                  class="form-control @error('dni')  border border-danger @enderror" 
                  name="dni" 
                  id="dni" 
                  placeholder="dni"
                >
                <label class=" @error('dni') text-danger @enderror"  for="dni">DNI *</label>
                @error('dni')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <select class="form-select" name="cargo" id="cargo" required>
                  <option value="none">Seleccione...</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Medico">Medico</option>
                  <option value="Recepcionista">Recepcionista</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                  <select class="form-select" id="especialidad" name="especialidad" style="display: none;">
                    <option value="">Seleccione una especialidad</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                  </select>
              </div>
              
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password')  border border-danger @enderror" name="password" id="password" placeholder="Password">
                <label class=" @error('password') text-danger @enderror" for="password">Password *</label>
                @error('password')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Password">
                <label for="password_confirmation">Confirmar Password *</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary btn-login mb-2" type="submit">Registrar usuario</button>
             
            </form>
          </div>
      </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      // Escucha los cambios en el campo de cargo
      $('#cargo').change(function() {
          // Obtén el valor seleccionado
          var selectedCargo = $(this).val();

          // Si el cargo seleccionado es 'Medico', muestra el campo de especialidad
          if (selectedCargo === 'Medico') {
              $('#especialidad').show();
          } else {
              // Si no es 'Medico', oculta el campo de especialidad
              $('#especialidad').hide();
          }
      });
  });
</script>


