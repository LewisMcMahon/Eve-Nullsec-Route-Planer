<?

$term = $_GET['term'];

$term = mysql_real_escape_string($term);

$term = $term."%";

$q = strtolower($term);

$return = array();


include("../inc/db.inc.php");

$query="select solarSystemName from mapsolarsystems where solarSystemName like :system LIMIT 10";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
        ':system' => $term));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

	array_push($return,array('label'=>$row['solarSystemName'],'value'=>$row['solarSystemName']));

}

echo json_encode($return);	


?>