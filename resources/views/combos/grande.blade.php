
<script>
    $( document ).ready(function() {
          $(".combo-grande tr td").click(function(){            
            $("#{{$entradaid}}").val($(this).siblings("input").val());
            $("#{{$entrada}}").val($(this).html());
            $(".contenedor-combo").empty();
            $(".contenedor-combo").css("display","none");
        });
    });

</script>
<div class="container-fluid">
   @include("combos.form")
</div>
