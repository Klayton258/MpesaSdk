<?php
/**
 * @author Klayton R. Massango <klayton0304massango@gmail.com>
 * @license http://mit-license.org/
 * @link https://github.com/Klayton258
 * @copyright Klayton Massango
 */

return [

    'public_key' => '<YOUR PUBLIC KEY>',
    'api_host' => 'api.sandbox.vm.co.mz',
    'api_key' => '<YOUR API KEY>',
    'origin' => 'developer.mpesa.vm.co.mz',
    'service_provider_code' => '<YOUR SERVICE PROVIDER CODE>',

    /**
     * C2B params
     * @param API PORT
     * @param API URL
     */
    'c2b_api_port'=>'18352',
    'c2b_api_path'=>'/ipg/v1x/c2bPayment/singleStage/',
    //========================================

    /**
     * B2C params
     * @param API PORT
     * @param API URL
     */
    'b2c_api_port'=>'18345',
    'b2c_api_path'=>'/ipg/v1x/b2cPayment/',
    //========================================

    /**
     * B2B params
     * @param API PORT
     * @param API URL
     */
    'b2b_api_port'=>'18349',
    'b2b_api_path'=>'/ipg/v1x/b2bPayment/',
    //========================================

];
