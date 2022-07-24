<?php

use Say7ama\MpesaSdk\Http\Transactions\MpesaTransactions;

$transaction = new MpesaTransactions();

$data =
[
    'from' => '',       // Customer MSISDN
    'reference' => '',      // Third Party Reference
    'transaction' => '', // Transaction Reference
    'amount' => ''          // Amount
];

$result = $transaction->C2BPayment($data);

if($result['success'])
{
    // do something...
}
