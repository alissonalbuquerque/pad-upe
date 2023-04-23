@php
    use App\Models\Campus;

    $campis = Campus::all();
@endphp

<h1> Update Campus (Users) </h1>

<form action="{{route('import_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="uploadFile" id="uploadFile">

    <select name="campus_id" id="campus_id">
        <option value="0"> Selecione </option>
        @foreach ($campis as $campus)
            <option value="{{$campus->id}}"> {{$campus->name}}</option>
        @endforeach
    </select>

    <button type="submit">Enviar</button>
</form>