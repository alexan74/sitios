

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="text-center">
                <div class="error mx-auto" data-text="500">500</div>
                <p class="lead text-gray-800 mb-5">Internal Server Error</p>
                <p class="text-gray-500 mb-0">Trata de volver a cargar la pagina o no dudes de contactar con nosostros si el problema persiste.</p>
                <?= $this->Html->link(__('Volver'), $this->request->referer()); ?>
            </div>

        </div>

    </div>
