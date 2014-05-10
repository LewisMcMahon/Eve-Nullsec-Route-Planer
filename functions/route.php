<?php
function getRoute($from,$to)
{
    
    include("inc/db.inc.php");
              
    $plan='';
    $route=array();       
    
    function graph_find_path( &$G, $A, $B, $M = 50000 )
    {
        // $P will hold the result path at the end.
        // Remains empty if no path was found.
        $P = array();
        
        // For each Node ID create a "visit information",
        // initially set as 0 (meaning not yet visited)
        // as soon as we visit a node we will tag it with the "source"
        // so we can track the path when we reach the search target
        
        $V = array();
        
        // We are going to keep a list of nodes that are "within reach",
        // initially this list will only contain the start node,
        // then gradually expand (almost like a flood fill)
        $R = array( trim($A) );
        
        $A = trim($A);
        $B = trim($B);
        
        while ( count( $R ) > 0 && $M > 0 )
        {
            
            $M--;
            $X = trim(array_shift( $R ));
            
            foreach( $G[$X] as $Y )
            {
                $Y = trim($Y);
                // See if we got a solution
                if ( $Y == $B )
                {
                    // We did? Construct a result path then
                    array_push( $P, $B );
                    array_push( $P, $X );
                    while ( $V[$X] != $A )
                    {
                        array_push( $P, trim($V[$X]) );
                        $X = $V[$X];
                    }
                    array_push( $P, $A );
                    return array_reverse( $P );
                }
                    // First time we visit this node?
                if ( !array_key_exists($Y, $V) )
                {
                // Store the path so we can track it back,
                $V[$Y] = $X;
                // and add it to the "within reach" list
                array_push( $R, $Y );
                }
            }
        }
        
        return $P;
    }
    
    //Poulating the jump array from jump list 
    $jumpArray = array();
    
    $query="SELECT fromSolarSystemID,toSolarSystemID FROM mapsolarsystemjumplists";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    
    $previousSystem = "";
    $arrayContent = "";
    
    while ($row=$stmt->fetchObject()) 
    {
        $systemId = trim($row->fromSolarSystemID);
        $jumpArray[$systemId] = explode(",", $row->toSolarSystemID);
    }
    
    //adding the jump bridges to the list
    
    $query="SELECT system1,system2 FROM jumpbridges";
    $stmt = $dbh->prepare($query);
    $stmt->execute();    
    while ($row=$stmt->fetchObject()) 
    {
        $system1 = trim($row->system1);
        $system2 = trim($row->system2);
        array_push($jumpArray[$system1],$system2);
        array_push($jumpArray[$system2],$system1);
    }
 
    $jumpNum = 1;
    
    foreach( $jumpArray[$from] as $n ) {
        if ($n == $to) {
            $jumpNum = 2;
            $route[] = "$to";
            break;
        }
    }
    
    if ($jumpNum == 1) {
        foreach( graph_find_path( $jumpArray, $from, $to ) as $n ) {
            if ($jumpNum > 1) {
                $route[]=  $n;
            }
            $jumpNum++;
        }
    }
    
    return $route;
}

function getRouteData($route){
    include("inc/db.inc.php");

    $i = 0;
    $jumps = array();
    
    while($i < (count($route)-1)){
          
        $query="SELECT planet1,moon1,system1,system2 FROM jumpbridges WHERE system1 = ".$route[$i]." AND system2 = ".$route[$i+1]." ";        
        $stmt = $dbh->prepare($query);
        $stmt->execute();        
        $result = $stmt->fetch();     
        
        if ($count = $stmt->rowCount() > 0)
        {
            $jumps[$i]["current"] = $result["system1"];
            $jumps[$i]["next"] = $result["system2"];
            $jumps[$i]["type"] = "jb";
            $jumps[$i]["planet"] = $result["planet1"];
            $jumps[$i]["moon"] = $result["moon1"];
            
            $i++;
            continue;
            
        }
        $query="SELECT planet2,moon2,system1,system2 FROM jumpbridges WHERE system2 = ".$route[$i]." AND system1 = ".$route[$i+1]." ";        
        $stmt = $dbh->prepare($query);
        $stmt->execute();        
        $result = $stmt->fetch();
        if ($count = $stmt->rowCount() > 0)
        {
            $jumps[$i]["current"] = $result["system2"];
            $jumps[$i]["next"] = $result["system1"];
            $jumps[$i]["type"] = "jb";
            $jumps[$i]["planet"] = $result["planet2"];
            $jumps[$i]["moon"] = $result["moon2"];
            
            $i++;
            continue;
            
        }
         
        $jumps[$i]["current"] = $route[$i];
        $jumps[$i]["next"] = $route[$i+1];
        $jumps[$i]["type"] = "ga";
        $jumps[$i]["planet"] = "";
        $jumps[$i]["moon"] = "";
        
        $i++;
    
    }
    
    return $jumps;
}
?>
