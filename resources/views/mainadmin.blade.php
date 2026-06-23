<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFE59BGX6Q"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-ZFE59BGX6Q');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermercado - @yield('titulo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background-color:#f4f6f9;
        }

        .sidebar{
            background: linear-gradient(180deg,#0d6efd,#084298);
            min-height:100vh;
        }

        .logo-admin{
            border-bottom:1px solid rgba(255,255,255,.2);
            padding:25px 10px;
        }

        .menu-link{
            display:block;
            color:white;
            text-decoration:none;
            padding:12px 15px;
            border-radius:10px;
            margin-bottom:8px;
            transition:.3s;
            font-weight:500;
        }

        .menu-link:hover{
            background-color:rgba(255,255,255,.2);
            color:white;
            transform:translateX(5px);
        }

        .menu-link i{
            margin-right:10px;
        }

        .content-card{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .welcome-box{
            border-radius:15px;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- MENU LATERAL -->
        <div class="col-md-3 col-lg-2 sidebar text-white p-3 d-flex flex-column">

            <div class="logo-admin text-center mb-4">
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-speedometer2"></i>
                    <br>Caçador<br>DeOfertas
                </h3>

                <small>
                    Painel Administrativo
                </small>
            </div>

            <nav>

                <a href="/dashboard" class="menu-link">
                    <i class="bi bi-box-seam"></i>
                    Dashboard
                </a>

                <a href="/produtos" class="menu-link">
                    <i class="bi bi-box-seam"></i>
                    Produtos
                </a>

                <a href="/categorias" class="menu-link">
                    <i class="bi bi-tags-fill"></i>
                    Categorias
                </a>

                <a href="/cidades" class="menu-link">
                    <i class="bi bi-geo-alt-fill"></i>
                    Cidades
                </a>

                <a href="/usuarios" class="menu-link">
                    <i class="bi bi-person-fill"></i>
                    Usuários
                </a>

                <a href="/vendas" class="menu-link">
                    <i class="bi bi-person-fill"></i>
                    Vendas
                </a>

                 <!-- Botão Sair -->
                 <div class="mt-auto">

        <hr class="text-light">

        <form action="/logout" method="POST">
            @csrf

            <button
                type="submit"
                class="menu-link border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-right"></i>
                Sair
            </button>
        </form>

            </nav>

        </div>

        <!-- CONTEÚDO -->
        <div class="col-md-9 col-lg-10 p-4">

            <div class="card content-card">

                <div class="card-body">
                @yield('conteudo')
                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>