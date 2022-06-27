<!-- Button trigger modal -->
<button type="button" class="{{$btn_class}}" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $id }}">
<i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modal-delete-{{ $id }}" tabindex="-1" aria-labelledby="moda-label-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="$modal-label-title-{{ $id }}">Excluir Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              Você tem certeza que deseja excluir esse item?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form action="{{ $route }}" method="post">
                @method('DELETE')
                @csrf
                <button id="btn-ok" type="submit" class="btn btn-primary">OK</button>
            </form>
        </div>
    </div>
  </div>
</div>
