<table class="news-table">
<?php
	$latest=$values["latest"];
?>
	<tr>
		<td>
			<table>
				<tr>
					<td style="vertical-align:top">
						<table class="first-news">
						<?php 
							$current=$latest[0];
							$image=query("select address from images where id=?",$current["id"]);
							if(count($image)==0)
							{
								$image="default.png";
							}
							else
							{
								$image=$image[0];
								$image=$image["address"];
							}
						?>
							<tr>
								<td style="height:300px;text-align:center;background-color:gray;">
									<?php
										$dim=getimagesize("images/".$image);
										//print_r($dim);
										$height=$dim[1];
										$width=$dim[0];
										$ar=$width/$height;
										if($ar>2)
										{
											$width=600;
											$height=300/$ar;
										}
										else
										{
											$height=300;
											$width=300*$ar;
										}
										print "<img src='images/".$image."' height=".$height." width=".$width." />";
									?>
								</td>
							</tr>
							<tr>
								<td>
									<table class="first-news">
										<tr>
											<td class="title">
												<a href="<?='individual-news.php?id='.$current['id']?>">
												<?=$current["title"]?>
												</a>
											</td>
										</tr>
										<tr>
											<td class="content">
												<?=substr($current["content"],0,768)?>...
											</td>
										</tr>
									</table>	
								</td>
							</tr>
						</table>	
					</td>
					<td style="vertical-align:top">
						<table>
						<?php 
							$latest=array_slice($latest,1);
							foreach($latest as $current)
							{
						?>
							<tr>
								<td>
									<table class="latest-news">
										<tr>
											<td class="title">
												<a href="<?='individual-news.php?id='.$current['id']?>">
												<?=$current["title"]?>	
												</a>
											</td>
										</tr>
										<tr>
											<td class="content">
												<?=substr($current["content"],0,340)?>...
											</td>
										</tr>
									</table>
								</td>
							</tr>
						<?php
							}
						?>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="preview-box">
			Preview;
		</td>
	</tr>
	<tr>
		<td>
	<?php
		$categories=$values["categories"];
		$n=count($categories);
		$i=0;
		while($i<$n)
		{
			if($i%2==0)
			{
				print "<table>";
					print "<tr>";
						print "<td style='vertical-align:center'>";
							print "<table class=category-box>";
								print "<tr>";
									print "<td class=title>";
										print $categories[$i]['name'];
									print "</td>";
								print "</tr>";
								$titles=query("select id,title from news where category=? order by timestamp desc limit 5",$categories[$i]['id']);
								if(count($titles)==0)
								{
									print "<tr>";
										print "<td>";
											print "No content found in this section";
										print "</td>";
									print "</tr>";
								}
								foreach($titles as $title)
								{
									print "<tr>";
										print "<td class=content>";
											print "<li>";
												print "<a href='individual-news.php?id=".$title["id"]."' >";
													print $title['title'];
												print "</a>";
											print "</li>";
										print "</td>";
									print "</tr>";
								}
							print "</table>";
								
						print "</td>";
			}
			else
			{
						print "<td style='vertical-align:top'>";
							print "<table class=category-box>";
								print "<tr>";
									print "<td class=title>";
										print $categories[$i]['name'];
									print "</td>";
								print "</tr>";
								$titles=query("select id,title from news where category=? order by timestamp desc limit 5",$categories[$i]['id']);
								if(count($titles)==0)
								{
									print "<tr>";
										print "<td>";
											print "No content found in this section";
										print "</td>";
									print "</tr>";
								}
								foreach($titles as $title)
								{
									print "<tr>";
										print "<td class=content style='vertical-align:center'>";
											print "<li>";
												print "<a href='individual-news.php?id=".$title["id"]."' >";
													print $title['title'];
												print "</a>";
											print "</li>";
										print "</td>";
									print "</tr>";
								}
							print "</table>";
						print "</td>";
					print "</tr>";
				print "</table>";
			}
			$i=$i+1;
		}
		if($i%2==1)
		{
					print "</tr>";
				print "</table>";
		}
	?>
		</td>
	</tr>
</table>
