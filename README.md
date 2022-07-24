# M-Pesa SDK, PHP, Laravel
Software Development Kit for mpesa api payments for laravel

[![Issues](https://img.shields.io/github/issues/Klayton258/MpesaSdk.svg?style=flat-square)](https://github.com/Klayton258/MpesaSdk/issues)

## Installation
Install using composer:
```bash
composer require say7ama/mpesa_sdk
```
## Usage

1. Use the command to publish the configuration file `Say7ama\MpesaSdk\MpesaServiceProvider`.
```bash
php  artisan vendor:publish
```

2. Open `config/mpesa.php` file and add the require credentials as supplied by M-Pesa Developer Portal.

3. Initiat transactions using:

```PHP
$transaction = new MpesaTransactions();
```
4. Choose the transaction type and pass the require params:

- Transaction C2B Paymant (Customer to Business):
```PHP
    $data =[
        'from' => $from,                // Customer MSISDN
        'reference' => $reference,      // Third Party Reference
        'transaction' => $transaction,  // Transaction Reference
        'amount' => $amount             // Amount
    ];

    $result = $mpesa->C2BPayment($data);
```

- Transaction B2C Paymant (Business to Customer):
```PHP
    $data =[
        'to' => $from,                // Customer MSISDN
        'reference' => $reference,      // Third Party Reference
        'transaction' => $transaction,  // Transaction Reference
        'amount' => $amount             // Amount
    ];

    $result = $mpesa->B2CPayment($data);
```

- Transaction B2B Paymant (Business to Business):
```PHP
    $data =[
        'to' => $to,                    // Receiver Party Code
        'reference' => $reference,      // Third Party Reference
        'transaction' => $transaction,  // Transaction Reference
        'amount' => $amount             // Amount
    ];

    $result = $mpesa->B2BPayment($data);
```
