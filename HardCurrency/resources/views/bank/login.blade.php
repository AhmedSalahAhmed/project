<?php


if (!isset($bank)) {
  $bank = [
    'bank_name' => ' شاشة دخول موظف البنك',
    'logo' => 'images/fisal.jpeg',
  ];

  $bank = (object) $bank;
  // dd($bank->logo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>تسجيل الدخول </title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet" />
  <style>
    * {
      font-family: "Tajawal", sans-serif !important;
    }
  </style>
  <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container rtl">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{asset('storage/'.$bank->logo)}}" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7" dir="rtl">
            <div class="card-body shadow">

              <form method="POST" action="{{ route('employee.auth') }}">
                @csrf
                <div class="brand-wrapper">
                  <p class="login-card-description" style="text-align: center;"> {{$bank->bank_name}} </p>

                </div>

                <div class="form-group">
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control myshadow  @error('email') is-invalid @enderror" placeholder="البريد الإلكتروني " required>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control myshadow @error('password') is-invalid @enderror" required placeholder="***********">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group mb-4">
                  <button type="submit" class="btn btn-block login-btn mb-4 ">
                    {{ __('تسجيل دخول') }}
                  </button>
                </div>

              </form>

              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>