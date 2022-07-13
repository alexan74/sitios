
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="text-center">
                <div class="error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-5">Pagina No Encontrada</p>
                <p class="text-gray-500 mb-0">No hemos podido buscar la pagina que buscas</p>
                <?= $this->Html->link(__('Volver'), $this->request->referer()); ?>
            </div>

        </div>

    </div>
