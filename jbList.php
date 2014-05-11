<?
include ("functions/route.php");
include ("functions/insertData.php");
include ("functions/eveTranslation.php");

$headerinfo = getHeaderInfo();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <script src="js/jquery.js"></script>  
    <script src="js/jquery-validate.js"></script>
    <script src="js/jquery-ui.js"></script>
    
    <link href="css/css.css" rel="stylesheet" type="text/css" />
    <link href="js/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css" />          
</head>

<body>
    <div id="container">
        <?
            
            $jumpBridges = getJumpBridges();
            
            foreach ($jumpBridges as $bridge){
                
                ?>
                <table width="500px">
                    <tr>
                        <td width="15%">
                            <? print getSystemName($bridge["system1"])?>
                        </td>
                        <td width="15%">
                            Planet: <? print $bridge["planet1"]?>
                        </td>
                        <td width="15%">
                            Moon: <? print $bridge["moon1"]?>
                        </td>
                        <td width="15%">
                            <? print getSystemName($bridge["system2"])?>
                        </td>
                        <td width="15%">
                            Planet: <? print $bridge["planet2"]?>
                        </td>
                        <td width="15%">
                            Moon: <? print $bridge["moon2"]?>
                        </td>
                    </tr>
                </table>
                
                <?
                
            }
        
        ?>
        
        <script src="js/autoComplete.js"></script> 
    </div>
</body>
</html>