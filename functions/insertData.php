<?
function addJumpBridge($s1,$s1p,$s1m,$s2,$s2p,$s2m)
{    
    include("inc/db.inc.php");
    
    $query="INSERT INTO jumpbridges (system1,planet1,moon1,system2,planet2,moon2) VALUES (:s1,:s1p,:s1m,:s2,:s2p,:s2m)";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        ':s1' => $s1,
        ':s1p' => $s1p,
        ':s1m' => $s1m,
        ':s2' => $s2,
        ':s2p' => $s2p,
        ':s2m' => $s2m
        ));
    return true;
}
?>