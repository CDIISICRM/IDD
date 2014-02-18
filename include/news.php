		<ul id="categories" class="section">
		<?php

		$rq= "select `id`, `date_debut`, `nom`, `objectifs` from `projets` order by `date_debut` desc limit 3";
		$table= $connection->query($rq);
		while( $row=$table-> fetch_row())
			{
			echo "<li><h5>".formatDate($row[0])."</h5>";
			echo '
			<p>
				<a href="detail_projet.php?projet='.$row[0].'">'.$row[1].'</a>"
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