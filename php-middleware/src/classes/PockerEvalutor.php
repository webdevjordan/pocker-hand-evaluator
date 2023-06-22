<?php

namespace PockerEval;
use PockerEval\ApiCallService;

/**
 * Main responsibility of this class is to handle the pocker evalutions,
 * format the hand and then attempt to make api call
 * 
 * @author jordan.wynne<jordan.q.wynne@gmail.com>
 */
class PockerEvalutor
{
    /**
     * @param array $aDataPacket
     * @return array
     */
    public function handlePockerEvalution($aCardDataPacket)
    {
        $aResult = array();

        // check if we have a data card packet
        if (!isset($aCardDataPacket)) {
            $aResult['status'] = 400;
            $aResult['body'] = 'missing data required';
            return $aResult;
        }

        // format the card data packet by removing key names
        $aFormatedCardDataPacket =  array_values($aCardDataPacket);
        if (count($aFormatedCardDataPacket) < 4) {
            $aResult['status'] = 400;
            $aResult['body'] = 'Invalid card count';
        }
        
        // make the api call using the api call service
        $oApiCall = new ApiCallService($aFormatedCardDataPacket);
        $aResult  = $oApiCall->doApiCall();
        unset($oApiCall);

        // return something
        return $aResult;
    }

}