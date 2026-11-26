<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAZU — Perfil do Cidadão</title>

    <!-- Fonte Institucional (Public Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet & Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Public Sans', system-ui, -apple-system, sans-serif;
            background-color: #F8FAFC;
            color: #071D41;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sazu-topbar {
            background-color: #071D41;
            border-bottom: 4px solid #1351B4;
            color: #FFFFFF;
        }

        .sazu-brand-title {
            color: #FFFFFF;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .sazu-brand-sub {
            color: #CBD5E1;
            font-size: 0.75rem;
        }

        .sazu-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(7, 29, 65, 0.05);
        }

        .sazu-btn-primary {
            background-color: #1351B4;
            border-color: #1351B4;
            color: #FFFFFF;
            font-weight: 600;
        }

        .sazu-btn-primary:hover,
        .sazu-btn-primary:focus {
            background-color: #0C326F;
            border-color: #0C326F;
            color: #FFFFFF;
        }

        .ocorrencia-thumb {
            width: 120px;
            height: 84px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #CBD5E1;
        }

        .modal-img-preview {
            max-width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #CBD5E1;
        }

        #mapa-ocorrencias {
            height: 380px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #CBD5E1;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Barra Superior Institucional -->
    <header class="sazu-topbar py-3">
        <div class="container-fluid px-4 px-lg-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex flex-column">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <span class="sazu-brand-title fs-4 d-block">SAZU</span>
                    <span class="sazu-brand-sub d-block">Sistema de Auxílio à Zeladoria Urbana</span>
                </a>
                @foreach($cidadaos as $item)
                    <span class="badge bg-light text-dark mt-2 align-self-start fw-semibold">
                        Olá, {{ $item->nome }}
                    </span>
                @endforeach
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('ocorrencias.create') }}" class="btn btn-sm btn-warning fw-bold text-dark">
                    + Registrar ocorrência
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button class="btn btn-sm btn-outline-light fw-semibold" type="submit">
                        Sair da página
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="container py-4 flex-grow-1">
        <!-- Alertas de Sessão -->
        @if (Session::has('success'))
            <div class="alert alert-success fw-semibold mb-4" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('fail'))
            <div class="alert alert-danger fw-semibold mb-4" role="alert">
                {{ Session::get('fail') }}
            </div>
        @endif

        <!-- Mapa de Ocorrências -->
        <section class="sazu-card p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <h2 class="h5 fw-bold mb-1" style="color: #071D41;">Mapa de Ocorrências</h2>
                    <p class="text-secondary small mb-0">
                        Visualize os registros georreferenciados e clique nos marcadores para ver os detalhes.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2 small fw-semibold">
                    <span class="badge text-bg-danger">Alta prioridade</span>
                    <span class="badge text-bg-warning text-dark">Média prioridade</span>
                    <span class="badge text-bg-primary">Baixa prioridade</span>
                </div>
            </div>

            <div id="mapa-ocorrencias"></div>
        </section>

        <!-- Tabela de Ocorrências do Cidadão -->
        <section class="sazu-card overflow-hidden">
            <div class="p-4 border-bottom bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h2 class="h5 fw-bold mb-0" style="color: #071D41;">Minhas Ocorrências</h2>
                    <p class="text-secondary small mb-0 mt-1">
                        Acompanhe o status e os detalhes das solicitações registradas.
                    </p>
                </div>
                <a href="{{ route('ocorrencias.create') }}" class="btn sazu-btn-primary btn-sm px-3 py-2">
                    Registrar ocorrência
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">ID</th>
                            <th>Ocorrência</th>
                            <th>Situação</th>
                            <th>Prioridade</th>
                            <th>Foto</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($ocorrencias) > 0)
                            @foreach ($ocorrencias as $ocorrencia)
                                @php
                                    $temImagemRota = \Illuminate\Support\Facades\Route::has('ocorrencias.imagem');
                                    $urlImagemTabela = $temImagemRota
                                        ? route('ocorrencias.imagem', $ocorrencia->Id_reclamacao)
                                        : (!empty($ocorrencia->foto) ? asset('storage/' . $ocorrencia->foto) : null);
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">
                                        #{{ $ocorrencia->Id_reclamacao }}
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        {{ $ocorrencia->Tipo_ocorrencia }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary-subtle text-dark border fw-semibold">
                                            {{ $ocorrencia->situação ?? 'Não informada' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-info-subtle text-dark border fw-semibold">
                                            {{ $ocorrencia->prioridade_problema ?? 'Não informada' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($urlImagemTabela)
                                            <img
                                                src="{{ $urlImagemTabela }}"
                                                alt="Imagem da ocorrência"
                                                class="ocorrencia-thumb"
                                                onerror="this.style.display='none';"
                                            >
                                        @else
                                            <span class="text-muted small">Sem imagem</span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('ocorrencias.edit', $ocorrencia->Id_reclamacao) }}"
                                               class="btn sazu-btn-primary btn-sm">
                                                Mais informações
                                            </a>

                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm fw-semibold"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluir{{ $ocorrencia->Id_reclamacao }}">
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal de Confirmação de Exclusão -->
                                <div class="modal fade"
                                     id="modalExcluir{{ $ocorrencia->Id_reclamacao }}"
                                     tabindex="-1"
                                     aria-labelledby="modalLabel{{ $ocorrencia->Id_reclamacao }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger-subtle text-danger border-bottom">
                                                <h5 class="modal-title fw-bold" id="modalLabel{{ $ocorrencia->Id_reclamacao }}">
                                                    Confirmar Exclusão
                                                </h5>
                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Fechar">
                                                </button>
                                            </div>

                                            <div class="modal-body text-center py-4">
                                                @if (!empty($ocorrencia->foto))
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $ocorrencia->foto) }}"
                                                             alt="Imagem da ocorrência"
                                                             class="modal-img-preview"
                                                             onerror="this.style.display='none';">
                                                    </div>
                                                @endif

                                                <p class="fw-semibold text-dark mb-1">
                                                    Você tem certeza que deseja excluir a ocorrência:
                                                </p>
                                                <p class="fw-bold text-danger fs-6 mb-0">
                                                    {{ $ocorrencia->Tipo_ocorrencia }}
                                                </p>
                                            </div>

                                            <div class="modal-footer bg-light">
                                                <button type="button"
                                                        class="btn btn-secondary btn-sm fw-semibold"
                                                        data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>

                                                <form action="{{ route('ocorrencias.destroy', $ocorrencia->Id_reclamacao) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm fw-bold">
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
                                <td colspan="6" class="text-center py-5 text-secondary fw-medium">
                                    Nenhuma ocorrência encontrada!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Rodapé Institucional -->
    <footer class="py-3 px-4 text-center text-light small" style="background-color: #071D41;">
        <div class="container">
            <span class="fw-bold">SAZU — Sistema de Auxílio à Zeladoria Urbana</span>
            <span class="mx-2 text-secondary">|</span>
            <span class="text-secondary">Projeto Integrador de Engenharia da Computação — UNISO</span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const elementoMapa = document.getElementById('mapa-ocorrencias');

            if (!elementoMapa || typeof L === 'undefined') {
                return;
            }

            const mapa = L.map('mapa-ocorrencias').setView([-23.5015, -47.4526], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mapa);

            const ocorrencias = @json($ocorrenciasMapa ?? []);
            const rotaImagemBase = @json(\Illuminate\Support\Facades\Route::has('ocorrencias.imagem') ? route('ocorrencias.imagem', ['ocorrencia' => '__ID__']) : '');

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

                const prioridade = String(ocorrencia.prioridade_problema ?? '')
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .trim()
                    .toLowerCase();

                let corPonto = 'gray';
                if (prioridade.includes('alta')) {
                    corPonto = 'red';
                } else if (prioridade.includes('media')) {
                    corPonto = 'gold';
                } else if (prioridade.includes('baixa')) {
                    corPonto = 'blue';
                }

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

                const idOcorrencia = ocorrencia.id_reclamacao ?? ocorrencia.Id_reclamacao;
                let fotoHTML = '';

                if (ocorrencia.foto && idOcorrencia && rotaImagemBase) {
                    const caminhoFoto = rotaImagemBase.replace('__ID__', encodeURIComponent(idOcorrencia));
                    fotoHTML = `
                        <img
                            src="${escaparHTML(caminhoFoto)}"
                            alt="Foto da ocorrência"
                            style="width:100%; height:130px; object-fit:cover; display:block; border-radius:8px 8px 0 0;"
                            onerror="this.style.display='none';"
                        >
                    `;
                } else {
                    fotoHTML = `
                        <div style="height:90px; display:flex; align-items:center; justify-content:center; background:#F1F5F9; color:#475569; font-size:12px; font-weight:600;">
                            Foto não disponível
                        </div>
                    `;
                }

                let dataFormatada = 'Não informada';
                if (ocorrencia.data_ocorrencia) {
                    const data = String(ocorrencia.data_ocorrencia).split(' ')[0];
                    const partes = data.split('-');
                    dataFormatada = partes.length === 3 ? `${partes[2]}/${partes[1]}/${partes[0]}` : data;
                }

                const card = `
                    <div style="display:block; width:240px; max-width:100%; color:#0F172A; font-family:'Public Sans',Arial,sans-serif;">
                        ${fotoHTML}
                        <div style="padding:10px 12px; font-size:13px;">
                            <p style="margin:4px 0;"><strong>Tipo:</strong> ${escaparHTML(ocorrencia.Tipo_ocorrencia)}</p>
                            <p style="margin:4px 0;"><strong>Prioridade:</strong> ${escaparHTML(ocorrencia.prioridade_problema)}</p>
                            <p style="margin:4px 0;"><strong>Situação:</strong> ${escaparHTML(ocorrencia['situação'])}</p>
                            <p style="margin:4px 0;"><strong>Data:</strong> ${escaparHTML(dataFormatada)}</p>
                        </div>
                    </div>
                `;

                marcador.bindPopup(card, {
                    maxWidth: 250,
                    minWidth: 220
                });
            });
        });
    </script>
</body>
</html>