<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Administrator | Futsal Management System</title>

    <!-- Bootstrap -->
    <link href="{{ asset("/assets/backend/vendors/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("/assets/backend/vendors/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset("/assets/backend/build/css/custom.min.css") }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {{ Form::open(array('route' => array('user.login'), 'method' => 'post', 'autocomplete' => 'false')) }}
              <h1>Administrator Login</h1> 
               <h1> Alena Futsal</h1>
              @if(session()->has('response_status'))
                <div class="alert @if(session('response_status') == '1') alert-success @else alert-danger @endif alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                    {{ session('response_message') }}
                </div>
                <input type="text" class="form-control" value="{{ session('response_hash') }}">
              @endif
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success" style="width: 100%;" />Login</button>                
              </div>
			  {{ Form::close() }}
          </section>
        </div>
      </div>
    </div>
  </body>
</html>