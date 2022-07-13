<div class="container home">
	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body">
    		<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class' => 'btn btn-danger btn-xs']) ?></div>       
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-danger">Subir Archivos</h4>
            </div>
      		<div class="col-md-12 my-1">
      		<?= $this->Flash->render() ?>
      		</div>
      		<div class="col-md-8 offset-2">
                <?= $this->Form->create("archivos", array('url'=>array('action'=>'archivos',$empresa_id),'role' => 'form','class' => 'user', 'type'=>'file' )) ?>                        
                <?= $this->Form->input('files[]', array('label'=>'Archivos','type' => 'file','multiple','class'=>'form-control')); ?>
                <?= $this->Form->input('observaciones', array('label'=>'Observaciones','type' => 'text','class'=>'form-control',"maxlength"=> 182)); ?>
                <br>
                <?= $this->Form->button('<i class="fas fa-upload"></i> Subir',["type" => "submit", "class" => "btn btn-danger btn-user btn-block"]) ?>
                <?= $this->Form->end() ?>
          		</div>
            </div>
       	</div>
   	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>