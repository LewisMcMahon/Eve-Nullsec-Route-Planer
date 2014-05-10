<?

include ("functions/route.php");
include ("functions/insertData.php");
include ("functions/eveTranslation.php");

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
    <form method="get">
        <input type="text" name="from" value="From" class="locationSelect" />
        <input type="text" name="to" value="To" class="locationSelect" />
        <input type="submit" value="Submit">
    </form>
    
    <?
    
    if (isset($_GET['from']) and isset($_GET['to'])){
        
        $from = getSystemId($_GET['from']);
        $to = getSystemId($_GET['to']);
        
        if ($from != false and $to != false){
        
            $route = getRoute($from,$to);
            
            $routeData = getRouteData($route);
            
            print "From: ".getSystemName($from)." To: ".getSystemName($to)." ".count($routeData)." Jumps";
            
            foreach ($routeData as $jump ) {
                print "<div id='".getSystemName($jump["current"])."' class='systemNavPoint'";
                   print "<p>";
            	       print getSystemName($jump["current"]);
                    print "</p>";
                    if ($jump["type"] == "jb"){
                        print "<p>";
                            print "Jump Bridge To: ".getSystemName($jump["next"])." Planet: ".$jump["planet"]." Moon: ".$jump["moon"];
                        print "</p>";
                    }
                    else{
                        print "<p>";
                            print "Gate To: ".getSystemName($jump["next"]);
                        print "</p>";
                    }
                print "</div>";
                
            }        
        }
        else{
            
            print "Enter valid system names";
        }
    }
    ?>
    
    <script>
        
        $(document).ready(function() {
    
            function log(message) {
    
                $("<div/>").text(message).prependTo("#log");
    
                $("#log").scrollTop(0);
    
            }​
            
            $(".locationSelect").autocomplete({
    
                source : "ajax/locationSuggest.php",
    
                minLength : 2,
    
                select : function(event, ui) {
    
                    log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);
    
                }
    
            });
    
        });
        
    </script>
    </div>
</body>
</html>