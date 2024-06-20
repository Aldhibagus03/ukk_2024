<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border-radius: 1rem;
            width: 30rem;
            padding: 2rem;
            background: #ffffff;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            width: 100%;
            background: #007bff;
            border: none;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 0.5rem;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .text-center a {
            color: #007bff;
            font-weight: bold;
        }

        .text-center a:hover {
            color: #0056b3;
            text-decoration: none;
        }

        .h4 {
            color: #343a40;
            font-weight: bold;
        }

        .custom-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            background: #007bff;
            color: #ffffff;
            border: none;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .input-group input {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .input-group input::placeholder {
            color: #888;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card custom-shadow">
            <h1 class="h4 text-center text-gray-900 mb-4">Login</h1>
            <form action="login" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address...">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
            </form>
            <hr>

            <div class="text-center">
                <a class="small" href="/register">Create an Account!</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
