<x-guest-layout>
    <div class="mb-5 border-b border-slate-200 pb-3">
        <h1 class="text-xl font-bold text-[#071D41]">Acessar o Sistema</h1>
        <p class="text-xs sm:text-sm text-slate-700 mt-0.5">
            Informe seu e-mail e senha para registrar ou acompanhar ocorrências.
        </p>
    </div>

    <!-- Status da Sessão -->
    @if (session('status'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 p-3 text-sm font-semibold text-[#168821]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Endereço de E-mail -->
        <div>
            <label for="email" class="block text-[#071D41] font-bold text-sm">
                E-mail
            </label>
            <input
                id="email"
                class="block mt-1.5 w-full rounded-md border border-slate-400 bg-white px-3.5 py-2.5 text-slate-900 font-medium placeholder:text-slate-400 focus:border-[#1351B4] focus:ring-2 focus:ring-[#1351B4]/20 focus:outline-none text-sm"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="seu.email@exemplo.com"
            />
            @if ($errors->get('email'))
                <ul class="mt-1.5 text-xs font-semibold text-red-600 space-y-1">
                    @foreach ((array) $errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Senha -->
        <div>
            <label for="password" class="block text-[#071D41] font-bold text-sm">
                Senha
            </label>
            <input
                id="password"
                class="block mt-1.5 w-full rounded-md border border-slate-400 bg-white px-3.5 py-2.5 text-slate-900 font-medium placeholder:text-slate-400 focus:border-[#1351B4] focus:ring-2 focus:ring-[#1351B4]/20 focus:outline-none text-sm"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Digite sua senha"
            />
            @if ($errors->get('password'))
                <ul class="mt-1.5 text-xs font-semibold text-red-600 space-y-1">
                    @foreach ((array) $errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Ações -->
        <div class="pt-2 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
            @if (Route::has('cidadaos.create'))
                <a
                    class="text-center sm:text-left font-bold text-xs uppercase tracking-wider text-[#1351B4] hover:text-[#071D41] hover:underline py-2 transition"
                    href="{{ route('cidadaos.create') }}"
                >
                    Fazer meu cadastro
                </a>
            @elseif (Route::has('register'))
                <a
                    class="text-center sm:text-left font-bold text-xs uppercase tracking-wider text-[#1351B4] hover:text-[#071D41] hover:underline py-2 transition"
                    href="{{ route('register') }}"
                >
                    Fazer meu cadastro
                </a>
            @endif

            <button
                type="submit"
                class="w-full sm:w-auto inline-flex justify-center items-center bg-[#1351B4] hover:bg-[#0C326F] active:bg-[#071D41] text-white font-bold px-6 py-2.5 rounded-md text-sm shadow-xs transition cursor-pointer"
            >
                Entrar
            </button>
        </div>
    </form>
</x-guest-layout>
