		<ul id="categories" class="section">
		<?php


		$rq= "select `id`, `date_debut`, `nom`, `objectifs` from `projets` order by `date_debut` desc limit 3";
		$table= $connection->query($rq);
		while( $row=$table-> fetch_row())
			{
			$objectif = substr($row[3], 0, 100).'...'; 
			
			echo '
			<li class="projet_accueil">
				<h3 class="lien_projet">
					<a href="index.php?controller=ControlleurProjet&action=DetailProjet&projet='.$row[0].'">'.$row[2].'</a>
				</h3>
				<p class="date_projet">
					'.formatDate($row[1]).'
				</p>
				<p class="objectif_projet">
					<span class="titreObjectif">Objectif(s) : </span><br/>
					'.$objectif.'
				</p><br/>
				<p class="lire_suite">
					<a href="index.php?controller=ControlleurProjet&action=DetailProjet&projet='.$row[0].'">Lire la suite >></a>
				</p>
			</li>';
			}			
		?>
			<!--li>
					<img src="images/gear.png" alt="Img" height="53" width="60">
					<h3>Froibrush Title One</h3>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu ante in enim hendrerit lobortis sit amet eget magna. Fusce tincidunt, dolor ut tempor
					</p>
					<a href="index.html" class="select">Select</a>
				</li>
				<li>
					<img src="images/graph.png" alt="Img" height="53" width="60">
					<h3>Froibrush Title One</h3>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu ante in enim hendrerit lobortis sit amet eget magna. Fusce tincidunt, dolor ut tempor
					</p>
					<a href="index.html" class="select">Select</a>
				</li>
				<li>
					<img src="images/globe.png" alt="Img" height="53" width="60">
					<h3>Froibrush Title One</h3>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu ante in enim hendrerit lobortis sit amet eget magna. Fusce tincidunt, dolor ut tempor
					</p>
					<a href="index.html" class="select">Select</a>
				</li-->
			</ul>
			<!-- /#categories -->
		</div>