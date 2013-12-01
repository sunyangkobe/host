<?
/*
 * 2012 Jan 27
 * Web Host interface system
 *
 * List user Controller
 *
 * @author Kobe Sun
 *
 */

include_once("../includes.php");

Database::obtain()->connect();
echo User::genHtmlTableStr($_GET['start'], $_GET['orderBy']);
Database::obtain()->close();
?>