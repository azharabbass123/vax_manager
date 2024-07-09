<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vax Manager</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
  
    <!-- Jquery link  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Favicons -->
    <link href="{{ asset('assets/img/icons8-injection-68.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!-- Jquery datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body class="index-page" data-aos-easing="ease-in-out" data-aos-duration="600" data-aos-delay="0">

  
    <main class="main">
      <x-nav></x-nav>  
        {{$slot}}
    </main>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Jqury datatables links  -->
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- Jquery files   -->
    <script src="{{ asset('assets/js/adminViewData.js') }}"></script>
    <script src="{{ asset('assets/js/hwViewData.js') }}"></script>
     
    <!-- Soft Delete fiels   -->
    <script src="{{ asset('assets/js/softDelete.js') }}"></script>

    <!-- ShowCities  -->
    <script>
    const fetchCitiesUrl = "{{ route('fetch-cities') }}";
    </script>
    <script src="{{ asset('assets/js/ShowCities.js') }}"></script>
  
    <!-- getAvaibleHealthWorkers -->
    <script src="{{ asset('assets/js/showAvaialableHW.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
  
    <script defer="" src="https://static.cloudflareinsights.com/beacon.min.js/vc733d5f01de84e3792a4035cd15c58a81717452547180" integrity="sha512-fqEn6JCqkzgyQXZxQOxB9z6GyWybXdsYNuqu0tW/ATUi0uJMKhFfYpk0taNyC90JiX4HZUqEp6nnOyL7/ZvjCA==" data-cf-beacon="{&quot;rayId&quot;:&quot;8901b5d80fe96be2&quot;,&quot;version&quot;:&quot;2024.4.1&quot;,&quot;token&quot;:&quot;68c5ca450bae485a842ff76066d69420&quot;}" crossorigin="anonymous"></script>
  
</body>
</html>
