<script type="text/javascript">
function run() {
	var i = document.getElementById("sec");
	if (i.innerHTML * 1 > 0)
		i.innerHTML = i.innerHTML * 1 - 1;
	else if (i.innerHTML * 1 == 0)
		window.location="../index.php";
}
window.setInterval("run();", 1000);
</script>
<div align="center">
<img src="../images/404error.jpg" height="236px" width="450px" style="margin: 50px 0">
<h3> Redirecting to Homepage in <span id="sec">5</span> secs... </h3>
</div>