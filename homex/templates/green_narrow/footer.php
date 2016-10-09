		</div>
		
		  <div class="bottom"><br />
			<?php 
			$menu = mysql_query("SELECT * FROM cms_pages where menushowbottom='1' order by weight asc") or die(mysql_error());
			while($menus = mysql_fetch_assoc($menu)){
				if($menus['url'] == 'signup'){
				?>
				<?if(!isAuth()) {?><a href="<?=$p?>/<?=$menus['url']?>" class="bot"><?=$menus['name2']?></a><?}?>
				<?if(isAuth() && 1==2) {?><a href="<?=$p?>/Profile" class="bot"><?=$l['profile']?></a><?}?>
				<?php
				}
				else if($menus['url'] == 1){
				?>
				<a href="<?=$p?>/index.php" class="bot"><?=$menus['name2']?></a>
				<?php	
				} else if($menus['url'] == 'Login'){
				?>
				<?if(!isAuth()) {?><a href="<?=$p?>/<?=$menus['url']?>" class="bot"><?=$menus['name2']?></a><?}?>
				<?php	
				} else {
				?>
				<a href="<?=$p?>/<?=$menus['url']?>" class="bot"><?=$menus['name2']?></a>
				<?php	
				}
			}	
			?>
			<div class="copyright">
				<?=$l['Copyright']?> <?=date("Y")?> <?=getSet('projectName')?> &copy;. <?=$l['AllRights']?>
			</div>
 			
		  </div>
		  <div class="blank_div">&nbsp;</div>
		  
		  <table width="100%">
		  </table>
		  
		  <!-- affiliate Link -->
		  <?php 
		  if(getSet("ShowFooterLink")==1){
		  	?>
			<a href="http://support.topclassifiedsoftware.com/affiliate/idevaffiliate.php?id=<?=getSet("AffiliateID")?>" target="_blank"><?=$l['footerLink'];?></a>
			<?php
		  }
		  ?>
		  
		  
<!-- Footer -->
</div>
<?=getSet("counters")?>
</body>
</html>