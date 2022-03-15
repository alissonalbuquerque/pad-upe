

@extends('layouts.main')

@section('title', 'Curso')

@section('body')
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Campus</th>
    </tr>
  </thead>
  <tbody>
    @foreach($cursos as $curso)
    <tr>
      <th scope="row">{{ $curso->id }}</th>
      <td>{{ $curso->name }}</td>
      <td>{{ $curso->campus }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
