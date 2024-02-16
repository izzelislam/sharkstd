<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Login - BackOffice SharkStd</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="/admin/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="/admin/assets/css/main.min.css" rel="stylesheet">
        <link href="/admin/assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            @if (session("error"))
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                    {{session("error") }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session("success"))
                                <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    {{session("success") }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="authent-logo">
                                <img src="/admin/assets/images/logo@2x.png" alt="">
                            </div>
                            <div class="authent-text">
                                <p>Welcome to SharkStd</p>
                                <p>Please Sign-in to your account.</p>
                            </div>

                            <form method="POST" action="{{ route("bo.login.store") }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input 
                                            type="email" 
                                            class="form-control @error("email")
                                                is-invalid
                                            @enderror" 
                                            id="floatingInput" 
                                            placeholder="name@example.com"
                                            name="email"
                                        >
                                        <label for="floatingInput">Email address</label>
                                      </div>
                                      @error("email")
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input 
                                            name="password"
                                            type="password" 
                                            class="form-control @error("password")
                                                is-invalid
                                            @enderror" 
                                            id="floatingPassword"
                                            placeholder="Password"
                                        >
                                        <label for="floatingPassword">Password</label>
                                      </div>
                                      @error("password")
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                </div>
                                <div class="mb-3 form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                                  <label class="form-check-label" for="exampleCheck1" >Check me out</label>
                                </div>
                                <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Sign In</button>
                            </div>
                              </form>
                              <div class="authent-reg">
                                  <p>Not registered? <a href="">Please contact support</a></p>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
        <!-- Javascripts -->
        <script src="/admin/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="/admin/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="/admin/assets/js/main.min.js"></script>
    </body>
</html>