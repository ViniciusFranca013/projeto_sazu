
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <title>Perfil Cidadão</title>
        <style>
            body{
                background-color: #f7f7f7;
            }
            .container{
		padding-top: 1cm;
	}

    .fonte-modal{
       font-family: Verdana, Geneva, Tahoma, sans-serif;
       padding-bottom: 12px;
    }

    .imagem-modal{
        padding-top: 18px;
        padding-bottom: 27px;
    }

    .palavra{
        color: red;
        }

		.modal .modal-dialog{
        width: 31,5%;
    }
    .navbar {
            width: 100%;
            height: 8%;
         
            background: #053b71;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        b{
            color: whitesmoke ;
            font-family: system-ui;
            font-size: 18px;
            font-weight: bold;
            margin-left: 8%;
        }
        </style>
    </head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <body>
     @foreach($cidadaos as $item)

        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">

                <!-- Logo / Nome -->
                <a class="navbar-brand ms-5" href="#">
                    Olá, {{ $item->nome }}
                </a>

                <!-- Botão à direita -->
                <div class="ms-auto me-5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            Sair da pagina
                        </button>
                    </form>
                </div>
            </div>
        </nav>
     @endforeach
    
       
            <!--<div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ocorrencias as $itens2)
                            <tr>
                                <td>{{$itens2->Tipo_ocorrencia}}</td>
                                <td>{{$itens2->Rua}}</td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
            -->

   <div class="container">

    <div class="card">

        <div class="card-header">

            Ocorrências

            <a href="{{ route('ocorrencias.create') }}"
               class="btn btn-primary btn-sm float-end">
                Registrar ocorrência
                <i class="fa-solid fa-plus"></i>
            </a>

            

        </div>

        @if (Session::has('success'))
            <span class="alert alert-success p-2">
                {{ Session::get('success') }}
            </span>
        @endif

        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">
                {{ Session::get('fail') }}
            </span>
        @endif

        <div class="card-body">

            <table class="table table-sm table-striped table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ocorrência</th>
                        <th>Situação</th>
                        <th>Prioridade</th>
                        <th>Data da ocorrência</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @if (count($ocorrencias) > 0)

                        @foreach ($ocorrencias as $ocorrencia)

                            <tr>

                                <td>
                                    {{ $ocorrencia->Id_reclamacao }}
                                </td>

                                <td>
                                    {{ $ocorrencia->Tipo_ocorrencia }}
                                </td>

                                <td>
                                    {{ $ocorrencia->situação }}
                                </td>

                                <td>
                                    {{ $ocorrencia->prioridade_problema }}
                                </td>

                                <td>
                                    {{ $ocorrencia->data_ocorrencia }}
                                </td>

                                <td>
                                    <a href="{{ route('ocorrencias.edit', $ocorrencia->Id_reclamacao) }}"
                                       class="btn btn-primary btn-sm">
                                        Editar
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>

                                <td>

                                    <button
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalExcluir{{ $ocorrencia->Id_reclamacao }}">
                                        Excluir
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </td>

                            </tr>

                            <!-- Modal -->

                            <div class="modal fade"
                                 id="modalExcluir{{ $ocorrencia->Id_reclamacao }}"
                                 tabindex="-1"
                                 aria-labelledby="modalLabel{{ $ocorrencia->Id_reclamacao }}"
                                 aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header alert-danger text-danger">

                                            <h1 class="modal-title fs-5"
                                                id="modalLabel{{ $ocorrencia->Id_reclamacao }}">
                                                Confirmar Exclusão
                                            </h1>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="imagem-modal text-center">
                                                <img src="/imagens/lixo.png"
                                                     style="width:128px;height:128px;">
                                            </div>

                                            <div class="fonte-modal text-center">

                                                <h6>
                                                    Você tem certeza que deseja excluir a ocorrência:
                                                </h6>

                                                <span class="palavra">
                                                    {{ $ocorrencia->Tipo_ocorrencia }}
                                                </span>?

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <form action="{{ route('ocorrencias.destroy', $ocorrencia->Id_reclamacao) }}"
                                                  method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger">
                                                    Excluir
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <tr>
                            <td colspan="7">
                                Nenhuma ocorrência encontrada!
                            </td>
                        </tr>

                    @endif

                </tbody>

            </table>

        </div>

    </div>

</div>
            

    </body>
</html>