<x-guest-layout>
    <div class="mb-5 border-b border-slate-200 pb-3">
        <h1 class="text-xl font-bold text-[#071D41]">Criar Conta</h1>
        <p class="text-xs sm:text-sm text-slate-700 mt-0.5">
            Preencha os dados abaixo para cadastrar seu acesso ao SAZU.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nome Completo -->
        <div>
            <label for="name" class="block text-[#071D41] font-bold text-sm">
                Nome completo
            </label>
            <input
                id="name"
                class="block mt-1.5 w-full rounded-md border border-slate-400 bg-white px-3.5 py-2.5 text-slate-900 font-medium placeholder:text-slate-400 focus:border-[#1351B4] focus:ring-2 focus:ring-[#1351B4]/20 focus:outline-none text-sm"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Digite seu nome completo"
            />
            @if ($errors->get('name'))
                <ul class="mt-1.5 text-xs font-semibold text-red-600 space-y-1">
                    @foreach ((array) $errors->get('name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

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
                autocomplete="new-password"
                placeholder="Crie uma senha"
            />
            @if ($errors->get('password'))
                <ul class="mt-1.5 text-xs font-semibold text-red-600 space-y-1">
                    @foreach ((array) $errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Confirmar Senha -->
        <div>
            <label for="password_confirmation" class="block text-[#071D41] font-bold text-sm">
                Confirmar senha
            </label>
            <input
                id="password_confirmation"
                class="block mt-1.5 w-full rounded-md border border-slate-400 bg-white px-3.5 py-2.5 text-slate-900 font-medium placeholder:text-slate-400 focus:border-[#1351B4] focus:ring-2 focus:ring-[#1351B4]/20 focus:outline-none text-sm"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Repita a senha"
            />
            @if ($errors->get('password_confirmation'))
                <ul class="mt-1.5 text-xs font-semibold text-red-600 space-y-1">
                    @foreach ((array) $errors->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Ações -->
        <div class="pt-2 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
            <a
                class="text-center sm:text-left text-xs sm:text-sm font-semibold text-[#1351B4] hover:text-[#071D41] hover:underline py-2 transition"
                href="{{ route('login') }}"
            >
                Já possui cadastro? Entrar
            </a>

            <button
                type="submit"
                class="w-full sm:w-auto inline-flex justify-center items-center bg-[#1351B4] hover:bg-[#0C326F] active:bg-[#071D41] text-white font-bold px-6 py-2.5 rounded-md text-sm shadow-xs transition cursor-pointer"
            >
                Cadastrar
            </button>
        </div>
    </form>
</x-guest-layout>