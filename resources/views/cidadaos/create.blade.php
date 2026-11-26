<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">FAÇA SEU CADASTRO</h1>
            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 underline text-sm transition">Voltar</a>
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

         <form action="{{ route('cidadaos.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="60">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>

                <input type="text"
                    id="cpf"
                    name="CPF"
                    value="{{ old('CPF') }}"
                    placeholder="000.000.000-00"
                    maxlength="14"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Nascimento</label>
                <input type="date" id="title" name="data_nascimento" value="{{ old('data_nascimento') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone Celular</label>

                <input type="tel"
                    id="telefone"
                    name="telefone"
                    value="{{ old('telefone') }}"
                    placeholder="(15) 99999-9999"
                    maxlength="15"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">email</label>
                <input type="email" id="title" name="email" value="{{ old('email') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" maxlength="40">
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>

                <input type="text"
                    id="cep"
                    name="cep"
                    value="{{ old('cep') }}"
                    placeholder="00000-000"
                    maxlength="9"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">rua</label>
                <input type="text" id="rua" name="rua" value="{{ old('rua') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" readonly>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                <input type="text" id="bairro" name="Bairro" value="{{ old('Bairro') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" readonly>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">numero</label>
                <input type="text" id="title" name="numero" value="{{ old('numero') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition"  maxlength="7">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                <input type="text" id="cidade" name="Cidade" value="{{ old('Cidade') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none transition" readonly>
            </div>
            
            
            <div class="pt-2 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 shadow-sm">
                    Completar meu cadastro
                </button>
            </div>
        </form>

    </div>

    <script>
        const inputNome = document.querySelector("#nome");

        console.log(inputNome);

        inputNome.addEventListener("keydown", function(e) {

            if (e.key >= "0" && e.key <= "9") {
                e.preventDefault();
            }

        });
    </script>

    <script>
    const inputCPF = document.querySelector("#cpf");

    inputCPF.addEventListener("input", function() {

        let cpf = inputCPF.value;

        // Remove tudo que não for número
        cpf = cpf.replace(/\D/g, "");

        // Limita a 11 números
        cpf = cpf.substring(0, 11);

        // Adiciona os pontos e o hífen
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        inputCPF.value = cpf;

    });
    </script>

    <script>
    const inputTelefone = document.querySelector("#telefone");

    inputTelefone.addEventListener("input", function() {

        let telefone = inputTelefone.value;

        // Remove tudo que não for número
        telefone = telefone.replace(/\D/g, "");

        // Limita a 11 números
        telefone = telefone.substring(0, 11);

        // Adiciona os parênteses do DDD
        telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");

        // Adiciona o hífen
        telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");

        inputTelefone.value = telefone;

    });
    </script>

<script>

const inputCEP = document.querySelector("#cep");

inputCEP.addEventListener("input", function() {

    // Remove caracteres que não sejam números
    let cep = inputCEP.value.replace(/\D/g, "");

    // Limita a 8 números
    cep = cep.substring(0, 8);

    // Adiciona o hífen
    cep = cep.replace(/^(\d{5})(\d)/, "$1-$2");

    inputCEP.value = cep;

});

inputCEP.addEventListener("blur", function() {

    // Remove a formatação
    let cep = inputCEP.value.replace(/\D/g, "");

    // Verifica se possui 8 números
    if (cep.length !== 8) {
        return;
    }

    // Consulta a API ViaCEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(dados => {

            // Verifica se o CEP existe
            if (dados.erro) {
                alert("CEP não encontrado!");
                return;
            }

            // Preenche os campos automaticamente
            document.querySelector("#rua").value = dados.logradouro;
            document.querySelector("#bairro").value = dados.bairro;
            document.querySelector("#cidade").value = dados.localidade;

        })
        .catch(() => {
            alert("Erro ao consultar o CEP. Tente novamente.");
        });

});

</script>
</body>
</html>



</body>
</html>




