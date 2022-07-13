<p>
Se informa a UECARA que en el día de la fecha <?php echo $fecha; ?> la empresa <?php echo $empresa['denom_social']?> subió los siguientes archivos a través de la página:<br />   
<?php if (!empty($tramite['archivos'])) {
    echo "<ul style='list-style-type: disc'>";
    foreach ($tramite['archivos'] as $archivo) {
        echo "<li>".$archivo['nombre']."</li>";
    }
    echo "</ul>";
}?>
<br /><br />
<b>Observaciones:</b> <?php echo @$tramite['observaciones'];?>;
</p>