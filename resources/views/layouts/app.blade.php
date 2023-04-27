@include('layouts.header')

<body>
    <style>
    .menu-flutuante {
        position: fixed;
        width:3%;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 9999;
        opacity: 0.2;
        padding: 10px;
        height: 100%;

    }

#menu-opcoes {
  position: absolute;
  top: 40%;
  left: 60px;
  z-index: 999;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
  width:300px;
}

#menu-opcoes ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

#menu-opcoes li {
  padding: 10px;
}

#menu-opcoes a {
  color: #333;
  text-decoration: none;
  transition: all 0.3s ease;
}

#menu-opcoes a:hover {
  background-color: #f5f5f5;
}

    </style>


<button id="menu-flutuante" class="btn btn-primary menu-flutuante">Menu</button>

    <div id="menu-opcoes" class="d-none">
        <ul>
            <li><a href="#" class="list-group-item" id="liberacaoManual">Liberar Manual</a></li>
            <li><a href="#" class="list-group-item" id="liberacaoManual">Liberar Catraca</a></li>
        </ul>
    </div>


    <div id="app" class="bg-dark">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</html>
