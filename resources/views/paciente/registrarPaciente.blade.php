<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addNewModalLabel">Registrar Paciente</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{route('registrarPaciente')}}">
                  @csrf
                  <div class="row g-3">
                      <div class="col-sm-6">
                          <label for="nombres" class="form-label">Nombres *</label>
                          <input type="text" class="form-control" id="nombres" name="nombres" placeholder="" value="" required>
                      </div>

                      <div class="col-sm-6">
                          <label for="apellidos" class="form-label">Apellidos *</label>
                          <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" value="" required>
                      </div>

                      <div class="col-8">
                          <label for="fechaNacimiento" class="form-label">Fecha Nacimiento *</label>
                          <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="" required>
                      </div>
                      <div class="col-4">
                          <label for="dni" class="form-label">DNI *</label>
                          <input type="number" class="form-control" id="dni" name="dni" placeholder="">
                      </div>
                      <div class="col-7">
                          <label for="direccion" class="form-label">Dirección *</label>
                          <input type="text" class="form-control" id="direccion" name="direccion" placeholder="">
                      </div>
                      <div class="col-5">
                          <label for="telefono" class="form-label">Telefono *</label>
                          <input type="text" class="form-control" id="telefono" name="telefono" placeholder="">
                      </div>
                      <hr class="my-4">
                      <button class="btn btn-primary " type="submit">Registrar</button>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
      </div>
  </div>
</div>










