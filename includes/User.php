<?php
/*
 * 2012 Jan 27
 * Web Host interface system
 *
 * User Data Model
 *
 * @author Kobe Sun, Europa Shang
 *
 */

class User {

	private $uid = -1;
	private $name = "";
	private $email = "";
	private $qq = "";
	private $phone = "";
	private $deskmate = "";
	private $location = "";

	public function __construct($param) {
		$this->buildAttrs($param);
	}

	public function buildAttrs($param) {
		if (isset($param["uid"])) {
			$this->uid = $param["uid"];
		}
		if (isset($param["name"])) {
			$this->name = $param["name"];
		}
		if (isset($param["email"])) {
			$this->email = $param["email"];
		}
		if (isset($param["phone"])) {
			$this->phone = $param["phone"];
		}
		if (isset($param["qq"])) {
			$this->qq = $param["qq"];
		}
		if (isset($param["deskmate"])) {
			$this->deskmate = $param["deskmate"];
		}
		if (isset($param["location"])) {
			$this->location = $param["location"];
		}
		return true;
	}

	
	/**
	 * 
	 * Pass in some criteria to search for a user, return the user instance
	 * @param array $criteria
	 * @param string $operator
	 */
	public static function searchBy($criteria, $operator="=") {
		// Get user information
		$db = Database::obtain();
		$user_query = "SELECT * FROM `users` WHERE ";

		foreach ($criteria as $k => $v) {
			if(strtolower($v)=='null') $user_query.= "`$k` = NULL";
			elseif(strtolower($v)=='now()') $user_query.= "`$k` = NOW()";
			else $user_query.= "`$k`='".$db->escape($v)."'";
			$user_query .= " AND ";
		}
		$user_query = rtrim($user_query, " AND ");

		$user = $db->query_first($user_query);
		return $user ? new User($user) : false;
	}

	
	/**
	 * 
	 * update this user in the database
	 * @param array $new_attrs
	 */
	public function updateUser($new_attrs) {
		return Database::obtain()->update("users", $new_attrs, "uid=$this->uid");
	}

	/**
	 * 
	 * Check whether the user exists in an users array
	 * @param array $userArr
	 */
	public function userExists(array $userArr) {
		foreach ($userArr as $user) {
			if ($user->getUid() == $this->uid) {
				return true;
			}
		}
		return false;
	}
	
	
	/**
	*
	* Paging table that many views will get and share
	* @param int $startingFromRecord
	* 
	*/
	public static function genHtmlTableStr($startingFromRecord=0, $orderBy='ename ASC') {
	
		$startingFromRecord = (int) $startingFromRecord;
		$rowsPerPage = 12;
	
		$sql = "SELECT count(*) as count
				FROM users";
		$countArr = Database::obtain()->query_first($sql);
		$totalRows = $countArr['count'];
	
		if ($orderBy == '') $orderBy='ename ASC';
		$sql = "SELECT *
		FROM users
		ORDER BY
					$orderBy
		LIMIT
					$startingFromRecord,$rowsPerPage";
		$arr = Database::obtain()->fetch_array($sql);
	
		$str = '
		<table class="DefaultTable" style="width:750px;">
				' . TableSorter::returnMetaStr($startingFromRecord, $rowsPerPage
		, $totalRows, count($arr), $orderBy) . '
		<tr style="background:#FFF;"><td colspan="10" style="height:5px;">&nbsp;</td></tr>
				<tr id="GeoHead" class="DefaultTableHeader">
					<th width="50px" id="ename" title="' . (($orderBy == 'ename ASC') ? 'ename DESC' : 'ename ASC') . '">姓名</th>
					<th width="200px" id="email" title="' . (($orderBy == 'email ASC') ? 'email DESC' : 'email ASC') . '">邮箱</th>
					<th width="100px" id="phone" title="' . (($orderBy == 'phone ASC') ? 'phone DESC' : 'phone ASC') . '">电话</th>
					<th width="100px" id="qq" title="' . (($orderBy == 'qq ASC') ? 'qq DESC' : 'qq ASC') . '">QQ</th>
					<th width="50px" id="deskmate" title="' . (($orderBy == 'deskmate ASC') ? 'deskmate DESC' : 'deskmate ASC') . '">同桌</th>
					<th width="50px" id="location" title="' . (($orderBy == 'location ASC') ? 'location DESC' : 'location ASC') . '">所在地</th>
				</tr>
		';
			$x = 1;
			foreach($arr as $i)
		{
		$class = ($x%2) ? '' : 'zebra';
				$str .= 
		'<tr class="' . $class . '">
			<td><a href="index.php?action=updateuser&uid=' . $i['uid'] . '">' . $i['name'] . '</td>
			<td>' . $i['email'] . '</td>
			<td>' . $i['phone'] . '</td>
			<td>' . $i['qq'] . '</td>
			<td>' . $i['deskmate'] . '</td>
			<td>' . $i['location'] . '</td>
		</tr>';
				$x++;
			}
	
		$str .= '<tr style="background:#FFF;"><td colspan="10" style="height:5px;">&nbsp;</td></tr>';
			$str .= $meta . '</table>';
			
			return $str;
		}

	public function getUid() { return $this->uid; }
	public function getName() { return $this->name; }
	public function getEmail() { return $this->email; }
	public function getPhone() { return $this->phone; }
	public function getQQ() { return $this->qq; }
	public function getDeskmate() { return $this->deskmate; }
	public function getLocation() { return $this->location; }
	public function setUid($x) { $this->uid = $x; }
	public function setName($x) { $this->name = $x; }
	public function setEmail($x) { $this->email = $x; }
	public function setPhone($x) { $this->phone = $x; }
	public function setDeskmate($x) { $this->deskmate = $x; }
	public function setLocation($x) { $this->location = $x; }
}

?>