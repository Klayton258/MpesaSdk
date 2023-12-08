<?php

/**
 * @author Klayton R. Massango <klayton0304massango@gmail.com>
 * @license http://mit-license.org/
 * @link https://gitHub.com/Klayton258
 * @copyright Klayton Massango
 */

namespace Say7ama\mpesa\Http\Transactions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Http;

class MpesaTransactions extends Controller
{
    private $public_key;
    private $api_key;
    private $api_host;
    private $api_port;
    private $api_path;
    private $origin;
    private $service_provider_code;


    /**
     * Global params from configurations
     * @param Api Host
     * @param Api Key
     * @param Api Public Key
     * @param Api Origin
     */
    public function __construct()
    {
        $this->api_host = config('mpesa.api_host');
        $this->api_key = config('mpesa.api_key');
        $this->public_key = config('mpesa.public_key');
        $this->origin = config('mpesa.origin');
        $this->service_provider_code = config('mpesa.service_provider_code');
    }

    /**
     * Initiates a C2B transaction on the M-Pesa API.
     * @param $amount
     * @param $from
     * @param $reference
     * @param $third_party_reference
     * @return Api Response
     * @return Exception
     */

    public function C2BPayment($data)
    {

        try {
            $this->api_port = config('mpesa.c2b_api_port');
            $this->api_path = config('mpesa.c2b_api_path');

            $response = Http::timeout(50)->withHeaders([
                'Content-Type'=>' application/json',
                'Origin' => $this->origin,
                'Authorization'=> $this->getBearerToken()
            ])->post(
                'https://'. $this->api_host .':'.$this->api_port. $this->api_path,
                [
                    'input_ServiceProviderCode' => $this->service_provider_code,
                    'input_CustomerMSISDN' => $data['from'],
                    'input_Amount' => $data['amount'],
                    'input_TransactionReference' => $data['transaction'],
                    'input_ThirdPartyReference' => $data['reference']
                ]
            );

            /**
             * Response SuccessFull
             * @return response as json
             */
            if($response->successful())
            {
              return  $this->responseMessage(false, true, $response->getStatusCode(), $response->json());
            }

            /**
             * Exception
             * @return Exception
             */
            elseif($response->throw())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Failed
             * @return  error
             */
            elseif($response->failed())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Client Error
             * @return client error
             */
            elseif($response->clientError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Server Error
             * @return server error
             */
            elseif($response->serverError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

        } catch (\Exception $t) {
            try {
                return  $this->responseMessage(true, false, $t->getCode(),$response->json());
            } catch (\Throwable $th) {
                return  $this->responseMessage(true, false, $t->getCode(),'');
            }

        }

    }

    /**
     * Initiates a B2C transaction on the M-Pesa API.
     * @param $amount
     * @param $from
     * @param $reference
     * @param $third_party_reference
     * @return Api Response
     * @return Exception
     */

    public function B2CPayment($data){

        try{
            $this->api_port = config('mpesa.b2c_api_port');
            $this->api_path = config('mpesa.b2c_api_path');

            $response = Http::timeout(50)->withHeaders([
                'Content-Type'=>' application/json',
                'Origin' => $this->origin,
                'Authorization'=> $this->getBearerToken()
            ])->withOptions(
                [
                    'connect_timeout'=> 59
                ]
            )->post(
                'https://'. $this->api_host .':'.$this->api_port. $this->api_path,
                [
                    "input_TransactionReference"=> $data['transaction'],
	                "input_CustomerMSISDN"=> $data['to'],
	                "input_Amount"=> $data['amount'],
	                "input_ThirdPartyReference"=> $data['reference'],
	                "input_ServiceProviderCode"=> $this->service_provider_code,
                ]
            );

            /**
             * Response SuccessFull
             * @return response as json
             */
            if($response->successful())
            {
              return  $this->responseMessage(false, true, $response->getStatusCode(), $response->json());
            }

            /**
             * Exception
             * @return Exception
             */
            elseif($response->throw())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Failed
             * @return  error
             */
            elseif($response->failed())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Client Error
             * @return client error
             */
            elseif($response->clientError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Server Error
             * @return server error
             */
            elseif($response->serverError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

        } catch (\Exception $t) {
            try {
                return  $this->responseMessage(true, false, $t->getCode(),$response->json());
            } catch (\Throwable $th) {
                return  $this->responseMessage(true, false, $t->getCode(),'');
            }

        }

    }

    /**
     * Initiates a B2B transaction on the M-Pesa API.
     * @param $amount
     * @param $to
     * @param $reference
     * @param $third_party_reference
     * @return Api Response
     * @return Exception
     */

    public function B2BPayment($data){
        try{
            $this->api_port = config('mpesa.b2b_api_port');
            $this->api_path = config('mpesa.b2b_api_path');

            $response = Http::timeout(50)->withHeaders([
                'Content-Type'=>' application/json',
                'Origin' => $this->origin,
                'Authorization'=> $this->getBearerToken()
            ])->withOptions(
                [
                    'connect_timeout'=> 59
                ]
            )->post(
                'https://'. $this->api_host .':'.$this->api_port. $this->api_path,
                [
                    "input_TransactionReference"=> $data['transaction'],
	                "input_Amount"=> $data['amount'],
	                "input_ThirdPartyReference"=> $data['reference'],
	                "input_PrimaryPartyCode"=> $this->service_provider_code,
	                "input_ReceiverPartyCode"=> $data["to"] //979797
                ]
            );

            /**
             * Response SuccessFull
             * @return response as json
             */
            if($response->successful())
            {
              return  $this->responseMessage(false, true, $response->getStatusCode(), $response->json());
            }

            /**
             * Exception
             * @return Exception
             */
            elseif($response->throw())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Failed
             * @return  error
             */
            elseif($response->failed())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Client Error
             * @return client error
             */
            elseif($response->clientError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

            /**
             * Response Server Error
             * @return server error
             */
            elseif($response->serverError())
            {
                return  $this->responseMessage(true, false, $response->getStatusCode(), $response->json());
            }

        } catch (\Exception $t) {
            try {
                return  $this->responseMessage(true, false, $t->getCode(),$response->json());
            } catch (\Throwable $th) {
                return  $this->responseMessage(true, false, $t->getCode(),'');
            }

        }

    }

    /**
     * Generate Bearer Token using api public key
     * @return Bearer Token
     */
    public function getBearerToken(): string
    {
        $publickey = "-----BEGIN PUBLIC KEY-----\n";
        $publickey .= wordwrap($this->public_key, 60, "\n", true);
        $publickey .= "\n-----END PUBLIC KEY-----";

        $key = openssl_get_publickey($publickey);
        openssl_public_encrypt($this->api_key, $token, $key, OPENSSL_PKCS1_PADDING);

        return 'Bearer ' . base64_encode($token);
    }


    /**
     * Return Response as Array including boolean params
     * @param bool success
     * @param bool error
     * @return Response as Array
     */
    public static function responseMessage($error, $success, $code, $data = '')
    {
        return
            [
                'message' => $data['output_ResponseDesc'] ?? '',
                'Statuscode' => $code,
                'success' => $success,
                'error' => $error,
                'data' => [
                    'code' => $data['output_ResponseCode'] ?? '',
                    'description' => $data['output_ResponseDesc'] ?? '',
                    'transactionId' => $data['output_TransactionID'] ?? '',
                    'conversationId' => $data['output_ConversationID'] ?? '',
                    'thirdPartReference' => $data['output_ConversationID'] ?? '',
                    'TransactionStatus' => $data['output_ResponseTransactionStatus'] ?? '',
                ]
            ];
    }
}
