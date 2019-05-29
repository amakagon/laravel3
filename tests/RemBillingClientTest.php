<?php

class RemBillingClientTest extends PHPUnit_Framework_TestCase
{
    public function testDocumentSchema()
    {
        $data = [
            'type' => \Rem\BillingClient\Schema\Document::TYPE_MONTHLY_SELLING_SERVICES,
            'createdAt' => '2017-07-13T12:00:00-1100',
            'billingDate' => '2017-07-13T13:00:00-1100',
            'billingPeriod' => '2017-07',
            'allowedFormats' => [
                'csv',
            ],
            'location' => [
                'type' => 'blob',
                'url' => 'http://rem.com/file.csv',
            ],
        ];

        $document = new \Rem\BillingClient\Schema\Document();
        $document->setType($data['type'])
            ->setCreatedAt($data['createdAt'])
            ->setBillingDate($data['billingDate'])
            ->setBillingPeriod($data['billingPeriod'])
            ->setAllowedFormats($data['allowedFormats'])
            ->setLocation(
                (new \Rem\BillingClient\Schema\Location())
                    ->setType($data['location']['type'])
                    ->setUrl($data['location']['url'])
            );

        $secondDocument = new \Rem\BillingClient\Schema\Document();
        $secondDocument->fromArray($data);

        $this->assertEquals($data, $document->toArray());
        $this->assertEquals($data, $secondDocument->toArray());
    }

    public function testOrderFeeSchema()
    {
        $data = [
            'code' => 'D092J213',
            'basePrice' => 20000,
            'price' => 30000,
        ];

        $fee = new \Rem\BillingClient\Schema\OrderFee();
        $fee->setCode($data['code'])
            ->setBasePrice($data['basePrice'])
            ->setPrice($data['price']);

        $secondFee = new \Rem\BillingClient\Schema\OrderFee();
        $secondFee->fromArray($data);

        $this->assertEquals($data, $fee->toArray());
        $this->assertEquals($data, $secondFee->toArray());
    }

    public function testOrderCommissionSchema()
    {
        $data = [
            'code' => 'D092J213',
            'basePrice' => 20000,
            'price' => 30000,
            'quantity' => 1,
        ];

        $commission = new \Rem\BillingClient\Schema\OrderCommission();
        $commission->setCode($data['code'])
            ->setBasePrice($data['basePrice'])
            ->setPrice($data['price'])
            ->setQuantity($data['quantity']);

        $secondCommission = new \Rem\BillingClient\Schema\OrderCommission();
        $secondCommission->fromArray($data);

        $this->assertEquals($data, $commission->toArray());
        $this->assertEquals($data, $secondCommission->toArray());
    }

    public function testCommissionSchema()
    {
        $data = [
            'service' => 'marketplace',
            'code' => 'D092J213',
            'paidAt' => '2017-07-13T12:00:00-1100',
            'baseCurrencyCode' => 'EUR',
            'currencyCode' => 'PLN',
            'exchangeRate' => 1.5,
            'basePrice' => 20000,
            'price' => 30000,
            'auctionId' => 123,
            'commissionId' => 12345,
            'customer' => [
                'type' => \Rem\BillingClient\Schema\Customer\ID::TYPE,
                'customerId' => '893672',
                'internalCustomerId' => '12324',
                'countryCode' => 'PL',
            ],
            'quantity' => 1,
        ];

        $commission = new \Rem\BillingClient\Schema\Commission();
        $commission->setCode($data['code'])
            ->setService($data['service'])
            ->setPaidAt($data['paidAt'])
            ->setBaseCurrencyCode($data['baseCurrencyCode'])
            ->setCurrencyCode($data['currencyCode'])
            ->setExchangeRate($data['exchangeRate'])
            ->setBasePrice($data['basePrice'])
            ->setPrice($data['price'])
            ->setAuctionId($data['auctionId'])
            ->setCommissionId($data['commissionId'])
            ->setQuantity($data['quantity'])
            ->setCustomer(
                (new \Rem\BillingClient\Schema\Customer\ID())
                    ->setCustomerId($data['customer']['customerId'])
                    ->setInternalCustomerId($data['customer']['internalCustomerId'])
                    ->setCountryCode($data['customer']['countryCode'])
            );

        $secondCommission = new \Rem\BillingClient\Schema\Commission();
        $secondCommission->fromArray($data);

        $this->assertEquals($data, $commission->toArray());
        $this->assertEquals($data, $secondCommission->toArray());
    }

