<?php

/**
 * Nothing too fancy just, serves as the main entry for all request to this middle
 * once the request is made it will help process the request body and
 * communicate with our express server over api call 
 * 
 * @author jordan.wynne <jordan.q.wynne@gmail.com>
 */

use PockerEval\PockerEvalutor;
require dirname(__DIR__) . '/vendor/autoload.php';

$oRequestData = file_get_contents('php://input');
$aRequestData = json_decode($oRequestData, true);
if (isset($aRequestData)) {
    $oPockerEval = new PockerEvalutor();
    $aReturn = $oPockerEval->handlePockerEvalution($aRequestData);
    echo json_encode($aReturn);
    return;
}
echo json_encode(['body' => 'missing request data']);