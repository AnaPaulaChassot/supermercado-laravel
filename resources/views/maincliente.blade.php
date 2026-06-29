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
    <title>Caçador de Ofertas - @yield('titulo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f8ff;
        }

        .topo {
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
            color: white;
            padding: 20px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
        }

        .card-produto {
            transition: 0.3s;
        }

        .card-produto:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
        }

        .produto-img {
            height: 220px;
            width: 100%;
            object-fit: contain;
        }
    </style>

</head>

<body>

     @yield('conteudo')
        
</body>

</html>