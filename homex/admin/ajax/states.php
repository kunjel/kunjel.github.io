<?php

// *************************************************************************

// *                                                                       *

// * Top Classified Software                                               *

// * Copyright (c) Top Classified Software. All Rights Reserved,           *

// * Release Date: November 21, 2011                                       *

// * Version 4.2.0                                                         *

// *                                                                       *

// *************************************************************************

// *                                                                       *

// * Email: contact@topclassifiedsoftware.com                              *

// * Website: http://topclassifiedsoftware.com                             *

// *                                                                       *

// *************************************************************************

// *                                                                       *

// * This software is furnished under a license and may be used and copied *

// * only  in  accordance  with  the  terms  of such  license and with the *

// * inclusion of the above copyright notice.  This software  or any other *

// * copies thereof may not be provided or otherwise made available to any *

// * other person.  No title to and  ownership of the  software is  hereby *

// * transferred.                                                          *

// *                                                                       *

// * You may not reverse  engineer, decompile, defeat  license  encryption *

// * mechanisms, or  disassemble this software product or software product *

// * license.  Top Classified Software may terminate this license if you   *

// * don't comply with any of the terms and conditions set forth in our    *

// * end userlicense agreement (EULA).  In such event,  licensee  agrees   *

// * to return licensor  or destroy  all copies of software  upon          *

// * termination of the license.                                           *

// *                                                                       *

// * Please see the EULA file for the full End User License Agreement.     *

// *                                                                       *

// *************************************************************************


	require_once "../../includes/base.php";

	global $l;

$per_page = 9;

$sql1 = "select cms_states.*,cms_countries.name2 AS country_name from cms_states LEFT JOIN cms_countries ON cms_states.pid = cms_countries.cid  order by name2";

$rsd = mysql_query($sql1);

$count = mysql_num_rows($rsd);

$pages = ceil($count/$per_page);

 

if($_GET)

{

$page=$_GET['page'];

//get table contents

$start = ($page-1)*$per_page;

$sql = "SELECT  * FROM cms_states ORDER BY name2 limit $start,$per_page";

$rsd = mysql_query($sql);

//$rsd = mysql_query($sql);

}

	//$cats = mysql_query("SELECT  * FROM cms_states ORDER BY name2 ") or die("dont get categories");

	//for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

?><head>

</head>

<div id="loading" ></div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

	<script type="text/javascript">

	

	$(document).ready(function(){

		

	//Display Loading Image

	function Display_Load()

	{

	    $("#loading").fadeIn(900,0);

		$("#loading").html("<img src='loadingAnimation.gif' />");

	}

	//Hide Loading Image

	function Hide_Load()

	{

		$("#loading").fadeOut('slow');

	};

	

   //Default Starting Page Results

   

	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});

	

	Display_Load();

	

	$("#content").load("states.php?page=1", Hide_Load());

	//Pagination Click

	$("#pagination li").click(function(){

			

		Display_Load();

		

		//CSS Styles

		$("#pagination li")

		.css({'border' : 'solid #dddddd 1px'})

		.css({'color' : '#0063DC'});

		

		$(this)

		.css({'color' : '#FF0084'})

		.css({'border' : 'none'});

		//Loading Data

		var pageNum = this.id;

		

		$("#content").load("states.php?page=" + pageNum, Hide_Load());

	});

	

	

});

	</script>

	<div id="content" >

				

	

	

	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 10px;">

		<tr>

        <td class="bl lhs level1"><?=$l['Name']?></td>

        <td class="bl lhs level1"><?=$l['Country']?></td>

        <td class="bl" style="width: 110px;"><?=$l['Edit']?></td>

        <td class="bl" style="width: 110px;"><?=$l['Delete']?></td>

		</tr>

	<?php while($row = mysql_fetch_array($rsd))

		{?>

			<tr>

				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$row['name2']?></td>

				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$row['country_name']?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=places&tab=3&stateEdit=<?=$row['cid']?>"><img src="images/page_white_edit.png" /></a></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=places&tab=3&stateDelete=<?=$row['cid']?>"><img src="images/page_white_delete.png" /></a></td>

			</tr>

		<?}?>

	</table>

	</div>