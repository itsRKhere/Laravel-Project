<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <title>Register Page</title>
  </head>
  <body>
    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            <form action="{{ route('registerFormRoute') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">First Name</label>
                  </div>
                  <span class="text-danger">
                    @error('firstName')
                    {{$message}}
                    @enderror
                  </span>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Last Name</label>
                  </div>
                  <span class="text-danger">
                    @error('lastName')
                      {{ $message }}
                    @enderror
                  </span>

                </div>
              </div>

              <div class="col-md-6 mb-4">

                <div class="form-outline">
                  <input type="number" min="1" max="3" name="RoleID" class="form-control form-control-lg" placeholder="Admin-1 / Manager-2 / Dev-3"/>
                  <label class="form-label" for="RoleID" >Role ID</label>
                </div>
                <span class="text-danger">
                  @error('RoleID')
                    {{ $message }}
                  @enderror
                </span>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      name="birthdayDate"
                      placeholder="YY-MM-DD"
                    />
                    <label for="birthdayDate" class="form-label">Birthday Date</label>
                  </div>
                  <br>
                  <span class="text-danger">
                    @error('birthdayDate')
                      {{$message}}
                    @enderror
                  </span>

                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="gender" class="form-control form-control-lg"/>
                    <label class="form-label" for="gender">Gender</label>
                  </div>

              </div>

              <div class="col-md-6 mb-4">

                <div class="form-outline">
                  <input type="text" name="emailID" class="form-control form-control-lg" />
                  <label class="form-label" for="emailID">Email</label>
                </div>
                <span class="text-danger">
                  @error('emailID')
                    {{ $message }}
                  @enderror
                </span>

              </div>

              <div class="col-md-6 mb-4">

                <div class="form-outline">
                  <input type="text" name="phoneNumber" class="form-control form-control-lg" />
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                </div>
                <span class="text-danger">
                  @error('phoneNumber')
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

              <div class="col-md-6 mb-4">

                <div class="form-outline">
                  <input type="password" name="confirmPassword" class="form-control form-control-lg" />
                  <label class="form-label" for="confirmPassword">Confirm Password</label>
                </div>
                <span class="text-danger">
                  @error('confirmPassword')
                    {{ $message }}
                  @enderror
                </span>

              </div>

              <div class="mt-4 pt-2">
                <button class="btn btn-primary btn-lg">Submit</button>
              </div>
              <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href={{ route('formLoginRoute') }} class="fw-bold text-body"><u>Login here</u></a></p>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  </body>
</html>