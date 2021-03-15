<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Language Center of Unila's Information System of English Proficiency Test [Final Project by David Abror]">
        <meta name="author" content="Ryucons/David Abror">

        <link rel="shortcut icon" href="{{ asset ('images/ico/iconiseptunila.png') }}">

      	<title>ISEPT Unila | Sign Up</title>

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
              <img alt="" align="middle" src="{{ asset ('images/ico/iconiseptunila.png') }}" class="media-object thumb-xlg" height="50px" width="60px">
           <h3 class="text-center m-t-10"> Register New <strong>ISEPT</strong> Account </h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-10 p-20 p-b-0" role="form" action="{{ route('signup_eptparticipant.add') }}" method="POST" >
                {{ csrf_field() }}
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" id="txtChar" onkeypress="return isNumberKey(event)" name="idnumber_eptparticipant" type="text" placeholder="NIK/NPM" value="{{ old('idnumber_eptparticipant') }}">
                          @if ($errors->has('idnumber_eptparticipant'))
                          <span class="help-block text-danger">
                              {{ $errors->first('idnumber_eptparticipant') }}
                          </span>
                          @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="email" type="email" placeholder="Email Address" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="username" type="text" placeholder="username" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                        <span class="help-block text-danger">
                            {{ $errors->first('username') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" placeholder="Password" data-toggle="password">
                        @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-xs-12">
                        <input class="form-control" name="password_confirmation" type="password" placeholder="Retype Password" data-toggle="password">
                        @if ($errors->has('password_confirmation'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                       <p align="justify">
                       By clicking on 'Register' you are confirming that you have read, understood, and accept the LC Unila <strong>
                       <a href="{{ url('isept/termspolicy') }}" target="_blank">Terms of Service</a> </strong> and <strong>
                       <a href="{{ url('isept/termspolicy') }}" target="_blank">Privacy Policy</a></strong></p>
                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-success w-md" type="submit">Register</button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-12 text-center">
                        <a href="{{ url('isept/login') }}">Already have account?</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<script src="{{ asset ('js/isept/jquery.js') }}"></script>
<script src="{{ asset ('js/isept/bootstrap.min.js') }}"></script>
<script src="{{ asset ('js/isept/modernizr.min.js') }}"></script>
<script src="{{ asset ('js/isept/pace.min.js') }}"></script>
<script src="{{ asset ('js/isept/wow.min.js') }}"></script>
<script src="{{ asset ('js/isept/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset ('js/isept/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!-- skycons -->
<script src="{{ asset ('js/isept/skycons.min.js') }}" type="text/javascript"></script>
<!-- Counter-up -->
<script src="{{ asset ('js/isept/waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('js/isept/jquery.counterup.min.js') }}" type="text/javascript"></script>

<!-- sparkline -->
<script src="{{ asset ('assets/isept/sparkline-chart/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('assets/isept/sparkline-chart/chart-sparkline.js') }}" type="text/javascript"></script>

<!--Morris Chart-->
<script src="{{ asset ('assets/isept/morris/morris.min.js') }}"></script>
<script src="{{ asset ('assets/isept/morris/raphael.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset ('assets/isept/chartjs/chart.min.js') }}"></script>
<script src="{{ asset ('assets/isept/chartjs/chartjs.init.js') }}"></script>

<script src="{{ asset ('js/isept/jquery.app.js') }}"></script>

<script src="{{ asset ('assets/isept/dropzone/dropzone.min.js') }}"></script>

<!-- Dashboard -->
<script src="{{ asset ('js/isept/jquery.dashboard.js') }}"></script>

<!-- Datatables-->
<script src="{{ asset ('assets/isept/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset ('assets/isept/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset ('assets/isept/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
<script src="{{ asset ('assets/isept/jquery-datatables-editable/datatables.editable.init.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/jszip.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset ('assets/isept/datatables/dataTables.scroller.min.js') }}"></script>

<script src="{{ asset ('assets/isept/tagsinput/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset ('assets/isept/toggles/toggles.min.js') }}"></script>
<script src="{{ asset ('assets/isept/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset ('assets/isept/timepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset ('assets/isept/colorpicker/bootstrap-colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset ('assets/isept/jquery-multi-select/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ asset ('assets/isept/jquery-multi-select/jquery.quicksearch.js') }}"></script>
<script src="{{ asset ('assets/isept/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset ('assets/isept/spinner/spinner.min.js') }}"></script>
<script src="{{ asset ('assets/isept/select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.js') }}"></script>
<script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.init.js') }}" ></script>
<script type="text/javascript" src="{{ asset ('assets/isept/signupscript/bootstrap-show-password.min.js') }}"></script>


@if ($message=Session::get('success'))
<script> swal("Success...","{{ $message }}","success") </script>
@elseif ($message=Session::get('error'))
<script> swal("Oops...","{{ $message }}","error") </script>
@elseif ($message=Session::get('danger'))
<script> swal("Oops...","{{ $message }}","error") </script>
@elseif ($message=Session::get('warning'))
<script> swal("Oops...","{{ $message }}","warning") </script>
@endif

<!-- Datatable init js -->
<script src="{{ asset ('js/isept/datatables.init.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#datatable').dataTable();
      $('#datatable-keytable').DataTable( { keys: true } );
      $('#datatable-responsive').DataTable();
      $('#datatable-scroller').DataTable( { ajax: "{{ asset ('assets/isept/datatables/json/scroller-demo.json') }}", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
      var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
  } );
  TableManageButtons.init();
</script>

<script type="text/javascript">
$(document).on("click", ".remove", function(e) {
var link = $(this).attr("href"); // "get" the intended link in a var
e.preventDefault();
swal({  title: "Are you sure?",
  text: "Data will be deleted permanently!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn btn-info btn-fill",
  confirmButtonText: "Yes, delete it!",
  cancelButtonClass: "btn btn-danger btn-fill",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
},function(){
  document.location.href = link;
});
});
</script>

<script type="text/javascript">
	$("#password").password('toggle');
</script>

<script type="text/javascript">
$(document).on("click", ".refresh", function(e) {
var link = $(this).attr("href"); // "get" the intended link in a var
e.preventDefault();
swal({  title: "Are you sure?",
  text: "Some Data will be refreshed!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn btn-info btn-fill",
  confirmButtonText: "Yes, refresh it!",
  cancelButtonClass: "btn btn-danger btn-fill",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
},function(){
  document.location.href = link;
});
});
</script>

<script type="text/javascript">
  jQuery(document).ready(function($) {
      /* Counter Up */
      $('.counter').counterUp({
          delay: 100,
          time: 1200
      });
  });
  /* BEGIN SVG WEATHER ICON */
  if (typeof Skycons !== 'undefined'){
  var icons = new Skycons(
      {"color": "#fff"},
      {"resizeClear": true}
      ),
          list  = [
              "clear-day", "clear-night", "partly-cloudy-day",
              "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
              "fog"
          ],
          i;

      for(i = list.length; i--; )
      icons.set(list[i], list[i]);
      icons.play();
  };
</script>

<script>
  jQuery(document).ready(function() {

      // Tags Input
      jQuery('#tags').tagsInput({width:'auto'});

      // Form Toggles
      jQuery('.toggle').toggles({on: true});

      // Time Picker
      jQuery('#timepicker').timepicker({defaultTIme: false});
      jQuery('#timepicker2').timepicker({showMeridian: false});
      jQuery('#timepicker3').timepicker({minuteStep: 15});

      // Date Picker
      jQuery('#datepicker').datepicker();
      jQuery('#datepicker-inline').datepicker();
      jQuery('#datepicker-multiple').datepicker({
          numberOfMonths: 3,
          showButtonPanel: true
      });
      //colorpicker start

      $('.colorpicker-default').colorpicker({
          format: 'hex'
      });
      $('.colorpicker-rgba').colorpicker();


      //multiselect start

      $('#my_multi_select1').multiSelect();
      $('#my_multi_select2').multiSelect({
          selectableOptgroup: true
      });

      $('#my_multi_select3').multiSelect({
          selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
          selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
          afterInit: function (ms) {
              var that = this,
                  $selectableSearch = that.$selectableUl.prev(),
                  $selectionSearch = that.$selectionUl.prev(),
                  selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                  selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

              that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                  .on('keydown', function (e) {
                      if (e.which === 40) {
                          that.$selectableUl.focus();
                          return false;
                      }
                  });

              that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                  .on('keydown', function (e) {
                      if (e.which == 40) {
                          that.$selectionUl.focus();
                          return false;
                      }
                  });
          },
          afterSelect: function () {
              this.qs1.cache();
              this.qs2.cache();
          },
          afterDeselect: function () {
              this.qs1.cache();
              this.qs2.cache();
          }
      });

      //spinner start
      $('#spinner1').spinner();
      $('#spinner2').spinner({disabled: true});
      $('#spinner3').spinner({value:0, min: 0, max: 10});
      $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
      //spinner end

      // Select2
      jQuery(".select2").select2({
          width: '100%'
      });
  });
</script>
<script language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
 </script>

@section('footer')
  @include('isclunila/footerisclunila')
@stop
