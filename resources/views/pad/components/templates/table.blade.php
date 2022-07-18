<div class="border rounded px-4">

    <table class="table table-hover mt-4" id="{{$table_id}}">
        <thead>
            <tr>
                <!-- <th scole="col">#</th> -->
                @foreach($colunas as $coluna)
                    <th scole="col">{{ $coluna }}</th>
                @endforeach
            </tr>
        </thead>
        
        <tbody>
            <tr>
                    <!-- <th scole="col">#</th> -->
                    @foreach($colunas as $coluna)
                        <th scole="col">{{ $coluna }}</th>
                    @endforeach
                </tr>
        </tbody>
    </table>

</div>