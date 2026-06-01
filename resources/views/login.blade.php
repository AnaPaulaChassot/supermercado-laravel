<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CaçadorDeOfertas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0d6efd, #4da3ff);
        }

        .login-card{
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo{
            font-size: 2rem;
            font-weight: bold;
            color: #0d6efd;
        }

        .logo span{
            color: #003b8f;
        }

        .btn-login{
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: 600;
        }

        .btn-login:hover{
            background-color: #0b5ed7;
        }

        .card-body{
            padding: 40px;
        }
    </style>
</head>
<body>

    <div class="card login-card">

        <div class="card-body">

            <div class="text-center mb-4">

                <div class="logo mt-3">
                    🛒 Caçador<span>DeOfertas</span>
                </div>

            </div class="mb-4">

            {{-- MENSAGENS --}}

            @if(session('erro'))
                <div class="alert alert-danger">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.entrar') }}">

                @csrf

                <div class="form-floating mb-3">

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Email"
                        required
                    >

                    <label for="email">
                        E-mail
                    </label>

                </div>

                <div class="form-floating mb-3">

                    <input
                        type="password"
                        class="form-control"
                        id="senha"
                        name="senha"
                        placeholder="Senha"
                        required
                    >

                    <label for="senha">
                        Senha
                    </label>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-login w-100"
                >
                    Entrar
                </button>

            </form>

            <div class="text-center mt-4 text-muted">
                <a href="/clientes/novo"
                       class="btn btn-light">
                        Cadastre-se
                    </a>
            </div>

        </div>

    </div>

</body>
</html>