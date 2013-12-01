<?php
/*
 * 2012 Jan 27
* Web Host interface system
*
* Contact info display
*
* @author Kobe Sun
*
*/

include_once("includes.php");

$session = Session::getInstance();
$session->startSession();

Database::obtain()->connect();
# This will ensure that cookie will be set before the header is sent
ob_start();
?>
<link rel="stylesheet" media="screen" href="css/table-sorter.css" />
<div style="margin: 25px">
	<h2>我们太强了！通讯录</h2>
	<?php 
	$session->varified |= isset($_POST["answer"]) && $_POST["answer"] == "王志文";
	if ($session->varified) {
		?>
		<script type="text/javascript" src="js/table-sorter.js"></script>
		<script type="text/javascript">
		window.addEvent('domready',function(){
			sorter = new TableSorter({
				request: 'action',
				page: 'pages/listStudents.php',
				destination: 'XhrDump',
				prev: 'PagePrev',
				next: 'PageNext',
				head: 'GeoHead',
				rows: 12,
				defaultStartEndWaitEnabled: 1,
				startWait: '',
				endWait: ''
			});
		});
		</script>
		
		<span style="color: red;margin: 0px">备注：</span>
		<ol style="color: red;margin-top: 0px; margin-bottom: 0px;">
			<li>点击姓名进行修改 ;</li>
			<li>本站点仅支持IE9, Chrome, Firefox, Safari, Opera浏览器，暂不支持IE8及以前版本（我不是铁道部！），如遇任何问题，请更换浏览器。</li>	
		</ol>
		<div id="XhrDump">
			<?php
			echo User::genHtmlTableStr(0);
			?>
		</div>
		<?php 
	} elseif (isset($_POST["answer"]) && $_POST["answer"] != "王志文") {
		?>
		<div style="text-align: center; margin-top: 100px;">
			<h4 style="color: red;">答案不对哎。。。再试试吧</h4>
			<h3>请回答问题以便继续访问：我们的班主任像哪个明星？（三个字）</h3>
			<form name="valform" id="valform" method="POST" action="index.php?action=classmates">
				答案：<input type="text" name="answer" id="answer" value="<?php echo $_POST["answer"]?>"/>
				<input type="submit" name="submit" id="submit" value="提交">
			</form>
		</div>
		<?php 
	} else {
		?>
		<div style="text-align: center; margin-top: 100px;">
			<h3>请回答问题以便继续访问：我们的班主任像哪个明星？（三个字）</h3>
			<form name="valform" id="valform" method="POST" action="index.php?action=classmates">
				答案：<input type="text" name="answer" id="answer" value="<?php echo $_POST["answer"]?>"/>
				<input type="submit" name="submit" id="submit" value="提交">
			</form>
		</div>
		<?php 
	}
	?>
</div>


<?php
ob_end_flush();
Database::obtain()->close();
?>