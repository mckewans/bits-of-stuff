/* Create an image gallery divisible by a set col width - this version hard-codes the spacing but you can use css instead */

<table width="508" border="0" cellpadding="0" cellspacing="0" id="thumbs">
	
	<?php 	

	mysql_select_db($database_XXX, $XXX);
	$query_getImages = "SELECT * FROM images";
	$getImages = mysql_query($query_getImages, $XXX) or die(mysql_error());
	$row_getImages = mysql_fetch_assoc($getImages);
	$totalRows_getImages = mysql_num_rows($getImages);

	/* put the elements into separate arrays  */
	
	do {
 	$img[] =  $row_getImages['name']; 
 	$title[] =  $row_getImages['title'];
  	$id[]  =  $row_getImages['id'];
 	} while ($row_getImages = mysql_fetch_assoc($getImages));

		$tds = 3; /* how many cols */
		$total = $totalRows_getImages; /* how many images */
		$trs = ceil($total/$tds); /* divide the total images by your cols ($tds) to get a row count */
		$add = 0;
		$a = 1;

		/* Start looping to generate the items */
		
		while ($a <= $trs) {

 		?> 
<TR>
		<? 
		$b = 1;

		while (($b <= $tds) & ($add != $total))  { 

		?>

<TD>
<a href="gallery.php?GID=<?php echo $id[$add]; ?>" accesskey="<? echo "$add"+1; ?>">
<img src="../GRAPHICS/header_pictures/<?php echo $img[$add]; ?>" title="<?php echo $title[$add]; ?>" height="69" width="69" style="margin-top:7px;"/>
</a>
</TD>
		<? $add++; $b++; 
		}  ?>
</TR>
		<? $a++; 
		}  ?> 
	   
</table>

/* Robert Gage-Smith (www.robgs-online.com) */