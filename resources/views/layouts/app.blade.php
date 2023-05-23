@include('layouts.header')

<body>
    <x-menuflutuante/>

    <!-- O spinner -->

    <div id="spinner" class="text-center col-1" style="position:absolute; top:11%; right:48%; z-index:10000;">
        <div class="spinner-border" role="status">
          <span class="sr-only">Carregando...</span>
        </div>
      </div>


    <input type="hidden" name="cliente_id" id="cliente_id" value="">
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

    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/response.js') }}"></script>
    <script type="module" src="{{ asset('js/default.js') }}"></script>
    <script type="module" src="{{ asset('js/justificarModal.js') }}"></script>

    </body>
    </html>
</body>



</html>
