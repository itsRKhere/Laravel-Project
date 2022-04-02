<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Page</title>
  </head>
  <body>
    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login</h3>
            <form action="{{ route('formLoginRoute') }}" method="POST">
              @csrf
              <div class="container">
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" name="emailID" class="form-control form-control-lg" />
                      <label class="form-label" for="emailID">Email ID</label>
                    </div>
                    <span class="text-danger">
                      @error('emailID')
                        {{ $message }}
                      @enderror
                    </span>
                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="password" name="password" class="form-control form-control-lg" />
                      <label class="form-label" for="password">Password</label>
                    </div>
                    <span class="text-danger">
                      @error('password')
                        {{ $message }}
                      @enderror
                    </span>
                  </div>
                </div>

                  <br><button class="btn btn-primary">Log in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  </body>
</html>