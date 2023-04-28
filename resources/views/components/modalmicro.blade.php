<!-- basic modal -->
<div id="modal_micro" class="modal">
    <div class="modal-content-micro">
        <div class="row">
            <div class="col-11">
                <h2>Justificativa</h2>
            </div>
            <div class="col-1">
                <span id="fecharModal" class="close">&times;</span>
            </div>
        </div>
      <div class="modal-body-micro">
        <input type="hidden" name="id_user" id="id_user" class="form-control">
        <div class="row form-container">
          <div class="form-group col-12 mb-3">
            <label for="">Email:</label>
            <input type="text" name="email" id="email" class="form-control">
          </div>
          <div class="form-group col-12 mb-2">
            <label for="">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group col-12">
            <label for="">Justificativa</label>
            <textarea name="justificativa" id="justificativa" cols="30" rows="10" class="form-control">
                Aqui
            </textarea>
          </div>

          <div class="col-12 d-flex justify-content-end my-3">
            <span> <button class="btn btn-success" id="salvar" name="salvar">Salvar</button></span>
          </div>
        </div>
      </div>

    </div>
  </div>
