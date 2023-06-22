<?php 

namespace PockerEval;

use Exception;
use GuzzleHttp\Client;

/**
 * This service will make calls to the express server
 * it uses guzzlehttp as the main api request faciliator
 * however it also has a fail over mech to use curl to make the requests 
 * 
 * @author jordan.wynne <jordan.q.wynne@gmail.com>
 */
class ApiCallService  {

    /** set some constants **/
    const CONNECT_TIMEOUT = 15;
    const ENDPOINT = 'http://localhost:3000/pocker-evaluator/api/v1/evaluate/hand';
    
    /** memember variables **/
    private $aDataPacket = array();
    private $oClient = null;

    /**
     * class constructor
     * @param array $aDataPacket
     */
    public function __construct($aDataPacket)
    {
        $this->aDataPacket = $aDataPacket;
        $this->oClient = new Client();
    }

    /**
     * make the api call to the express server
     *
     * @return array
     */
    public function doApiCall()
    {
        $aReturn = array();
        try {
            $oResponse = $this->oClient->post(
                self::ENDPOINT,
                [
                    'json' => $this->aDataPacket,
                    'timeout' => self::CONNECT_TIMEOUT
                ]
            );
            $aReturn['statusCode'] = $oResponse->getStatusCode();
            $aReturn['body'] = json_decode($oResponse->getBody(), true);
        } catch (Exception $e) {
            $aReturn = $this->useFailOverCurlRequest($this->aDataPacket);
        }
        return $aReturn;
    }

    /**
     * this will be used as a failover incase we have issues with guzzle
     *
     * @param arrary $aDataPacket
     * @return void
     */
    private function useFailOverCurlRequest($aDataPacket) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::ENDPOINT);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($aDataPacket));
            curl_setopt($ch, CURLOPT_TIMEOUT, self::CONNECT_TIMEOUT);
            $aResponse = curl_exec($ch);
            $iStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (isset($aResponse) && $iStatusCode < 500) {
                $aReturn['statusCode'] = $iStatusCode;
                $aReturn['body'] = $aResponse;
            }
            curl_close($ch);
        } catch (Exception $e) {
            error_log(__FUNCTION__ . ': ' . $e->getMessage());
            $aReturn['statusCode'] = 500;
            $aReturn['body'] = 'Err: Internal Server Error';
        }
        return $aReturn;
     
    }
}


?>