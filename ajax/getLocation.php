<?
    //TODO remove hardcoded system
    //$_SERVER['HTTP_EVE_SOLARSYSTEMNAME']= "Baratar";
    
    if(isset($_SERVER['HTTP_EVE_SOLARSYSTEMNAME'])){
                
        $return = array('solarSystem'=>$_SERVER['HTTP_EVE_SOLARSYSTEMNAME']);
        
        echo json_encode($return);
        
    }    

?>