<header style="display: flex; direction: rtl">
</header>

<div style="display: flex; flex-direction: column; gap: 4rem">
    @foreach ($data['model'] as $nome_dimensao=>$dimensao)
        <h1>{{$nome_dimensao}}</h1>
        <div>
        @foreach ($dimensao as $nome_categoria=>$categoria)
            <h3>{{$nome_categoria}}</h3>
            
            @foreach ($categoria as $item_name=>$item)
                <table style="border-radius: 5px; background-color: #F2F2F2;
                min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                    
                    <thead class="thead-dark">
                        <tr>
                            @foreach ($item as $value_name=>$value)
                                <th style="font-weight: 600; padding: 0.3rem 0.7rem 0.7rem 0.3rem" scope="col">
                                    {{$value_name}}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            @foreach ($item as $value_name=>$value)
                                <td style="border: 1px solid #000; vertical-align: middle; 
                                    padding: 0.3rem 0.5rem 0.5rem 0.3rem">
                                    {{$value}}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <div style="height: 3rem"></div>
            @endforeach
            <div style="height: 1.5rem"></div>
        @endforeach
        <table style="border-radius: 10px; background-color: #F2F2F2;
        min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        min-height: 50px;">
            
            <thead class="thead-dark">
                <tr>
                    <th style="text-align: center" scope="col">TOTAL DE HORAS</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; vertical-align: middle; text-align: center; 
                        padding: 0.3rem 0.5rem 0.5rem 0.3rem">
                        {{ $data['horas'][$nome_dimensao] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
</div>
