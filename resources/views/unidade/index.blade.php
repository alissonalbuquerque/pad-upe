@extends('layouts.main')

@section('title', 'Unidade')

@section('body')

<div>
  @include('components.devcomponents.btn-create', ['route' => route('unidade_create')])
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Opções</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unidades as $unidade)
    <tr>
      <th scope="row">{{ $unidade->id}}</th>
      <td>{{ $unidade->name }}</td>
      <td>
        @include('components.devcomponents.btn-edit', ['route' => route('unidade_edit', ['id' => $unidade->id])])
        @include('components.devcomponents.btn-delete', ['route' => route('unidade_delete', ['id' => $unidade->id])])
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection