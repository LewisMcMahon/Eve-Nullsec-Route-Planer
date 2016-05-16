<?php
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


function getHeaderInfo($eve_headers) {

    $headerinfo = array();
    $headerinfo['EVE_TRUSTED'] = false;
    $headerinfo['HTTP_USER_AGENT'] = "NOT-EVE-IGB";

    if (strpos($_SERVER ['HTTP_USER_AGENT'], 'EVE-IGB') !== false)
    {
        $headerinfo['HTTP_USER_AGENT'] = "EVE-IGB";

        if(isset($eve_headers['EVE_TRUSTED']) && $eve_headers['EVE_TRUSTED'] == 'Yes'){
            $headerinfo['EVE_TRUSTED'] = true;
        }
        if(isset($eve_headers['EVE_SOLARSYSTEMNAME'])){
            $headerinfo['EVE_SOLARSYSTEMNAME'] = $eve_headers['EVE_SOLARSYSTEMNAME'];
        }
        if(isset($eve_headers['EVE_SOLARSYSTEMID'])){
            $headerinfo['EVE_SOLARSYSTEMID'] = $eve_headers['EVE_SOLARSYSTEMID'];
        }
    }

    return $headerinfo;
}
function secStatusColor($sec){    
    if($sec >= 1.0){
        return "#2FEFEF";
    }
    elseif($sec >= 0.9){
        return "#48F0C0";
    }
    elseif($sec >= 0.8){
        return "#00EF47";
    }
    elseif($sec >= 0.7){
        return "#00F000";
    }
    elseif($sec >= 0.6){
        return "#8FEF2F";
    }
    elseif($sec >= 0.5){
        return "#EFEF00";
    }
    elseif($sec >= 0.4){
        return "#D77700";
    }
    elseif($sec >= 0.3){
        return "#F06000";
    }
    elseif($sec >= 0.2){
        return "#F04800";
    }
    elseif($sec >= 0.1){
        return "#D73000";
    }
    elseif($sec >= 0.0){
        return "#F00000";
    }   
}  
?>