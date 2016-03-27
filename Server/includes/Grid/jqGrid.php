<?php 
//include the information needed for the connection to MySQL data base server. 
// we store here username, database and password 
require_once '../Auth/config.php';

// to the url parameter are added 4 parameters as described in colModel
// we should get these parameters to construct the needed query
// Since we specify in the options of the grid that we will use a GET method 
// we should use the appropriate command to obtain the parameters. 
// In our case this is $_GET. If we specify that we want to use post 
// we should use $_POST. Maybe the better way is to use $_REQUEST, which
// contain both the GET and POST variables. For more information refer to php documentation.
// Get the requested page. By default grid sets this to 1. 
$page = $_GET['page']; 
 
// get how many rows we want to have into the grid - rowNum parameter in the grid 
$limit = $_GET['rows']; 
if(!$limit) $limit = 10; 
// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel 
$sidx = $_GET['sidx']; 
 
// sorting order - at first time sortorder 
$sord = $_GET['sord']; 
if(!$sord) $sord = "DESC";
// if we not pass at first time index use the first column for the index or what you want
if(!$sidx) $sidx =1; 
 
// connect to the MySQL database server 
$db = mysqli_connect($db_host, $db_user, $db_pass) or die("Connection Error: " . mysqli_error()); 
 
// select the database 
mysqli_select_db($db, $db_base) or die("Error connecting to db."); 
 
// calculate the number of rows for the query. We need this for paging the result 
$result = mysqli_query($db, "SELECT COUNT(*) AS count FROM ". $db_table); 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
$count = $row['count']; 
 
// calculate the total pages for the query 
if( $count > 0 && $limit > 0) { 
              $total_pages = ceil($count/$limit); 
} else { 
              $total_pages = 0; 
} 
 
// if for some reasons the requested page is greater than the total 
// set the requested page to total page 
if ($page > $total_pages) $page=$total_pages;
 
// calculate the starting position of the rows 
$start = $limit*$page - $limit;
 
// if for some reasons start position is negative set it to 0 
// typical case is that the user type 0 for the requested page 
if($start <0) $start = 0; 
 
// the actual query for the grid data 
$SQL = "SELECT id, name, email FROM ". $db_table ." ORDER BY $sidx $sord LIMIT $start , $limit"; 
//$SQL = "SELECT id, name, email FROM ". $db_table;
$result = mysqli_query($db, $SQL) or die("Couldn't execute query.".mysqli_error($db)); 

// Заголовок с указанием содержимого.
header("Content-type: text/xml;charset=utf-8");
 
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";
 
// Обязательно передайте текстовые данные в CDATA
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $s .= "<row id='". $row['id']."'>";            
    $s .= "<cell>". $row['id']."</cell>";
    $s .= "<cell>". $row['name']."</cell>";
    $s .= "<cell>". $row['email']."</cell>";
    $s .= "</row>";
}
$s .= "</rows>"; 
 
echo $s;

?>