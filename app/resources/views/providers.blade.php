@extends('adminlte::page')

@section('title', 'proveedor')

@section('css')
    {{-- Aca se definen los CSS --}}
    {{-- <link rel="stylesheet" href="{{ asset('my/css/...') }}"> --}}

    {{-- Data Tablet --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        .switchBtn {
            margin-bottom: 0;
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switchBtn input {display:none;}
        .slide {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            padding: 8px;
            color: #fff;
        }
        .slide:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 28px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slide {
            background-color: #8CE196;
            padding-left: 40px;
        }
        input:focus + .slide {
            box-shadow: 0 0 1px #01aeed;
        }
        input:checked + .slide:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
            left: -20px;
        }
        .slide.round {
            border-radius: 34px;
        }
        .slide.round:before {
            border-radius: 50%;
        }
    </style>

@stop

@section('content_header')
    <h1>ADMINISTRACION DE PROVEEDORES Y AUMENTOS </h1>
@stop

@section('content')
    <a id="btn-new-provider" class="btn btn-app bg-primary">

        <i class="fas fa-truck"></i> Nuevo proveedor
    </a>

    <a id="btn-new-aumentos" class="btn btn-app bg-info">
        <i class="fas fa-plus"></i> Aplicar aumentos
    </a>

    <div id="view-new-aumentos">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"> <i class=" fa fa-plus"></i> <span> Aplicar aumentos a Productos - Ctas/Ctes. </span> </h3>
            </div>

            <form id="form-new-aumentos" name="form-new-aumentos" action="">
                <div class="card-body">

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Aplicar aumento del <small> - Ingrese solo Numeros - </small></label>
                        <div class="col-sm-2">
                            <input type="text" name="percent_aumento" id="percent_aumento" class="form-control form-control-lg is-invalid" placeholder="Eje: 25%">
                            <label id="error_porcent"></label>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        {{-- Desabilitado hasta que lo pidan --}}
                        {{-- <div class="form-check form-switch mb-2">
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                <h3 class="mb-3">
                                -  Aplicar aumento a Ctas./Ctes. ?
                              </h3>
                            </label>

                            <label class="switchBtn">
                                <input type="checkbox" name="percent_aumento_check" id="percent_aumento_check">
                                <div class="slide round"></div>
                            </label>

                        </div>

                        <div class="form-group row alert alert-info">
                            <label for="" class="col-form-label">DESDE</label>
                            <div class="col-4">
                                <input type="date" name="percent_aumento_desde" value="{{ date('Y-m-d') }}" id="percent_aumento_desde" class="form-control form-control-lg" disabled>
                            </div>
                            <label for="" class="col-form-label">HASTA</label>
                            <div class="col-4">
                                <input type="date" name="percent_aumento_hasta" value="{{ date('Y-m-d') }}" id="percent_aumento_hasta" class="form-control form-control-lg" disabled>
                            </div>
                        </div>--}}


                    </div>

                </div>
                <div class="card-footer">
                    <button id="btn-form-new-aumentos" type="submit" class="btn btn-info">Agregar Aumentos</button>
                    <button id="close-form-aumentos" class="btn btn-default">Cerrar</button>
                </div>
            </form>
        </div>

        <hr>
    </div>

    <div id="view-new-provider">
        <div id="card-form" class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title"> <i class=" fa fa-truck"></i> <span id="text-head-form"></span> </h3>
            </div>
            <input hidden type="text" name="idProvider" id="idProvider" value="1">
            <form id="form-new-provider" name="form-new-provider" action="">
                <div class="card-body">
                    <div class="row mb-2">

                        <div class="col-2">
                            <input type="text" name="provider" id="provider" class="form-control" placeholder="Proveedor">

                        </div>
                        <div class="col-2">
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nombre y Apellido">
                        </div>
                        <div class="col-2">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefono">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-2">
                            <textarea type="text" name="note" id="note" class="form-control" cols="50" rows="5"> {{ date('d-m-Y') }} - NOTA:  </textarea>
                        </div>
                        <div class="col-2" id="checkes_select">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="inlineCheckbox3">Estado del proveedor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_check" id="status_a" value="1" checked>
                                <label class="form-check-label" >Activo</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_check" id="status_i" value="0" >
                                <label class="form-check-label">Inactivo</label>
                                <input type="text" name="status" id="status" value="1" hidden>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span id='btn-form'></span>
                    <button id="close-form" class="btn btn-default">Cerrar</button>
                </div>
            </form>
        </div>

        <hr>
    </div>

    <table id="providers" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Nombre y Apellido</th>
                <th>Telefono</th>
                <th>Nota</th>
                <th>status</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($providers as $provider)

                <tr id="{{ 'row' . $provider['id'] }}">
                    <td>{{ $provider['provider'] }}</td>
                    <td>{{ $provider['fullname'] }}</td>
                    <td>{{ $provider['phone'] }}</td>
                    <td>{{ $provider['note'] }}</td>
                    <td>
                        @if ($provider['status'] == 1)
                            <span class="right badge badge-success">Activo</span>
                        @else
                            <span class="right badge badge-danger">Inactivo</span>
                        @endif
                    </td>

                    <td>
                        <button id='btn_update' value="{{ $provider['id'] }}" class='btn' type="button"
                            data-toggle="modal" data-target="#updateModal">
                            <i class='fa fa-pen text-info'> </i>
                        </button>
                        <button id='btn_delete' value="{{ $provider['id'] }}" class='btn' type="button"
                            data-toggle="modal" data-target="#updateModal">
                            <i class='fa fa-trash text-danger '></i>
                        </button>
                    </td>
                </tr>

            @endforeach
        </tbody>




        {{-- MODAL VENTANA --}}
        <body>
            <style>
               .modal-image{
                    display: none;
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgb(0,0,0);
                    background-color: rgba(0,0,0,0.9);
                }

                .modal-content-img{
                    margin: auto;
                    display: block;
                    max-width: 100%;
                    max-height: 100%;
                    animation-name: zoom;
                    animation-duration: 0.9s;
                }

                @keyframes zoom{
                    from{transform:scale(0)}
                    to{transform:scale(1)}
                }

                .modal-nav{
                    display: flex;
                    justify-content: center;
                }
            </style>
            <h1>Custom Modal Image</h1>
            <button id="showModal" class="btn btn-info">Modal</button>
            <div id="modalImage" class="modal-image">
                <div class="container-login100">
                    <img src="{{ asset('my/images/fondo.png') }}" width="2300" height="900" class="modal-content-img ">
                    <div class="modal-nav">
                        <button id="close" class="btn btn-info btn-sm" hidden>Cerrar</button>
                    </div>
                </div>
            </div>


        </body>



    </table>


@stop



@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('my/js/config.js') }}"></script>
    <script src="{{ asset('my/js/notifications.js') }}"></script>

    <script src="{{ asset('my/js/providers.js') }}"></script>

    <script>

        $(document).ready(function() {


            //$('#providers').DataTable();
            $('#providers').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });

        });



        // modal fUNCTIONS
        showModal()

        function showModal(){
            var modal = document.getElementById('modalImage');
            var close = document.getElementById('close');
            var img = document.getElementById('img');

            modal.style.display = "flex";
            modal.style.flexDirection = "column";
            modal.style.justifyContent = "center";
            modal.style.alignItems = "center";
            modal.style.alignContent = "center";

            close.addEventListener('click', hideModal);
            modal.addEventListener('click', hideModal);
            document.addEventListener('keydown', hideModal);

            function hideModal(e){
                e.stopPropagation();
                <!-- Si el evento fue lanzado por el modal (this) -->
                if(e.target == this || e.key == 'Escape'){
                    modal.style.display = "none";
                    close.removeEventListener('click', hideModal);
                    modal.removeEventListener('click', hideModal);
                    document.removeEventListener('keydown', hideModal);
                }
            }
        }


    </script>

@stop
