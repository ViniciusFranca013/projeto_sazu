<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar ocorrência</title>
   <style>
    .fonte-modal {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding-bottom: 12px;
    }
</style>

    <!-- Tailwind CSS que você já utiliza -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS: necessário para o modal -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Leaflet CSS que você já utiliza no mapa -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">

    <!--início do card-->
    <div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">REGISTRAR OCORRENCIA</h1>
            <a href="{{ route('cidadaos.index') }}" class="text-gray-600 hover:text-gray-900 underline text-sm transition">Voltar a página</a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ocorrencias.update', $ocorrencia) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--1° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Ocorrencia</label>
                <select type="text" id="title" name="Tipo_ocorrencia" value="{{ old('Tipo_ocorrencia') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Selecione uma opção</option>
                    <option value="Buraco na via" {{ old('Tipo_ocorrencia', $ocorrencia->Tipo_ocorrencia) == 'Buraco na via' ? 'selected' : '' }}>Buraco</option>
                    <option value="Queda de árvore" {{ old('Tipo_ocorrencia', $ocorrencia->Tipo_ocorrencia) == 'Queda de árvore' ? 'selected' : '' }}>Queda de árvore</option>
                    <option value="Luz do poste queimada" {{ old('Tipo_ocorrencia', $ocorrencia->Tipo_ocorrencia) == 'Luz do poste queimada' ? 'selected' : '' }}>Luz do poste queimada</option>
                    <option value="Acumulo de Lixo" {{ old('Tipo_ocorrencia', $ocorrencia->Tipo_ocorrencia) == 'Acumulo de Lixo' ? 'selected' : '' }}>Acumulo de lixo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <input type="text" id="descrição_problema" name="descricao_problema" value="{{ old('descrição_problema', $ocorrencia->descricao_problema) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
                <select type="text" id="prioridade_problema" name="prioridade_problema" value="{{ old('prioridade_problema', $ocorrencia->prioridade_problema) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">Selecione uma opção</option>
                        <option value="Baixa" {{ old('prioridade_problema',$ocorrencia->prioridade_problema) == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="Media" {{ old('prioridade_problema',$ocorrencia->prioridade_problema) == 'Media' ? 'selected' : '' }}>Média</option>
                         <option value="Alta" {{ old('prioridade_problema',$ocorrencia->prioridade_problema) == 'Alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                <input type="text" id="CEP" name="CEP" value="{{ old('CEP', $ocorrencia->CEP) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="9">
            </div>
            

            <!--2° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rua</label>
                <input type="text" id="title" name="Rua" value="{{ old('Rua', $ocorrencia->Rua) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Numero</label>
                <input type="text" id="Numero" name="Numero" value="{{ old('Numero', $ocorrencia->Numero) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                <input type="text" id="bairro" name="bairro" value="{{ old('bairro', $ocorrencia->bairro) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>

            <!--3° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                <input type="text" id="Cidade" name="Cidade" value="{{ old('Cidade', $ocorrencia->Cidade) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Situação</label>
                <input type="text" id="situação" name="situação" value="{{ old('situação', $ocorrencia->situação) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>

            {{-- MAPA DE LOCALIZAÇÃO DA OCORRÊNCIA --}}
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Localização da ocorrência
                    </label>

                    <p class="text-sm text-gray-500 mb-3">
                        Arraste o marcador para corrigir a localização, se necessário.
                    </p>

                    <div id="map" style="height: 350px; width: 100%;"></div>

                    {{-- Coordenadas atuais da ocorrência --}}
                    <input type="hidden" id="latitude" name="latitude"
                        value="{{ old('latitude', $ocorrencia->latitude) }}">

                    <input type="hidden" id="longitude" name="longitude"
                        value="{{ old('longitude', $ocorrencia->longitude) }}">
                </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    FOTO DA OCORRÊNCIA
                </label>

                {{-- Selecionar uma nova foto --}}
                <input type="file" id="FOTO" name="foto"
                    accept="image/jpeg,image/png,image/webp"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md">

                {{-- ÚNICA área de pré-visualização --}}
                <div class="mt-3">
                    <img
                        id="preview-foto"
                        src="{{ $ocorrencia->foto ? asset('storage/' . $ocorrencia->foto) : '' }}"
                        alt="Pré-visualização da foto da ocorrência"
                        class="{{ $ocorrencia->foto ? '' : 'hidden' }} w-64 h-48 object-cover rounded-lg border border-gray-300"
                    >
                </div>
            </div>
            
             <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data</label>
                <input type="date" id="data_ocorrencia" name="data_ocorrencia" value="{{ old('data_ocorrencia', $ocorrencia->data_ocorrencia) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>
             
            <div class="pt-2 flex justify-end gap-3">
                
                <button
                    type="button"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalExcluir{{ $ocorrencia->Id_reclamacao }}">
                    Excluir
                    <i class="fa-solid fa-trash"></i>
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 shadow-sm">
                    Atualizar
                </button>
            </div>
        </form>
    </div>

    {{-- MODAL DE CONFIRMAÇÃO DE EXCLUSÃO --}}
    {{-- Deve ficar fora do formulário de edição para não aninhar formulários --}}
    <div
        class="modal fade"
        id="modalExcluir{{ $ocorrencia->Id_reclamacao }}"
        tabindex="-1"
        aria-labelledby="modalLabel{{ $ocorrencia->Id_reclamacao }}"
        aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                {{-- Cabeçalho do modal --}}
                <div class="modal-header alert-danger text-danger">
                    <h1
                        class="modal-title fs-5"
                        id="modalLabel{{ $ocorrencia->Id_reclamacao }}">
                        Confirmar exclusão
                    </h1>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fechar">
                    </button>
                </div>

                {{-- Mensagem de confirmação --}}
                <div class="modal-body">
                    <div class="text-center mb-3">
                        @if ($ocorrencia->foto)
                            <img
                                src="{{ asset('storage/' . $ocorrencia->foto) }}"
                                alt="Foto da ocorrência"
                                style="width: 350px; height: 250px; object-fit: contain; border-radius: 8px; display: block; margin: 0 auto;">
                        @endif
                    </div>

                    <div class="fonte-modal text-center">
                        <p>Tem certeza de que deseja excluir esta ocorrência?</p>

                        <strong class="text-danger">
                            {{ $ocorrencia->Tipo_ocorrencia }}
                        </strong>
                    </div>
                </div>

                {{-- Botões do modal --}}
                <div class="modal-footer">

                    {{-- Fecha o modal sem excluir --}}
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    {{-- Formulário que realmente exclui a ocorrência --}}
                    <form
                        action="{{ route('ocorrencias.destroy', $ocorrencia->Id_reclamacao) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Confirmar exclusão
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS: necessário para abrir e fechar o modal --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
document.getElementById('FOTO').addEventListener('change', function(event) {
    const arquivo = event.target.files[0];
    const preview = document.getElementById('preview-foto');

    if (arquivo && arquivo.type.startsWith('image/')) {
        // Substitui a imagem atual pela nova imagem selecionada
        preview.src = URL.createObjectURL(arquivo);
        preview.classList.remove('hidden');
    }
});
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const campoLatitude = document.getElementById('latitude');
    const campoLongitude = document.getElementById('longitude');

    // Usa as coordenadas salvas na ocorrência.
    // Se não existirem, centraliza inicialmente em Sorocaba.
    const latitudeSalva = parseFloat(campoLatitude.value);
    const longitudeSalva = parseFloat(campoLongitude.value);

    const coordenadasValidas =
        campoLatitude.value.trim() !== '' &&
        campoLongitude.value.trim() !== '' &&
        Number.isFinite(latitudeSalva) &&
        Number.isFinite(longitudeSalva) &&
        latitudeSalva >= -90 && latitudeSalva <= 90 &&
        longitudeSalva >= -180 && longitudeSalva <= 180;

    const latitudeInicial = coordenadasValidas ? latitudeSalva : -23.5015;
    const longitudeInicial = coordenadasValidas ? longitudeSalva : -47.4526;

    // Cria o mapa
    const mapa = L.map('map').setView(
        [latitudeInicial, longitudeInicial],
        16
    );

    // Carrega o mapa do OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(mapa);

    // Cria um marcador que pode ser arrastado
    const marcador = L.marker(
        [latitudeInicial, longitudeInicial],
        { draggable: true }
    ).addTo(mapa);

    // Atualiza os campos ocultos com as coordenadas do marcador
    function atualizarCoordenadas(latlng) {
        campoLatitude.value = latlng.lat.toFixed(7);
        campoLongitude.value = latlng.lng.toFixed(7);
    }

    atualizarCoordenadas(marcador.getLatLng());

    // Atualiza as coordenadas quando o usuário move o marcador
    marcador.on('dragend', function () {
        atualizarCoordenadas(marcador.getLatLng());
    });

    // Corrige a exibição do mapa se ele estiver dentro de uma área
    // que inicialmente estava oculta ou acabou de ser exibida.
    setTimeout(function () {
        mapa.invalidateSize();
    }, 100);
});
</script>