    public function testItemSchema()
    {
        $data = [
            'remoteId' => '21039213',
            'name' => 'Counter-Strike: Global Offensive',
            'sku' => 'csgo',
            'basePrice' => 2.75,
            'price' => 5.5,
            'commissions' => [],
            'quantity' => 1,
            'type' => 'game',
            'seller' => [
                'type' => \Rem\BillingClient\Schema\Customer\Company::TYPE,
                'customerId' => 13421212,
                'company' => 'Rem',
                'countryCode' => 'PL',
                'regionCode' => '',
                'telephone' => '+48123456789',
                'vatId' => 'PL',
                'city' => 'Rzeszów',
                'road' => 'Połonińska 19',
            ],
            'fees' => [],
            'auctionId' => 123,
        ];

        $item = new \Rem\BillingClient\Schema\OrderItem();
        $item->setRemoteId($data['remoteId'])
            ->setName($data['name'])
            ->setSku($data['sku'])
            ->setBasePrice($data['basePrice'])
            ->setPrice($data['price'])
            ->setQuantity($data['quantity'])
            ->setType($data['type'])
            ->setSeller(
                (new \Rem\BillingClient\Schema\Customer\Company())
                    ->setCustomerId($data['seller']['customerId'])
                    ->setCompany($data['seller']['company'])
                    ->setCountryCode($data['seller']['countryCode'])
                    ->setRegionCode($data['seller']['regionCode'])
                    ->setTelephone($data['seller']['telephone'])
                    ->setVatId($data['seller']['vatId'])
                    ->setCity($data['seller']['city'])
                    ->setRoad($data['seller']['road'])
            )
            ->setAuctionId($data['auctionId']);

        $secondItem = new \Rem\BillingClient\Schema\OrderItem();
        $secondItem->fromArray($data);

        $this->assertEquals($data, $item->toArray());
        $this->assertEquals($data, $secondItem->toArray());
    }

    public function testMySelfSchema()
    {
        $data = [
            'type' => \Rem\BillingClient\Schema\Customer\MySelf::TYPE,
        ];

        $mySelf = new \Rem\BillingClient\Schema\Customer\MySelf();

        $this->assertEquals($data, $mySelf->toArray());
    }

    public function testIdSchema()
    {
        $data = [
            'type' => \Rem\BillingClient\Schema\Customer\ID::TYPE,
            'customerId' => '893274672',
            'internalCustomerId' => '123214124124',
            'countryCode' => 'PL',
        ];

        $id = new \Rem\BillingClient\Schema\Customer\ID();
        $id->setCustomerId($data['customerId'])
            ->setInternalCustomerId($data['internalCustomerId'])
            ->setCountryCode($data['countryCode']);

        $secondId = new \Rem\BillingClient\Schema\Customer\ID();
        $secondId->fromArray($data);

        $this->assertEquals($data, $id->toArray());
        $this->assertEquals($data, $secondId->toArray());
    }

