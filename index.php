<?

include ("functions/route.php");
include ("functions/insertData.php");
include ("functions/eveTranslation.php");

$route = getRoute(30004871,30004851);

$routeData = getRouteData($route);

//print getSystemName(30004871);

//print getSystemID('R1-IMO');

//addJumpBridge(getSystemID('46DP-O'),7,11,getSystemID('DZ6-I5'),5,14);

var_dump($routeData);



?>