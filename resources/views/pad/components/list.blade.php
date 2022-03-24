<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Semestre</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($PADs as $pad)
            <tr>
                <th scope="row">{{ $pad->id }}</th>
                <td>{{ $pad->semestre }}</td>
                <td>
                    @include('components.devcomponents.btn-edit', [
                        'route' => route('pad_edit', ['id' => $pad->id]),
                    ])
                    @include('components.devcomponents.btn-delete', [
                        'route' => route('pad_delete', ['id' => $pad->id]),
                    ])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
