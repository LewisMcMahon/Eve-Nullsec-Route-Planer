<?

include ("functions/route.php");
include ("functions/insertData.php");
include ("functions/eveTranslation.php");

?>

<form method="get">
    <input type="text" name="from" value="From" />
    <input type="text" name="to" value="To" />
    <input type="submit" value="Submit">
</form>

<?

if (isset($_GET['from']) and isset($_GET['to'])){
    
    $from = getSystemName($_GET['from']);
    $to = getSystemName($_GET['to']);
    
    if ($from != false and $to != false){
    
        $route = getRoute($from,$to);
        
        $routeData = getRouteData($route);
        
        print "From: ".getSystemName($from)." To: ".getSystemName($to);
        
        foreach ($routeData as $jump ) {
            print "<div>";
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
            print "</divp>";
            
        }        
    }
    else{
        print "Enter valid system names";
    }
}
?>