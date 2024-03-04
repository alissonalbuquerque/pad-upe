{{-- 
  @include('components.buttons.btn-delete-by-alert', [
    '_id' => '',
    '_class' => '',
    '_route' => route('')
  ])
--}}

<!-- Button trigger alert -->
<button type="button" id="{{ $_id }}" class="btn btn-danger {{$_class}}">
    <i class="bi bi-trash"></i>
</button>

<script>
  $('.{{$_class}}').click(function(e)
  {
      const _id = $(this).attr('id')
      const is_delete = confirm('Você tem certeza que deseja excluir esse item?')

      if(is_delete) {
        $('#form-delete-'+_id).submit()
      }
  })
</script>