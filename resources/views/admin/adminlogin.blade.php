
<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dating Strings| Admin login</title>
        <link rel = "icon" href = "../../dist-assets/images/Logo-Element.png" type = "image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
        <link id="gull-theme" rel="stylesheet" href="https://aerem.co.in/assets/backend/styles/css/themes/lite-purple.min.css">
        <link id="gull-theme" rel="stylesheet" href="https://aerem.co.in/assets/backend/styles/css/themes/style.css">
        <script src="https://aerem.co.in/assets/common/js/jquery.min.js"></script>
        <script src="https://aerem.co.in/assets/common/js/common.js" ></script>
    </head>
    <style>
        .color-bg{
            background-image: linear-gradient(to right, #FF7D7D, #FF3661) !important;
        }
        .color-bg:hover{
            background-image: linear-gradient(to right, #FF7D7D, #FF3661) !important;   
        }
    </style>
    <body>

        <div class="auth-layout-wrap" >
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-4 pd-lr">
                                <div class="auth-logo text-center mb-4 mb-3">
                                    <img src="../../dist-assets/images/Logo-2.png" alt="adminlogo" style="width: auto; height: 120px;">
                                </div>
                                <h1 class="mb-3 text-18" style="text-align:center;">Admin Panel</h1>
                                @if (session('error')) 
                                    <div class="alert alert-danger alert-dismissible">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                @elseif (session('success')) 
                                    <div class="alert alert-success alert-dismissible">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                            @endif
                                <form action="/admin" method="POST" id="login">
                                  @csrf
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input name="email" class="form-control form-control-rounded" type="email" required = "required">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" class="form-control form-control-rounded" type="password" required = "required">
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-2 color-bg" type="submit">Sign In</button>

                                </form>
                                {{-- <div class="mt-3 text-center">
                                    <a href="forgot.html" class="text-muted"><u>Forgot Password?</u></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>