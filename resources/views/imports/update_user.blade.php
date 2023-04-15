
<h1> Update Campus (Users) </h1>

<form action="{{route('import_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="uploadFile" id="uploadFile">
    <button type="submit">Enviar</button>
</form>