<!--<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Index cidadao</title>
    <meta charset="utf-8">
  </head>
  <style>
    
  </style>
  <body>


     @foreach ($cidadaos as $item)
     Olá {{ $item->fk_usuario }}, Seja bem vinda
     @endforeach

    <br>
    <button type="button">Cadastrar ocorrência</button>
      


    </h1>
  </body>
</html>-->

<!--
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Manage Posts</h1>
            <a href="{{ route('ocorrencias.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200 shadow-sm">
                Create New Post
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($ocorrencias as $ocorrencia)
                    <tr class="hover:bg-gray-50 transition duration-150">
                    
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $ocorrencia->status === 'publish' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($ocorrencia->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('ocorrencias.show', $ocorrencia) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">View</a>
                            <a href="{{ route('ocorrencias.edit', $ocorrencia) }}" class="inline-flex items-center px-3 py-1.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none transition ease-in-out duration-150 shadow-sm">Edit</a>
                            <form action="{{ route('ocorrencias.destroy', $ocorrencia) }}" method="POST" class="inline-block m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No ocorrencias found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $ocorrencias->links() }}
        </div>
    </div>
    <div class="mt-8 mb-6 text-center text-sm text-gray-500">
        <a href="https://qadrlabs.com" class="text-blue-600 hover:text-blue-800 hover:underline transition" target="_blank">Tutorial CRUD Laravel 13 at qadrlabs.com</a>
    </div>
</body>
</html>-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
    <link rel="shortcut icon"  href="{{ asset('icones/apollo_icone.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.css') }}">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .content {
            text-align: center;
        }
        .content h1 {
            margin-top: 0;
        }
        .content p {
            font-size: 1.2em;
        }
        .button-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        button {
            background-color: transparent;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            text-decoration: underline;
        }
        .custom-img-size {
            width: 190px;
            height: auto;
        }
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }
        .navbar {
            width: 100%;
            height: 8%;
            position: fixed;
            background: #053b71;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="ms-2">
            {{ __('Sair') }}
            <i class="bi bi-box-arrow-right"></i>
        </button>
        </form>
        <label for="check" class="menu">
            <img src="/imagens/logo_branca.png" class="me-5" width="110px">
        </label>
    </div>
    <div class="main">
        <div class="content">
            <h1>ÁREA DO ALUNO</h1>
            <!--<p>Escolha uma opção abaixo para acessar os formulários:</p>-->
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="card text-center" style="cursor: pointer;" onclick="window.location.href='{{ url('/aluno/perfil') }}'">
                        <div class="card-body" style="background-color: #06447a; border-radius: 5px 5px 0 0;">
                            <h5 class="card-title text-white fw-bold">Perfil</h5>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                            <img src="{{ asset('icones/perfil.svg') }}" class="card-img-top custom-img-size" alt="Perfil">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center" style="cursor: pointer;" onclick="window.location.href='{{ url('/aluno/boletim') }}'">
                        <div class="card-body" style="background-color: #06447a; border-radius: 5px 5px 0 0;">
                            <h5 class="card-title text-white fw-bold">Boletim</h5>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                            <img src="{{ asset('icones/boletim.svg') }}" class="card-img-top custom-img-size" alt="Boletim">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center" style="cursor: pointer;" onclick="window.location.href='{{ url('/aluno/professores') }}'">
                        <div class="card-body" style="background-color: #06447a; border-radius: 5px 5px 0 0;">
                            <h5 class="card-title text-white fw-bold">Professores</h5>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                            <img src="{{ asset('icones/professores.svg') }}" class="card-img-top custom-img-size" alt="Professores">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    </form>
</body>
</html>