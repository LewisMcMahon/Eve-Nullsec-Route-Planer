<?
function getSystemName($systemId)
{    
    include("inc/db.inc.php");
    
    $query="SELECT solarSystemName FROM mapsolarsystems WHERE SolarSystemID = :system";
            
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        ':system' => $systemId));
    
    if ($count = $stmt->rowCount() < 1){
        
        return false;
        
    }
    else{
        $row=$stmt->fetchObject();
        
        $systemName = trim($row->solarSystemName);
        
        return $systemName;
    }
}

function getSystemID($systemName)
{    
    include("inc/db.inc.php");
    
    $query="SELECT solarSystemID FROM mapsolarsystems WHERE solarSystemName = :system";
            
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        ':system' => $systemName));
    
    if ($count = $stmt->rowCount() < 1){
        
        return false;
        
    }
    else{
    
        $row=$stmt->fetchObject();
        
        $systemID = trim($row->solarSystemID);
        
        return $systemID;
        
    }
}

function getSystemSecurity($systemId)
{    
    include("inc/db.inc.php");
    
    $query="SELECT security FROM mapsolarsystems WHERE SolarSystemID = :system";
            
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        ':system' => $systemId));
    
    if ($count = $stmt->rowCount() < 1){
        
        return false;
        
    }
    else{
        $row=$stmt->fetchObject();
        
        $systemSecurity = trim($row->security);
                
        if($systemSecurity < 0){
            $systemSecurity = 0.0;
        }
        else{
            $systemSecurity = round($systemSecurity, 1);
        }
        
        return $systemSecurity;
    }
}


function getHeaderInfo()

{

    $headerinfo = "";

    if (strpos($_SERVER ['HTTP_USER_AGENT'], 'EVE-IGB'))

    {
        $headerinfo['HTTP_USER_AGENT'] = "EVE-IGB";

        if(isset($_SERVER['HTTP_EVE_TRUSTED'])){$headerinfo['HTTP_EVE_TRUSTED'] = $_SERVER['HTTP_EVE_TRUSTED'];}
        if(isset($_SERVER['HTTP_EVE_SOLARSYSTEMNAME'])){$headerinfo['HTTP_EVE_SOLARSYSTEMNAME'] = $_SERVER['HTTP_EVE_SOLARSYSTEMNAME'];}
        if(isset($_SERVER['HTTP_EVE_SOLARSYSTEMID'])){$headerinfo['HTTP_EVE_SOLARSYSTEMID'] = $_SERVER['HTTP_EVE_SOLARSYSTEMID'];}    
        

    }

    else{
        $headerinfo['HTTP_USER_AGENT'] = "NOT-EVE-IGB";
    }

    return $headerinfo;           

}  
?>