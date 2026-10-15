<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

        <form action="{{ route('ocorrencias.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <!--1° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Ocorrencia</label>
                <select type="text" id="title" name="Tipo_ocorrencia" value="{{ old('Tipo_ocorrencia') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Selecione uma opção</option>
                    <option value="Buraco na via" {{ old('Tipo_ocorrencia') == 'Buraco' ? 'selected' : '' }}>Buraco</option>
                    <option value="Queda de árvore" {{ old('Tipo_ocorrencia') == 'Queda de árvore' ? 'selected' : '' }}>Queda de árvore</option>
                    <option value="Luz do poste queimada" {{ old('Tipo_ocorrencia') == 'Luz do poste queimada' ? 'selected' : '' }}>Luz do poste queimada</option>
                    <option value="Acumulo de Lixo" {{ old('Tipo_ocorrencia') == 'Acumulo de Lixo' ? 'selected' : '' }}>Acumulo de lixo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <input type="text" id="descrição_problema" name="descricao_problema" value="{{ old('descrição_problema') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
                <select type="text" id="prioridade_problema" name="prioridade_problema" value="{{ old('prioridade_problema') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">Selecione uma opção</option>
                        <option value="Baixa" {{ old('prioridade_problema') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="Media" {{ old('prioridade_problema') == 'Media' ? 'selected' : '' }}>Média</option>
                         <option value="Alta" {{ old('prioridade_problema') == 'Alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                <input type="text" id="CEP" name="CEP" value="{{ old('CEP') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="9">
            </div>
            

            <!--2° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rua</label>
                <input type="text" id="logradouro" name="Rua" value="{{ old('Rua') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"readonly>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Numero</label>
                <input type="text" id="Numero" name="Numero" value="{{ old('Numero') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" readonly >
            </div>

            <!--3° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                <input type="text" id="localidade" name="Cidade" value="{{ old('Cidade') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" readonly>
            </div>
            <!--
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Situação</label>
                <input type="text" id="situação" name="situação" value="{{ old('situação') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            -->

            <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Localização da ocorrência
                    </label>

                <button type="button"
                        id="btn-localizar"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Obter minha localização pelo GPS
                </button>

                <p id="status-localizacao" class="mt-2 text-sm text-gray-600">
                    Clique no botão para informar a localização.
                </p>

                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

            </div>
                <!-- FIM DA LOCALIZAÇÃO GPS -->
                <!-- MAPA PARA CONFIRMAR A LOCALIZAÇÃO -->

                <div id="mapa-cadastro-ocorrencia"
                    style="height: 350px; width: 100%; border-radius: 8px; margin-top: 15px;">
                </div>

                <p class="mt-2 text-sm text-gray-600">
                    Arraste o marcador ou clique no mapa para ajustar o local da ocorrência.
                </p>
            <!-- FIM DO MAPA -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    FOTO
                </label>

                <input
                    type="file"
                    id="FOTO"
                    name="foto"
                    required
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >

                <!-- ALTERADO: pré-visualização da foto -->
                <div class="mt-3">
                    <img
                        id="preview-foto"
                        src=""
                        alt="Pré-visualização da foto selecionada"
                        class="hidden w-64 h-48 object-cover rounded-lg border border-gray-300 shadow-sm"
                    >
                </div>
            </div>
            
             <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data</label>
                <input type="date" id="data_ocorrencia" name="data_ocorrencia" value="{{ old('data_ocorrencia') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
             
            <div class="pt-2 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 shadow-sm">
                    Enviar
                </button>
            </div>
        </form>
    </div>
    <!--fim do card-->
   
</body>
</html>

<script>
    document.getElementById('FOTO').addEventListener('change', function(event) {
        const arquivo = event.target.files[0];
        const preview = document.getElementById('preview-foto');

        if (arquivo && arquivo.type.startsWith('image/')) {
            preview.src = URL.createObjectURL(arquivo);
            preview.classList.remove('hidden');
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    });
</script>

<script>
document.getElementById('CEP').addEventListener('blur', async function () {
    // Remove pontos, traços e outros caracteres
    const cep = this.value.replace(/\D/g, '');

    // Verifica se o CEP tem 8 números
    if (cep.length !== 8) {
        return;
    }

    try {
        const resposta = await fetch(
            `https://viacep.com.br/ws/${cep}/json/`
        );

        const dados = await resposta.json();

        // Verifica se o CEP existe
        if (dados.erro) {
            alert('CEP não encontrado.');
            return;
        }

        // Preenche os campos do seu formulário
        document.getElementById('logradouro').value = dados.logradouro || '';
        document.getElementById('bairro').value = dados.bairro || '';
        document.getElementById('localidade').value = dados.localidade || '';

    } catch (erro) {
        alert('Erro ao consultar o CEP. Verifique sua conexão.');
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const botao = document.getElementById('btn-localizar');
    const status = document.getElementById('status-localizacao');
    const campoLatitude = document.getElementById('latitude');
    const campoLongitude = document.getElementById('longitude');
    const elementoMapa = document.getElementById('mapa-cadastro-ocorrencia');

    if (!elementoMapa || typeof L === 'undefined') {
        if (status) {
            status.textContent = 'Não foi possível carregar o mapa. Verifique sua conexão.';
        }
        return;
    }

    // Centralização inicial: Sorocaba
    const mapa = L.map(elementoMapa).setView([-23.5015, -47.4526], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(mapa);

    let marcador = null;

    // Atualiza o marcador e os campos que serão enviados ao Laravel
    function definirLocalizacao(lat, lng) {
        campoLatitude.value = lat.toFixed(7);
        campoLongitude.value = lng.toFixed(7);

        if (marcador) {
            marcador.setLatLng([lat, lng]);
        } else {
            marcador = L.marker([lat, lng], {
                draggable: true
            }).addTo(mapa);

            marcador.on('dragend', function () {
                const ponto = marcador.getLatLng();

                campoLatitude.value = ponto.lat.toFixed(7);
                campoLongitude.value = ponto.lng.toFixed(7);

                status.textContent = 'Local ajustado. Confira o ponto antes de cadastrar.';
            });
        }

        status.textContent = 'Local selecionado. Você pode arrastar o marcador ou clicar no mapa para ajustar.';

        mapa.panTo([lat, lng]);
    }

    // Clicar em qualquer lugar do mapa reposiciona o marcador
    mapa.on('click', function (evento) {
        definirLocalizacao(evento.latlng.lat, evento.latlng.lng);
    });

    // Solicitar a localização do dispositivo
    if (botao) {
        botao.addEventListener('click', function () {
            if (!navigator.geolocation) {
                status.textContent = 'Seu navegador não oferece suporte à localização.';
                return;
            }

            status.textContent = 'Obtendo localização...';
            botao.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function (posicao) {
                    definirLocalizacao(
                        posicao.coords.latitude,
                        posicao.coords.longitude
                    );

                    mapa.setZoom(17);
                    botao.disabled = false;
                },
                function (erro) {
                    const mensagens = {
                        1: 'Permissão negada. Autorize a localização no navegador.',
                        2: 'Não foi possível determinar a localização.',
                        3: 'Tempo esgotado. Tente novamente.'
                    };

                    status.textContent =
                        mensagens[erro.code] || 'Erro ao obter a localização.';

                    botao.disabled = false;
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        });
    }

    // Corrige a renderização caso o mapa seja inicializado em um contêiner ainda não visível
    setTimeout(function () {
        mapa.invalidateSize();
    }, 200);
});
</script>