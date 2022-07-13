
<form id="form" class="form" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?=DIRHOST?>/afiliados/delete/<?=$afiliado_id?>">
<input type="hidden" id="afiliado_id" name="afiliado_id" value="<?=$afiliado_id?>" />
<input type="hidden" id="empresa_id" name="empresa_id" value="<?=$empresa_id?>" />
<div class="form-group">
  <label for="email">Subir Carta Documento o Nota</label>
  <input type="file" class="form-control" id="archivo" name="files[]" multiple />
</div>
<div class="form-group">
  <label for="password">Observaciones</label>
  <input type="text" class="form-control" id="observaciones" name="observaciones" maxlength="255">
</div>
<button type="button" onclick="cancelar()" class="btn btn btn-danger fright" style="margin-left:20px;">Cancelar</button>
<button  type="submit" id="tramite" class="btn btn btn-primary fleft">Ok</button>
</form>
<script>
	function cancelar() {
		$('#dialogModal').dialog('close');
	}
	function tramite() {
		alert ($('#archivo').files.length);
		alert ($('#observaciones').val());
		return false;
	}
	$('#tramite').click(function(event) {
 		event.preventDefault();
 		if ($('#archivo')[0].files.length > 0 || $('#observaciones').val()!='') {
 			$('#form').submit();
 		} else {
 			alert('Por favor complete el formulario');
 		}
	});
</script>