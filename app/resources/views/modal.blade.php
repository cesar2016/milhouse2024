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
            max-height: 95%;
            animation-name: zoom;
            animation-duration: 0.6s;
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
            <img src="{{ asset('my/images/fondo.png') }}" width="2300" height="930" class="modal-content-img ">
            <div class="modal-nav">
                <button id="close" class="btn btn-info btn-sm" hidden>Cerrar</button>
            </div>
        </div>
    </div>

    <script>

        showModal()
        function modal_init(){
        window.onload = function(){
            var show = document.getElementById('showModal');
            show.addEventListener('click', showModal);

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
        }
        }
    </script>
</body>
