<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SAZU') }} — Sistema de Auxílio à Zeladoria Urbana</title>

        <!-- Fonte Institucional (Padrão Gov.br: Public Sans) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Public Sans', system-ui, -apple-system, sans-serif;
            }
            /* Garante fundo branco e texto escuro mesmo com preenchimento automático do navegador */
            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus {
                -webkit-text-fill-color: #0f172a !important;
                -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
                transition: background-color 5000s ease-in-out 0s;
            }
        </style>
    </head>
    <body class="font-sans bg-[#F8FAFC] text-[#071D41] antialiased min-h-screen flex flex-col justify-between">
        <!-- Faixa Superior Institucional -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#071D41] via-[#1351B4] to-[#168821]"></div>

        <div class="flex-grow flex flex-col justify-center items-center px-4 py-8 sm:py-12">
            <!-- Identidade SAZU + Espaço Reservado -->
            <div class="w-full max-w-md flex flex-col items-center text-center mb-6">
                <a href="{{ url('/') }}" class="mb-4 block">
                    <span class="text-3xl font-extrabold tracking-tight text-[#071D41] block leading-none">
                        SAZU
                    </span>
                    <span class="text-xs sm:text-sm text-slate-700 font-medium block mt-1">
                        Sistema de Auxílio à Zeladoria Urbana
                    </span>
                </a>

                <div class="w-full rounded-lg border-2 border-dashed border-slate-300 bg-white px-4 py-3 text-center shadow-2xs">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#1351B4] bg-blue-50 px-2.5 py-0.5 rounded-full inline-block mb-1">
                        Identidade Local
                    </span>
                    <p class="text-xs sm:text-sm font-medium text-slate-800">
                        Espaço reservado a imagem da respectiva prefeitura da cidade
                    </p>
                </div>
            </div>

            <!-- Cartão Principal do Formulário -->
            <div class="w-full sm:max-w-md px-6 py-6 bg-white border border-slate-200 shadow-md overflow-hidden rounded-lg">
                {{ $slot }}
            </div>

            <!-- Link de Retorno ao Início -->
            <div class="mt-5 text-center">
                <a href="{{ url('/') }}" class="text-xs sm:text-sm font-semibold text-[#1351B4] hover:text-[#071D41] hover:underline transition">
                    &larr; Voltar para a página inicial
                </a>
            </div>
        </div>

        <!-- Rodapé Discreto -->
        <footer class="bg-[#071D41] text-white text-xs py-4 px-4 text-center">
            <p class="font-semibold text-white">SAZU — Sistema de Auxílio à Zeladoria Urbana</p>
            <p class="text-slate-200 mt-0.5">Projeto Integrador de Engenharia da Computação — UNISO</p>
        </footer>
    </body>
</html>