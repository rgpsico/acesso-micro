@include('layouts.header')

<body>
    <x-menuflutuante/>
    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ env('CLIENTE') }}">
    <audio id="liberado" src="{{ asset('music/success.mp3') }}"></audio>
    <audio id="bloqueado" src="{{ asset('music/error.mp3') }}"></audio>

    <button id="fullscreenToggle">
        <i class="fas fa-expand"></i>
    </button>

    <div id="app" class="bg-dark">
        <main class="py-4">
            <x-modalmicro/>
            @yield('content')
        </main>
    </div>
    <script type="module" src="{{ asset('js/default.js') }}"></script>


    </body>
    </html>
</body>



</html>
