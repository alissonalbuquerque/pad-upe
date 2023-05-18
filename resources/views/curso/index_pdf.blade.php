{{-- @extends('layouts.main') --}}
<body>
    @section('header')
    @show

    <div class="flex items-center justify-center h-screen">
        <h3> Cursos </h3>

        <div>   
            <div class="border rounded px-4">
                <table class="table table-hover mt-4">
                    
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Campus</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        @foreach ($cursos as $curso)
                            <tr>
                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">{{ $curso->name }}</td>
                                <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000;">{{ $curso->campus }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="pt-3 my-3 text-center text-muted align-items-center border-top">
        Copyright &copy;2022. Universidade de Pernambuco - Todos os direitos reservados
    </footer>
</body>