    public function testIndividualSchema()
    {
        $data = [
            'type' => \Rem\BillingClient\Schema\Customer\Individual::TYPE,
            'customerId' => 943993828,
            'firstname' => 'Norbert',
            'lastname' => 'Pabisz',
            'countryCode' => 'PL',
            'regionCode' => 'Rze',
            'telephone' => '+48000123000',
            'city' => 'Rzeszów',
            'road' => 'Połonińska 19',
        ];

        $individual = new \Rem\BillingClient\Schema\Customer\Individual();
        $individual->setCustomerId($data['customerId'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setCountryCode($data['countryCode'])
            ->setRegionCode($data['regionCode'])
            ->setTelephone($data['telephone'])
            ->setCity($data['city'])
            ->setRoad($data['road']);

        $secondIndividual = new \Rem\BillingClient\Schema\Customer\Individual();
        $secondIndividual->fromArray($data);

        $this->assertEquals($data, $individual->toArray());
        $this->assertEquals($data, $secondIndividual->toArray());
    }

    public function testCompanySchema()
    {
        $data = [
            'type' => \Rem\BillingClient\Schema\Customer\Company::TYPE,
            'customerId' => 13421212,
            'company' => 'Rem',
            'countryCode' => 'PL',
            'regionCode' => '',
            'telephone' => '+48123456789',
            'vatId' => 'PL',
            'city' => 'Rzeszów',
            'road' => 'Połonińska 19',
        ];

        $company = new \Rem\BillingClient\Schema\Customer\Company();
        $company->setCustomerId($data['customerId'])
            ->setCompany($data['company'])
            ->setCountryCode($data['countryCode'])
            ->setRegionCode($data['regionCode'])
            ->setTelephone($data['telephone'])
            ->setVatId($data['vatId'])
            ->setCity($data['city'])
            ->setRoad($data['road']);

        $secondCompany = new \Rem\BillingClient\Schema\Customer\Company();
        $secondCompany->fromArray($data);

        $this->assertEquals($data, $company->toArray());
        $this->assertEquals($data, $secondCompany->toArray());
    }

    public function testOrderSchema()
    {
        $data = [
            'service' => 'test_service',
            'incrementId' => 12392393219,
            'purchasedAt' => '2017-07-13 12:00:00',
            'paidAt' => '2017-07-13 13:00:00',
            'buyer' => [
                'type' => \Rem\BillingClient\Schema\Customer\MySelf::TYPE,
            ],
            'baseCurrencyCode' => 'EUR',
            'currencyCode' => 'PLN',
            'exchangeRate' => 4.0,
            'items' => [
                [
                    'remoteId' => '21039213',
                    'name' => 'Counter-Strike: Global Offensive',
                    'sku' => 'csgo',
                    'basePrice' => 20.0,
                    'price' => 80.0,
                    'commissions' => [
                        [
                            'code' => 'ABCDEF',
                            'basePrice' => 2.0,
                            'price' => 8.0,
                            'quantity' => 1,
                        ]
                    ],
                    'quantity' => 1,
                    'type' => 'game',
                    'seller' => [
                        'type' => \Rem\BillingClient\Schema\Customer\Company::TYPE,
                        'customerId' => 13421212,
                        'company' => 'Rem',
                        'countryCode' => 'PL',
                        'regionCode' => '',
                        'telephone' => '+48123456789',
                        'vatId' => 'PL',
                        'city' => 'Rzeszów',
                        'road' => 'Połonińska 19',
                    ],
                    'fees' => [
                        [
                            'code' => 'QWERTY',
                            'basePrice' => 1.0,
                            'price' => 4.0,
                        ],
                    ],
                    'auctionId' => '999',
                ],
                [
                    'remoteId' => '8231989321',
                    'name' => 'Age Of Empires II',
                    'sku' => 'aoe2',
                    'basePrice' => 2.10,
                    'price' => 8.40,
                    'commissions' => [],
                    'quantity' => 1,
                    'type' => 'game',
                    'seller' => [
                        'type' => \Rem\BillingClient\Schema\Customer\Company::TYPE,
                        'customerId' => '13421212',
                        'company' => 'Rem',
                        'countryCode' => 'PL',
                        'regionCode' => '',
                        'telephone' => '+48123456789',
                        'vatId' => 'PL',
                        'city' => 'Rzeszów',
                        'road' => 'Połonińska 19',
                    ],
                    'fees' => [],
                    'auctionId' => '123',
                ],
            ],
        ];

        $order = new \Rem\BillingClient\Schema\Order();
        $order->setService($data['service'])
            ->setIncrementId($data['incrementId'])
            ->setPurchasedAt($data['purchasedAt'])
            ->setPaidAt($data['paidAt'])
            ->setBuyer(new \Rem\BillingClient\Schema\Customer\MySelf())
            ->setBaseCurrencyCode($data['baseCurrencyCode'])
            ->setCurrencyCode($data['currencyCode'])
            ->setExchangeRate($data['exchangeRate'])
            ->addItem(
                (new \Rem\BillingClient\Schema\OrderItem())
                    ->setRemoteId($data['items'][0]['remoteId'])
                    ->setName($data['items'][0]['name'])
                    ->setSku($data['items'][0]['sku'])
                    ->setBasePrice($data['items'][0]['basePrice'])
                    ->setPrice($data['items'][0]['price'])
                    ->addCommission(
                        (new \Rem\BillingClient\Schema\OrderCommission())
                            ->setCode($data['items'][0]['commissions'][0]['code'])
                            ->setBasePrice($data['items'][0]['commissions'][0]['basePrice'])
                            ->setPrice($data['items'][0]['commissions'][0]['price'])
                            ->setQuantity($data['items'][0]['commissions'][0]['quantity'])
                    )
                    ->setQuantity($data['items'][0]['quantity'])
                    ->setType($data['items'][0]['type'])
                    ->setSeller(
                        (new \Rem\BillingClient\Schema\Customer\Company())
                            ->setCustomerId($data['items'][0]['seller']['customerId'])
                            ->setCompany($data['items'][0]['seller']['company'])
                            ->setCountryCode($data['items'][0]['seller']['countryCode'])
                            ->setRegionCode($data['items'][0]['seller']['regionCode'])
                            ->setTelephone($data['items'][0]['seller']['telephone'])
                            ->setVatId($data['items'][0]['seller']['vatId'])
                            ->setCity($data['items'][0]['seller']['city'])
                            ->setRoad($data['items'][0]['seller']['road'])
                    )
                    ->setAuctionId($data['items'][0]['auctionId'])
                    ->addFee(
                        (new \Rem\BillingClient\Schema\OrderFee())
                            ->setCode($data['items'][0]['fees'][0]['code'])
                            ->setBasePrice($data['items'][0]['fees'][0]['basePrice'])
                            ->setPrice($data['items'][0]['fees'][0]['price'])
                    )
            )
            ->addItem(
                (new \Rem\BillingClient\Schema\OrderItem())
                    ->setRemoteId($data['items'][1]['remoteId'])
                    ->setName($data['items'][1]['name'])
                    ->setSku($data['items'][1]['sku'])
                    ->setBasePrice($data['items'][1]['basePrice'])
                    ->setPrice($data['items'][1]['price'])
                    ->setQuantity($data['items'][1]['quantity'])
                    ->setType($data['items'][1]['type'])
                    ->setSeller(
                        (new \Rem\BillingClient\Schema\Customer\Company())
                            ->setCustomerId($data['items'][1]['seller']['customerId'])
                            ->setCompany($data['items'][1]['seller']['company'])
                            ->setCountryCode($data['items'][1]['seller']['countryCode'])
                            ->setRegionCode($data['items'][1]['seller']['regionCode'])
                            ->setTelephone($data['items'][1]['seller']['telephone'])
                            ->setVatId($data['items'][1]['seller']['vatId'])
                            ->setCity($data['items'][1]['seller']['city'])
                            ->setRoad($data['items'][1]['seller']['road'])
                    )
                    ->setAuctionId($data['items'][1]['auctionId'])
            );

        $secondOrder = new \Rem\BillingClient\Schema\Order();
        $secondOrder->fromArray($data);

        $this->assertEquals($data, $order->toArray());
        $this->assertEquals($data, $secondOrder->toArray());
    }
}
