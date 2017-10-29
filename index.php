<?php
$client = new SoapClient("http://www.webservicex.net/length.asmx?WSDL");

//print_r($client);

$functions = $client->__getFunctions();

var_dump($functions);

/*
foreach ($functions as $func) {
    echo $func . "<br />";
}
*/
$types = $client->__getTypes();

/*
foreach ($types as $typ) {
    echo  $typ . "<br />";
}
*/
$parametersToSoap = array('LengthValue' => 10,
'fromLengthUnit' => 'Kilometers', 'toLengthUnit' => 'Millimeters');

$resultWrapped = $client->ChangeLengthUnit($parametersToSoap);
$result = $resultWrapped->ChangeLengthUnitResult;
/*
echo $result;
//var_dump($types);

echo "<br />";
//var_dump($types->Lengths);
*/


require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('index.html.twig');

$parametersToTwig = array('functions' => $functions, 'types' => $types, 'result' => $result);
echo $template->render($parametersToTwig);

