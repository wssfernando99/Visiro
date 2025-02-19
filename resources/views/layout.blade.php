<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Bootstrap link --}}


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

      {{-- jquery js --}}
  <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ url('https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js') }}"></script>
  <script src="{{ url('assets/js/jquery.steps.js') }}"></script>

</head>
<body>

    {{-- CONTENT --}}
    @yield('content')



  
    



    <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>