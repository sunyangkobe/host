<?
/*
 * 2012 Jan 27
* Web Host interface system
*
* Update user info
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

if (!isset($_GET["uid"])) exit(0);
if (!isset($session->varified) || !$session->varified) movePage(301, "index.php?action=classmates");

$session->user = User::searchBy(array("uid" => $_GET["uid"]));
if ($session->user) {
	?>
<div style="margin: 25px">
	<h2>更新资料</h2>
	<p style="color: red; margin-top: 0px">备注：如有不可更新资料错误，请联系孙洋。</p>
	<?php
	if (isset($session->errmsg) && $session->errmsg != "") {
		echo "<p style='color: red; margin-top: 0px'>错误：" . $session->errmsg . "</p>";
		unset($session->errmsg);
	}
	?>
	<br /><br />
	<form method="POST" id="updateform" class="updateform" action="index.php?action=process">
		<div align="center">
			<table style="width: 400px">
				<tr>
					<td>姓名：</td>
					<td><?php echo $session->user->getName()?></td>
				</tr>
				<tr>
					<td>Email：</td>
					<td><input type="text" size="30" name="email"
						value="<?php echo isset($session->email) ? $session->email : $session->user->getEmail()?>" /></td>
				</tr>
				<tr>
					<td>联系电话：</td>
					<td><input type="text" size="20" name="phone"
						value="<?php echo isset($session->phone) ? $session->phone : $session->user->getPhone()?>" /></td>
				</tr>
				<tr>
					<td>QQ：</td>
					<td><input type="text" size="15" name="qq"
						value="<?php echo isset($session->qq) ? $session->qq : $session->user->getQQ()?>" /></td>
				</tr>
				<tr>
					<td>同桌：</td>
					<td><select name="deskmate">
						<option></option>
					<?php
					$sql = "SELECT name FROM USERS ORDER BY ename ASC";
					$allusers = $db->fetch_array($sql);
					foreach ($allusers as $e) {
						if (isset($session->deskmate) && $e["name"] == $session->deskmate) {
							echo "<option selected='selected' value='" . $e["name"] . "'>" . $e["name"] . "</option>";
						} else if ($e["name"] == $session->user->getDeskmate()) {
							echo "<option selected='selected' value='" . $e["name"] . "'>" . $e["name"] . "</option>";
						} else {
							echo "<option value='" . $e["name"] . "'>" . $e["name"] . "</option>";
						}
					}
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td>所在地：</td>
					<td><input type="text" size="15" name="location"
						value="<?php echo isset($session->location) ? $session->location : $session->user->getLocation()?>" /></td>
				</tr>
				<tr>
					<td>
						<br /><br />
						<input type="submit" name="confirm" value="确认" />
					</td>
					<td>
						<br /><br />
						<input type="submit" name="back" value="返回" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>

<?php
} else {
	exit(0);
}

ob_end_flush();
Database::obtain()->close();
?>