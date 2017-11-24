<head>
    <title>Desarrollo Hidrocálido - Recorrer Select option</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script type="text/javascript" src="{{ asset('js/select.js')}}"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="form-group">
        <div class="col-md-10">
            <input   type="text"  class="form-control" >
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <input type="hidden" id="oculto" name="select-option[]" value="">
        <select class="form-control" onchange="presionar(this)" id="seleccionar">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <button class="presionar" >presionar</button>
</div>
</body>

<script>

    function presionar(event) {


        if ($("#oculto").val() == '') {
            var formData = new FormData();
            formData.append("archivos[]",event.value);
            $("#oculto").val(formData);
        } else {
            var formData = new FormData();
            formData.append("archivos[]",event.value);
            formData.append("archivos[]",$("#oculto").val());
            $("#oculto").val(formData);
            for(var pair in formData.entries()) {
                console.log(pair[0]+ ', '+ pair[1]);
            }

        }

    };

</script>
</body>
</html>