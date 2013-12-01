<?php
if ($handle = opendir('c69')) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != ".." && $file != ".svn") {
          	$thelist .= '<li><a href="c69/'.$file.'">'.$file.'</a></li>';
        }
    }
	closedir($handle);
}
?>

<div style="margin: 25px">
	<h2>CSCC69H: Tutorial Slides &amp; Sample Tests</h2>
	<ul style="color:#666666;">
		<?php echo $thelist?>
	</ul>
</div>