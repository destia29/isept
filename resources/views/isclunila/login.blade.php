<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Language Center of Unila's Information System of English Proficiency Test [Final Project by David Abror]">
        <meta name="author" content="Ryucons/David Abror">

        <link rel="shortcut icon" href="{{ asset ('images/ico/iconiseptunila.png') }}">

      	<title>ISLC Unila | Login</title>

        <!-- DataTables -->
        <link href="{{ asset ('assets/isept/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('assets/isept/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('assets/isept/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('assets/isept/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('assets/isept/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Bootstrap core CSS -->
        <link href="{{ asset ('css/isept/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset ('css/isept/bootstrap-reset.css') }}" rel="stylesheet">

        <!--Animation css-->
        <link href="{{ asset ('css/isept/animate.css') }}" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="{{ asset ('assets/isept/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset ('assets/isept/ionicon/css/ionicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset ('assets/isept/material-design-iconic-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" />

        <!-- Plugins css-->
        <link href="{{ asset ('assets/isept/tagsinput/jquery.tagsinput.css') }}" rel="stylesheet" />
        <link href="{{ asset ('assets/isept/toggles/toggles.css') }}" rel="stylesheet" />
        <link href="{{ asset ('assets/isept/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
        <link href="{{ asset ('assets/isept/timepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('assets/isept/colorpicker/colorpicker.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('assets/isept/jquery-multi-select/multi-select.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('assets/isept/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset ('assets/isept/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset ('assets/isept/jquery-datatables-editable/datatables.css') }}" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset ('assets/isept/morris/morris.css') }}">

        <!-- sweet alerts -->
        <link href="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{ asset ('assets/isept/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Custom styles for this template -->
        <link href="{{ asset ('css/isept/style.css') }}" rel="stylesheet">
        <link href="{{ asset ('css/isept/helper.css') }}" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-62751496-1', 'auto');
          ga('send', 'pageview');

        </script>

    </head>


<body>
<div class="wrapper-page">

    <div class="panel panel-color panel-inverse">
        <div class="panel-heading" align="middle">
              <img alt="" align="middle" src="{{ asset ('images/ico/iconclunila.png') }}" class="media-object thumb-xlg" height="50px" width="60px">
           <h3 class="text-center m-t-10"> Sign In to <strong>ISLCUnila</strong> </h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal m-t-10 p-20 p-b-0" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input class="form-control" name="username" value="{{ old('username') }}" type="text" placeholder="Username">
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <label class="cr-styled">
                            <input type="checkbox">
                            <i class="fa"></i>
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-success w-md" type="submit">Log In</button>
                    </div>
                </div>
                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="{{ url('isclunila/forgotpassword') }}"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="{{ url('isclunila/signup') }}">Sign Up</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@section('footer')
  @include('isclunila/footerisclunila')
@stop
