{{-- 

  @include('components.buttons.btn-delete', [
    'id' => $id,
    'route' => route('')
  ])
  
--}}

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $id }}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modal-delete-{{ $id }}" tabindex="-1" aria-labelledby="moda-label-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-label-title-{{ $id }}">Excluir Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              Você tem certeza que deseja excluir esse item?
        </div>
        <div class="modal-footer">
            @include('components.buttons.btn-close_modal')
            <form action="{{ $route }}" method="post">
                @method('DELETE')
                @csrf
                
                @include('components.buttons.btn-save', [
                  'id' => 'btn-ok',
                  'content' => 'Excluir',
                ])
            </form>
        </div>
    </div>
  </div>
</div>
