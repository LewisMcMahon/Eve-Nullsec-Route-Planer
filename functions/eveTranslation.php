<?
function getSystemName($systemId)
{    
    include("inc/db.inc.php");
    
    $query="SELECT solarSystemName FROM mapsolarsystems WHERE SolarSystemID = ".$systemId."";
            
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    
    $row=$stmt->fetchObject();
    
    $systemName = trim($row->solarSystemName);
    
    return $systemName;
}

function getSystemID($systemName)
{    
    include("inc/db.inc.php");
    
    $query="SELECT solarSystemID FROM mapsolarsystems WHERE solarSystemName = '".$systemName."'";
            
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    
    $row=$stmt->fetchObject();
    
    $systemID = trim($row->solarSystemID);
    
    return $systemID;
}  
?>