<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>agregar consultas</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
{{ Form::open(array('url' => 'consultareporte')) }}
  <div class="form-group">
     <label for="exampleInputEmail1">Código</label>
     <input type="text" class="form-control" name="codigo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Código del reporte">
   </div>

   <div class="form-group">
    <label for="exampleTextarea">Consulta</label>
    <textarea class="form-control" id="exampleTextarea" name="consulta" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>

</html>
