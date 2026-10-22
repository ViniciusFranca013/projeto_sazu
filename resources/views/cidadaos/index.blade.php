
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
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

        figure{
           width: 180px; height: 140px; object-fit: cover; border-radius: 8px;
            
        }
        </style>
    </head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <body>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
            <!-- MAPA DE OCORRÊNCIAS -->

            <div class="mb-4">
                <h5 class="mb-3">Mapa de ocorrências</h5>

            <div id="mapa-ocorrencias"
                style="height: 400px; width: 100%; border-radius: 8px; background-color: lightgray;">
            </div>

            </div>
            <!-- FIM DO MAPA DE OCORRÊNCIAS -->

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
                                    <figure>
                                        <img src="{{ asset("storage/{$ocorrencia->foto}") }}" alt="[imagem]">
                                    </figure>
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
                                                <img src="{{ asset("storage/{$ocorrencia->foto}") }}" alt="[imagem]">
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elementoMapa = document.getElementById('mapa-ocorrencias');

        if (!elementoMapa) {
            return;
        }

        const mapa = L.map('mapa-ocorrencias')
            .setView([-23.5015, -47.4526], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(mapa);

        // Ocorrências recebidas do Controller
        const ocorrencias = @json($ocorrenciasMapa ?? []);

        // Base pública das imagens armazenadas no Laravel
        const caminhoFotos = @json(asset('storage'));

        // NOVO: protege os textos exibidos dentro do card
        function escaparHTML(valor) {
            return String(valor ?? 'Não informado').replace(/[&<>"']/g, function (caractere) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[caractere];
            });
        }

        ocorrencias.forEach(function (ocorrencia) {
            const latitude = Number(ocorrencia.latitude);
            const longitude = Number(ocorrencia.longitude);

            if (
                !Number.isFinite(latitude) ||
                !Number.isFinite(longitude) ||
                latitude < -90 || latitude > 90 ||
                longitude < -180 || longitude > 180 ||
                (latitude === 0 && longitude === 0)
            ) {
                return;
            }

           // const marcador = L.marker([latitude, longitude]).addTo(mapa);
           
            // NOVO: definir a cor conforme a prioridade
            
            // NOVO: identificar a prioridade da ocorrência
            const prioridade = String(
                ocorrencia.prioridade_problema ?? ''
            )
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .trim()
                .toLowerCase();

            // NOVO: escolher a cor conforme a prioridade
            let corPonto = 'gray';

            if (prioridade.includes('alta')) {
                corPonto = 'red';
            } else if (prioridade.includes('media')) {
                corPonto = 'gold';
            } else if (prioridade.includes('baixa')) {
                corPonto = 'blue';
            }
            // NOVO: marcador laranja vivo para prioridade Alta
            const marcadorLaranja = `
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="41" viewBox="0 0 25 41">
                    <path d="M12.5 0C5.6 0 0 5.6 0 12.5C0 21.5 12.5 41 12.5 41S25 21.5 25 12.5C25 5.6 19.4 0 12.5 0Z"
                        fill="#FF8C00" stroke="#FFFFFF" stroke-width="1.5"/>
                    <circle cx="12.5" cy="12.5" r="4" fill="#FFFFFF"/>
                </svg>
            `;

            // Marcador original do Leaflet, preservando seu formato
            const marcador = L.marker([latitude, longitude], {
                icon: L.icon({
                    iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${corPonto}.png`,
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(mapa);



            // Monta o endereço
            const endereco = [
                ocorrencia.Rua,
                ocorrencia.Numero,
                ocorrencia.bairro,
                ocorrencia.Cidade
            ].filter(Boolean).join(', ');

            // NOVO: monta o caminho da foto
            let fotoHTML = '';

            if (ocorrencia.foto) {
                const caminhoFoto = caminhoFotos + '/' +
                    String(ocorrencia.foto)
                        .replace(/^\/+/, '')
                        .split('/')
                        .map(parte => encodeURIComponent(parte))
                        .join('/');

                fotoHTML = `
                    <img
                        src="${escaparHTML(caminhoFoto)}"
                        alt="Foto da ocorrência"
                        style="width:100%; height:130px; object-fit:cover;
                               display:block; border-radius:8px 8px 0 0;"
                        onerror="this.style.display='none';"
                    >
                `;
            } else {
                fotoHTML = `
                    <div style="height:100px; display:flex; align-items:center;
                                justify-content:center; background:#f1f1f1;">
                        Foto não disponível
                    </div>
                `;
            }

            // NOVO: formata a data para o padrão brasileiro
            let dataFormatada = 'Não informada';

            if (ocorrencia.data_ocorrencia) {
                const data = String(ocorrencia.data_ocorrencia).split(' ')[0];
                const partes = data.split('-');

                if (partes.length === 3) {
                    dataFormatada = `${partes[2]}/${partes[1]}/${partes[0]}`;
                } else {
                    dataFormatada = data;
                }
            }

            // NOVO: cria o card com a foto e as informações
            
                const card = `
                    <a href="/ocorrencias/${encodeURIComponent(ocorrencia.id_reclamacao)}"
                    style="display:block; width:260px; max-width:100%;
                            color:#212529; text-decoration:none; font-family:Arial,sans-serif;">

                        ${fotoHTML}

                        <div style="padding:12px;">
                            <p style="margin:5px 0;">
                                <strong>Tipo:</strong>
                                ${escaparHTML(ocorrencia.Tipo_ocorrencia)}
                            </p>

                            <p style="margin:5px 0;">
                                <strong>Prioridade:</strong>
                                ${escaparHTML(ocorrencia.prioridade_problema)}
                            </p>

                            <p style="margin:5px 0;">
                                <strong>Situação:</strong>
                                ${escaparHTML(ocorrencia['situação'])}
                            </p>

                            <p style="margin:5px 0;">
                                <strong>Data:</strong>
                                ${escaparHTML(dataFormatada)}
                            </p>

                            <div style="margin-top:12px; padding-top:10px;
                                        border-top:1px solid #ddd; color:#0d6efd;
                                        font-weight:bold; text-align:center;">
                                Clique para ver a ocorrência completa →
                            </div>
                        </div>
                    </a>
                `;


            marcador.bindPopup(card, {
                maxWidth: 240,
                 minWidth: 220
            });
        });
    });
</script>
