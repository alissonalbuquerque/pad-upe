@extends('layouts.main')

<body>
    <header style="display: flex; direction: rtl">
    </header>

    <div style="display: flex; flex-direction: column; align-items: center;">
        <div>
            <h3 style="font-size: 30px;"> Cursos </h3>
        </div>

        <div>
            <table style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Campus</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach ($cursos as $curso)
                        <tr>
                            <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->name }}</td>
                            <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->campus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h3 style="font-size: 30px;"> Cursos </h3>
        </div>

        <div>
            <table style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Campus</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach ($cursos as $curso)
                        <tr>
                            <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->name }}</td>
                            <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->campus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h3 style="font-size: 30px;"> Cursos </h3>
        </div>

        <div>
            <table style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Campus</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach ($cursos as $curso)
                        <tr>
                            <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->name }}</td>
                            <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->campus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h3 style="font-size: 30px;"> Cursos </h3>
        </div>

        <div>
            <table style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Campus</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach ($cursos as $curso)
                        <tr>
                            <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->name }}</td>
                            <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">{{ $curso->campus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer style="padding-top: 0.75rem; margin-top: 0.75rem; text-align: center; border-top: 1px">
        Copyright &copy;2022. Universidade de Pernambuco - Todos os direitos reservados
    </footer>
</body>
