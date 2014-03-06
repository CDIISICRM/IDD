<h1>Tous les projets</h1>

<script type="text/javascript">
	$(function() {
	  $( "#accordion" ).accordion();
	});
</script>

<div id="pagination">
	<select id="cbPagination" onChange="Javascript: window.location.href='index.php?controller=ControlleurProjet&action=AfficherTousProjets&page=1&pagination='+this.options[this.selectedIndex].value;">
		<option value="5">5 projets / page</option>
		<option value="6">6 projets / page</option>
		<option value="7">7 projets / page</option>
		<option value="8">8 projets / page</option>
		<option value="9">9 projets / page</option>
		<option value="10">10 projets / page</option>
	</select>
	<?php echo $pagination;?>
</div>
<div id="accordion" >
	<?php echo $accordion; ?>
</div><br/><br/>
