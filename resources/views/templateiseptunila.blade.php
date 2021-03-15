<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Language Center of Unila's Information System of English Proficiency Test [Final Project by David Abror]">
        <meta name="author" content="Ryucons/David Abror">
		
		<!-- David-Tag -->
		<link rel="canonical" href="http://lc.unila.ac.id/" />
		<link rel="next" href="http://lc.unila.ac.id/" />
		
		<meta property="og:locale" content="id_ID" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://lc.unila.ac.id/" />
		<meta property="og:site_name" content="Universitas Lampung | UPT Bahasa" />
		<meta property="fb:admins" content="Feri Krisnanto, David Abror" />
		<meta property="og:image" content="http://lc.unila.ac.id/images/basic/logounila.png" />
		
		<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"http:\/\/lc.unila.ac.id\/","name":"UNIVERSITAS LAMPUNG","potentialAction":{"@type":"SearchAction","target":"http:\/\/lc.unila.ac.id\/?s={search_term_string}","query-input":"required name=search_term_string"}}</script>
		<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"Organization","url":"http:\/\/lc.unila.ac.id\/","sameAs":["https:\/\/www.facebook.com\/balaibahasauniversitaslampung","https:\/\/twitter.com\/"],"@id":"#organization","name":"UNIVERSITAS LAMPUNG | UPT BAHASA","logo":"http:\/\/lc.unila.ac.id\/images\/basic\/logounila.png"}</script>
		<!-- Feri-Tag -->

        <link rel="shortcut icon" href="{{ asset ('images/ico/iconiseptunila.png') }}">

      	<title>@yield('title', 'ISEPTUnila')</title>

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
        <link href="{{ asset ('assets/isept/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset ('assets/isept/morris/morris.css') }}">

        <!-- sweet alerts -->
        <link href="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{ asset ('assets/isept/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Dropzone css -->
        <link href="{{ asset ('assets/isept/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />

        <!-- Custom styles for this template -->
        <link href="{{ asset ('css/isept/style.css') }}" rel="stylesheet">
        <link href="{{ asset ('css/isept/helper.css') }}" rel="stylesheet">

        <!-- BOOSTRAP SELECT -->
        <link href="{{ asset ('assets/isept/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />

        @yield('style')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130796279-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-130796279-1');
		</script>

		
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PQCCGS8');</script>
		<!-- End Google Tag Manager -->

    </head>


    <body>
	
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQCCGS8"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	
          @yield('navbarisept')
          @include('isept/headerisept')
          @yield('mainisept')
          @yield('supportcenter')

          @yield('footer')
          @yield('modal')

        <!-- js placed at the end of the document so the pages load faster -->
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
        <script type="text/javascript" src="{{ asset ('assets/isept/signupscript/bootstrap-show-password.min.js') }}"></script>
        <script src="{{ asset ('assets/isept/select2/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.js') }}"></script>
        <script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.init.js') }}" ></script>
        <script src="{{ asset ('assets/isept/moment/moment.min.js') }}"></script>
        <script src="{{ asset ('assets/isept/owl-carousel/owl.carousel.js') }}"></script>
        <script src="{{ asset ('assets/isept/bootstrap-select.min.js') }}"></script>


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

        $(document).on("click", ".verify", function(e) {
        var link = $(this).attr("href"); // "get" the intended link in a var
        e.preventDefault();
        swal({  title: "Are you sure?",
            text: "Status will be changed to Verified!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-info btn-fill",
            confirmButtonText: "Yes, verify it!",
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

                //owl carousel
                $("#Velonic-slider,#Velonic-slider-2").owlCarousel({
                    navigation : true,
                    slideSpeed : 300,
                    paginationSpeed : 500,
                    singleItem : true,
                    autoPlay:true
                });
            });
        </script>

        <script type="text/javascript">
        $(document).on("click", ".abandoned", function(e) {
        var link = $(this).attr("href"); // "get" the intended link in a var
        e.preventDefault();
        swal({  title: "Abandon this Participant?",
            text: "Status will be changed to Abandoned!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-info btn-fill",
            confirmButtonText: "Yes, Abandon it!",
            cancelButtonClass: "btn btn-danger btn-fill",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
        },function(){
            document.location.href = link;
        });
        });
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
        $(".toggle-password").click(function() {

          $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $($(this).attr("toggle"));
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
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
                jQuery('#datepicker2').datepicker();
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
            });
        </script>
        @yield('script')
    </body>
</html>
