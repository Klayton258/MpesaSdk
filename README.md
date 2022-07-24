# M-Pesa SDK, PHP, Laravel
Software Development Kit for mpesa api payments for laravel

[![Issues](https://img.shields.io/github/issues/Klayton258/MpesaSdk.svg?style=flat-square)](https://github.com/Klayton258/MpesaSdk/issues)
[![Total Downloads](https://img.shields.io/packagist/dt/say7ama/mpesa_sdk.svg?style=flat-square)](https://packagist.org/packages/say7ama/mpesa_sdk/stats)

## Installation
Install using composer:
```bash
composer require say7ama/mpesa_sdk
```
## Usage

1. Add `Say7ama\MpesaSdk\MpesaServiceProvider::class` in `config/app.php`.

2. Use the command to publish the configuration file `Say7ama\MpesaSdk\MpesaServiceProvider::class`.
```bash
php  artisan vendor:publish
```

3. Open `config/MpesaSdk.php` file and add the require credentials as supplied by M-Pesa Developer Portal.

4. If laravel not recognize the package configuration run:
```bash
php artisan optimize
```

5. Initiat transactions using:

```PHP
use Say7ama\MpesaSdk\Http\Transactions\MpesaTransactions;


$transaction = new MpesaTransactions();

```
6. Choose the transaction type and pass the require params:

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


## Require

- [PHP ^7.3](https://www.php.net/ChangeLog-7.php#7.3.0)
- [PHP ^8.0](https://www.php.net/ChangeLog-8.php#8.0.0)

## License

This SDK is made available under the MIT License. Please see [License File](https://github.com/Klayton258/MpesaSdk/blob/main/LICENSE) for more information.


