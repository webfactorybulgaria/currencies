<?php

return [
    'per_page' => 30,
    'order' => [
        'id' => 'desc',
    ],
    'sidebar' => [
        'icon' => 'icon fa fa-fw fa-money',
        'weight' => 8,
    ],

    /*
    |--------------------------------------------------------------------------
    | Format with which to display prices across the store.
    |--------------------------------------------------------------------------
    |
    | :symbol   = Currency symbol. i.e. "$"
    | :price    = Price. i.e. "0.99"
    | :currency = Currency code. i.e. "USD"
    |
    | Example format: ':symbol:price (:currency)'
    | Example result: '$0.99 (USD)'
    |
    */
    'formats' => [
    	':price:symbol' 			=> 'Dollar style: X10.99',
    	':symbol:price'				=> 'Euro style: 10.99X',
    	':symbol:price (:currency)' => 'Dollar style with ISO code: X10.99 (USD)',
    	':price:symbol (:currency)' => 'Euro style with ISO code: 10.99X (EUR)',
    ]
];
