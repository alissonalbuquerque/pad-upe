{{--
    @include('components.buttons.btn-show-resolucao', [
        'content' => '',
        'btn_class' => '',
    ])

    @include('components.buttons.btn-show-resolucao', [
        'content' => 'Resolução',
        'btn_class' => 'show_resolucao',
    ])
--}}

<button class="btn btn-warning {{ $btn_class }}">
    <i class="bi bi-exclamation-circle"></i>
    {{ $content }}
</button>