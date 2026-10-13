<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Numero</label>
                <input type="text" id="Numero" name="Numero" value="{{ old('Numero', $ocorrencia->Numero) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                <input type="text" id="bairro" name="bairro" value="{{ old('bairro', $ocorrencia->bairro) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" >
            </div>

            <!--3° FORM-->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                <input type="text" id="Cidade" name="Cidade" value="{{ old('Cidade', $ocorrencia->Cidade) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Situação</label>
                <input type="text" id="situação" name="situação" value="{{ old('situação', $ocorrencia->situação) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
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
        // Substitui a imagem atual pela nova imagem selecionada
        preview.src = URL.createObjectURL(arquivo);
        preview.classList.remove('hidden');
    }
});
</script>