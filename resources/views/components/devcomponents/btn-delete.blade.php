
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">
    <i class="fas fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-label">Excluir Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir esse item?
      </div>
      <div class="modal-footer">
        <button id="btn-cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="{{$route}}" method="post">
          @method('DELETE')
          @csrf
          <button id="btn-ok" type="submit" class="btn btn-primary">OK</button>
        </form>
      </div>
    </div>
  </div>
</div>
