<?php

namespace Shop;

require 'vendor/autoload.php';

use classes\Shop;
use classes\TestCustomerSource;

$shop = new Shop(new TestCustomerSource());
$shop->run();
