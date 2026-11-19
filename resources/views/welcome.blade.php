<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAZU - Sistema de Auxílio à Zeladoria Urbana</title>

    <!-- Fonte Institucional (Padrão Gov.br: Public Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite / Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Public Sans', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#071D41] antialiased min-h-screen flex flex-col">

    <!-- Cabeçalho Principal -->
    <header class="bg-white shadow-sm border-b-4 border-[#1351B4] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap justify-between items-center gap-4">
            
            <!-- Identidade Visual SAZU -->
            <div>
                <span class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#071D41] block leading-none">
                    SAZU
                </span>
                <span class="text-xs sm:text-sm text-slate-600 font-medium block mt-1">
                    Sistema de Auxílio à Zeladoria Urbana
                </span>
            </div>

            <!-- Botões de Acesso (Responsivos) -->
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 bg-[#1351B4] hover:bg-[#0C326F] text-white font-semibold text-sm px-5 py-2.5 rounded-full shadow-sm transition">
                        Painel do Cidadão
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-[#1351B4] hover:bg-blue-50 font-semibold text-sm px-4 py-2.5 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Entrar
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-[#1351B4] hover:bg-[#0C326F] text-white font-semibold text-sm px-5 py-2.5 rounded-full shadow-sm transition">
                            Cadastrar-se
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <!-- Seção Principal (Hero Banner Institucional) -->
    <main class="flex-grow">
        <section class="bg-gradient-to-b from-[#071D41] to-[#1351B4] text-white py-12 lg:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- Coluna de Texto e Ação -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 px-3 py-1 rounded-full text-xs font-semibold tracking-wide text-[#FFCD07]">
                            <span>SERVIÇO PÚBLICO DIGITAL</span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">
                            Zeladoria urbana rápida, transparente e conectada com o cidadão.
                        </h1>

                        <p class="text-blue-100 text-base sm:text-lg leading-relaxed max-w-2xl">
                            O <strong>SAZU</strong> permite que você registre solicitações de manutenção na sua rua — como pavimentação, iluminação pública, limpeza e calçadas — e acompanhe o protocolo até a conclusão.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex justify-center items-center gap-2 bg-[#FFCD07] hover:bg-amber-400 text-[#071D41] font-bold px-6 py-3.5 rounded-md shadow-md transition text-base">
                                    Registrar Nova Ocorrência
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex justify-center items-center gap-2 bg-[#FFCD07] hover:bg-amber-400 text-[#071D41] font-bold px-6 py-3.5 rounded-md shadow-md transition text-base">
                                    Registrar Ocorrência Agora
                                </a>
                                <a href="{{ route('register') }}" class="inline-flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-6 py-3.5 rounded-md transition text-base">
                                    Criar Conta de Cidadão
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Coluna de Espaço Reservado / Cartão Institucional -->
                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-lg p-3 shadow-xl border border-slate-200 text-[#071D41]">
                            <div class="w-full h-56 sm:h-64 rounded-md border-2 border-dashed border-slate-300 bg-slate-50 flex flex-col items-center justify-center p-6 text-center">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#1351B4] bg-blue-50 px-3 py-1 rounded-full mb-3">
                                    Identidade Local
                                </span>
                                <p class="text-sm sm:text-base font-semibold text-slate-700 max-w-xs">
                                    Espaço reservado a imagem da respectiva prefeitura da cidade
                                </p>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between text-xs font-semibold text-[#168821] uppercase tracking-wider mb-1">
                                    <span>Atendimento 24h via Web</span>
                                    <span>100% Digital</span>
                                </div>
                                <h2 class="font-bold text-lg text-[#071D41]">Central de Atendimento ao Cidadão</h2>
                                <p class="text-sm text-slate-600 mt-1">
                                    Suas demandas são encaminhadas diretamente às equipes técnicas de manutenção urbana.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Seção de Serviços Mais Acessados (Grid Responsivo) -->
        <section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-[#071D41]">Serviços de Zeladoria Disponíveis</h2>
                <p class="text-slate-600 text-sm sm:text-base mt-1">
                    Exemplos do que pode ser reportado no sistema após acessar sua conta para abrir um chamado técnico.
                </p>
            </div>

            <!-- Grid: 1 coluna em telas pequenas, 2 em tablets, 3 em desktops -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-[#1351B4] transition flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-md bg-blue-50 text-[#1351B4] flex items-center justify-center font-bold mb-4">
                            01
                        </div>
                        <h3 class="text-lg font-bold text-[#071D41] mb-2">Pavimentação e Vias</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Solicite reparos de buracos no asfalto, afundamento de pista, guias quebradas ou manutenção em calçadas públicas.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs font-semibold text-[#1351B4]">
                        Atendimento Prioritário &rarr;
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-[#1351B4] transition flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-md bg-blue-50 text-[#1351B4] flex items-center justify-center font-bold mb-4">
                            02
                        </div>
                        <h3 class="text-lg font-bold text-[#071D41] mb-2">Iluminação e Sinalização</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Reporte lâmpadas queimadas em postes, fiação exposta, placas de trânsito danificadas ou semáforos com falha.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs font-semibold text-[#1351B4]">
                        Segurança Viária &rarr;
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-[#1351B4] transition flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-md bg-blue-50 text-[#1351B4] flex items-center justify-center font-bold mb-4">
                            03
                        </div>
                        <h3 class="text-lg font-bold text-[#071D41] mb-2">Limpeza e Áreas Verdes</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Comunique descarte irregular de entulho, necessidade de capinação, poda preventiva de árvores ou limpeza de bueiros.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs font-semibold text-[#1351B4]">
                        Meio Ambiente Urbano &rarr;
                    </div>
                </div>

            </div>
        </section>

        <!-- Passo a Passo Institucional -->
        <section class="bg-white border-t border-b border-slate-200 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl font-bold text-[#071D41] mb-8 text-center">Como funciona o atendimento pelo SAZU</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-4">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#1351B4] text-white font-bold flex items-center justify-center text-lg mb-3">1</div>
                        <h3 class="font-bold text-[#071D41] mb-1">Identificação</h3>
                        <p class="text-sm text-slate-600">Acesse sua conta ou faça seu cadastro rápido para garantir a autenticidade do chamado.</p>
                    </div>
                    <div class="p-4">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#1351B4] text-white font-bold flex items-center justify-center text-lg mb-3">2</div>
                        <h3 class="font-bold text-[#071D41] mb-1">Registro da Ocorrência</h3>
                        <p class="text-sm text-slate-600">Informe o endereço, descreva a situação encontrada e envie os detalhes pelo sistema.</p>
                    </div>
                    <div class="p-4">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#168821] text-white font-bold flex items-center justify-center text-lg mb-3">3</div>
                        <h3 class="font-bold text-[#071D41] mb-1">Acompanhamento</h3>
                        <p class="text-sm text-slate-600">Consulte o andamento e as atualizações da equipe responsável diretamente no seu painel.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Rodapé Institucional -->
    <footer class="bg-[#071D41] text-slate-300 text-sm py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <p class="font-bold text-white">SAZU — Sistema de Auxílio à Zeladoria Urbana</p>
                <p class="text-xs text-slate-400 mt-1">Projeto Integrador de Engenharia da Computação — UNISO.</p>
            </div>
            <div class="text-xs text-slate-400">
                &copy; {{ date('Y') }} SAZU. Todos os direitos reservados.
            </div>
        </div>
    </footer>

</body>
</html>