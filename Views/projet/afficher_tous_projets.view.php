<h1>Découvrir nos activités</h1>

<script type="text/javascript">
	$(function() {
	  $( "#accordion" ).accordion();
	});
</script>

<div id="pagination">
	<select id="cbPagination" onChange="Javascript: window.location.href='index.php?controller=ControlleurProjet&action=AfficherTousProjets&page=1&pagination='+this.options[this.selectedIndex].value;">
		<?php echo $comboPagination; ?>
	</select>
	<?php echo $pagination;?>
</div>
<div id="accordion" >
	<?php echo $accordion; ?>
</div><br/><br/>
