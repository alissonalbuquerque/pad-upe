{{--
    @include('components.modal', [
        'id' => '',
        'size' => '',
        'header' => '',
        'content' => '',
    ])
--}}

@php
    if(!isset($id)) {
        $id = 'modal';
    }

    if(!isset($size)) {
        $size = '';
    }

    if(!isset($header)) {
        $header = 'Modal';
    }

    if(!isset($title)) {
        $title = 'header';
    }

    if(!isset($content)) {
        $content = '';
    }
@endphp

<!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    <i class="bi bi-trash"></i>
</button> -->

<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="modal-label-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog {{ $size }}">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-label-title-header-{{ $id }}">{{ $header }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="{{ $id }}-content" class="modal-body">
            {{ $content }}
        </div>
    </div>
  </div>
</div>