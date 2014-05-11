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
        <div id="form" class="systemNavPoint">
            <form method="get">
                <input type="text" name="from" value="<?if(isset($_SERVER['HTTP_EVE_SOLARSYSTEMNAME'])){print $_SERVER['HTTP_EVE_SOLARSYSTEMNAME'];}else{print"From";} ?>" class="locationSelect" />
                <input type="text" name="to" value="To" class="locationSelect" />
                <input type="submit" value="Submit">
            </form>
        </div>
        
        <?
        
        if (isset($_GET['from']) and isset($_GET['to'])){
            
            $from = getSystemId($_GET['from']);
            $to = getSystemId($_GET['to']);
            
            if ($from != false and $to != false){
            
                $route = getRoute($from,$to);
                
                $routeData = getRouteData($route);
                
                print "<div class='systemNavPoint'>";
                
                   print "From: ".getSystemName($from)." To: ".getSystemName($to)." ".count($routeData)." Jumps";
                
                print "</div>";
                
                if(isset($headerinfo['HTTP_EVE_SOLARSYSTEMNAME'])){
                    
                    print "<div>";
                        print "Currently In: ".$headerinfo['HTTP_EVE_SOLARSYSTEMNAME'];
                    print "</div>";
                }                
                
                foreach ($routeData as $jump ) {
                    ?>
                        <div id='<?print getSystemName($jump["current"])?>' class='systemNavPoint'>
                            <table width="100%">
                                <tr>
                                    <td width="70%">
                                        <?print getSystemName($jump["current"])." ";
                                        
                                        print "<span style='color:".secStatusColor($jump["security"])."'>".$jump["security"]."</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" onclick="$(this).closest('.systemNavPoint').remove();">Done</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <?if ($jump["type"] == "jb"){                                            
                                            print "Jump Bridge To: ".getSystemName($jump["next"])." Planet: ".$jump["planet"]." Moon: ".$jump["moon"];                                            
                                        }
                                        else{
                                            if($headerinfo['HTTP_USER_AGENT'] == "EVE-IGB"){
                                                print "Gate To: <a href='#' onclick='CCPEVE.showInfo(5,".$jump["next"].")')>".getSystemName($jump["next"])."</a>";
                                            }else{
                                                print "Gate To: ".getSystemName($jump["next"]);
                                            }
                                        }?>                                        
                                    </td>
                                    <td style="text-align: right;">
                                        <span style='color:<?if($jump["shipKills"]>0){print"red";}?>;'><?print $jump["shipKills"]?></span> :Kills 
                                    </td>                                    
                                </tr>
                            </table>         
                         </div>
                    <?                   
                }        
            }
            else{
                
                print "<p>Enter valid system names</p>";
            }
        }

        
        ?>
        
        <script src="js/autoComplete.js"></script> 
    </div>
</body>
</html>