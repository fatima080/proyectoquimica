<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <title>Productos quimicos</title>
    <style>
        .btn-verde {
            background-color: #33bb33;
            color: #000000;
        }

        .btn-verde:hover {
            background-color: #008000;
            color: #000000;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #04aa04 !important;
            color: white !important;
        }
        .select2-selection__choice {
            background-color: #298129 !important;
            color: white !important;
        }
    </style>
</head>
<body class="bg-white text-black">
    <div class="container">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('.toggle-button').click(function() {
            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        });
    });
    $(document).ready(function() {
        $('select[name="h_producto[]"]').select2();
    });
    $(document).ready(function() {
        $('.editar-cantidad').on('click', function() {
            var id = $(this).data('id');
            var consumoDiv = $('#consumo-' + id);
            var capacidadDiv = $('#capacidad-' + id);
            var hideableElements = $('.hideable');
            var cantidadConsumidaHeader = $('.cantidad-consumida-header');
            var button = $(this);

            if (button.data('state') === 'edit') {
                hideableElements.addClass('d-none');
                cantidadConsumidaHeader.removeClass('d-none');
                consumoDiv.find('.form-group').removeClass('d-none');
                capacidadDiv.removeClass('d-none');
                button.data('state', 'save');
                button.attr('title', 'Guardar cantidad');
            } else {
                var cantidad = consumoDiv.find('input[name="cantidad"]').val();
                if (cantidad !== null && cantidad !== '') {
                    if (confirm('¿Estás seguro de que quieres guardar?')) {
                        $.ajax({
                            url: '/productos/' + id,
                            type: 'POST',
                            data: {
                                _method: 'PUT',
                                cantidad: cantidad,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                hideableElements.removeClass('d-none');
                                cantidadConsumidaHeader.addClass('d-none');
                                consumoDiv.find('.form-group').addClass('d-none');
                                if (response.capacidad) {
                                    $('#capacidad-value-' + id).text(response.capacidad);
                                }
                                button.data('state', 'edit');
                                button.attr('title', 'Editar capacidad actual');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    } else {
                        hideableElements.removeClass('d-none');
                        cantidadConsumidaHeader.addClass('d-none');
                        consumoDiv.find('.form-group').addClass('d-none');
                        capacidadDiv.addClass('d-none');
                        button.data('state', 'edit');
                        button.attr('title', 'Editar capacidad actual');
                    }
                }
                // Ocultar el tooltip, cambiar el título y mostrar el tooltip de nuevo
                button.attr('data-original-title', button.attr('title'));
            }


        });
    });
    // Inicializar tooltips
    /*$(function () {
    $('[data-bs-toggle="tooltip"]').tooltip()
    })*/
    </script>
</body>
</html>
