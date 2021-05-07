
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>


    <link href="{{asset('/dist/css/bootstrap.min.css')}}" rel="stylesheet">



    <link href="{{asset('css/register.css')}}" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">

        <form method="POST" action="/register">
            @csrf

            <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required id="name" name="name" placeholder="Username">
                <label for="name">Username</label>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                <label for="email">Email address</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('passwword') }}" required placeholder="Password">
                <label for="password">Password</label>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm password">
                <label for="password">Confirm password</label>
            </div>
            <div class="form-floating">
                <select class="form-select" name="role_id" required>
                    <option value="1" selected>Learner</option>
                    <option value="2">Author</option>
                    <option value="3">Super user</option>
                </select>
            </div>


            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

        </form>
    </main>



</body>

</html>
