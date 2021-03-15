<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<title>@yield('title', 'LCUnila')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Language Center of Lampung University is a technical implementation unit in learning development and language services. [Final Project by David Abror]">
	<meta name="keywords" content="">
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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset ('css/bootstrap.min.css') }}" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset ('js/owl-carousel/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/owl-carousel/owl.theme.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/owl-carousel/owl.transitions.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/rs-plugin/css/settings.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/flexslider/flexslider.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/isotope/isotope.css') }}">
	<link rel="stylesheet" href="{{ asset ('css/jquery-ui.css') }}">
	<link rel="stylesheet" href="{{ asset ('js/magnific-popup/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset ('css/style.css') }}">

	<!-- Google Fonts -->
	<link href="{{ asset ('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset ('http://fonts.googleapis.com/css?family=Montserrat:400,700') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset ('http://fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset ('http://fonts.googleapis.com/css?family=Dosis:400,200,300,500,600,700,800') }}" rel='stylesheet' type='text/css'>

	<!-- Icon Fonts -->
	<link rel="stylesheet" href="{{ asset ('css/icomoon/style.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset ('font-awesome/css/font-awesome.min.css') }}" type="text/css">

  <link rel="shortcut icon" href="{{ asset ('images/ico/iconlcunila.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset ('images/ico/iconlcunila.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset ('images/ico/iconlcunila.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset ('images/ico/iconlcunila.png') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ asset ('images/ico/iconlcunila.png') }}">

	<!-- SKIN -->
	<!-- <link rel="stylesheet" href="css/color-scheme/moderate-green.css" type="text/css"> -->


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
           <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.2/jquery.xdomainrequest.min.js"></script>
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

@include('outerwrapper')
      @include('navbar')
      @yield('main')

      @yield('footer')

      <!-- sweet alerts -->
      <link href="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">
      <!-- Custom styles for this template -->
			<link href="{{ asset ('css/isclunila/style.css') }}" rel="stylesheet">
      <link href="{{ asset ('css/isept/helper.css') }}" rel="stylesheet">
			<!-- jQuery -->
			<script src="{{ asset('js/jquery.js') }}"></script>

			<!-- Plugins -->
			<script src="{{ asset('js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('js/menu.js') }}"></script>
			<script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}"></script>
			<script src="{{ asset('js/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
			<script src="{{ asset('js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
			<script src="{{ asset('js/jquery.easing.min.js') }}"></script>
			<script src="{{ asset('js/isotope/isotope.pkgd.js') }}"></script>
			<script src="{{ asset('js/jflickrfeed.min.js') }}"></script>
			<script src="{{ asset('js/tweecool.js') }}"></script>
			<script src="{{ asset('js/flexslider/jquery.flexslider.js') }}"></script>
			<script src="{{ asset('js/easypie/jquery.easypiechart.min.js') }}"></script>
			<script src="{{ asset('js/jquery-ui.js') }}"></script>
			<script src="{{ asset('js/jquery.appear.js') }}"></script>
			<script src="{{ asset('js/jquery.inview.js') }}"></script>
			<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
			<script src="{{ asset('js/jquery.sticky.js') }}"></script>
			<script src="{{ asset('js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
			<script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.min.js') }}"></script>
			<script src="{{ asset ('assets/isept/sweet-alert/sweet-alert.init.js') }}" ></script>

			<script src="{{ asset('js/main.js') }}"></script>
			<script src="{{ asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC4BLm1lvRCLKdNQSnWI0Z7fdGKfrMMsEw&callback=initMap') }}"></script>

			<script src="{{ asset('js/gmaps/greyscale.js') }}"></script>
			@if ($message=Session::get('success'))
			<script> swal("Success...","{{ $message }}","success") </script>
			@elseif ($message=Session::get('messagesent'))
			<script> swal("Message Sent","{{ $message }}","success") </script>
			@elseif ($message=Session::get('error'))
			<script> swal("Oops...","{{ $message }}","error") </script>
			@elseif ($message=Session::get('danger'))
			<script> swal("Oops...","{{ $message }}","error") </script>
			@elseif ($message=Session::get('warning'))
			<script> swal("Oops...","{{ $message }}","warning") </script>
			@endif

			@yield('script')
			</body>

</html>
