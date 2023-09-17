<?php

namespace Tests\Unit;

use App\Http\Services\productervice;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
   
    /**
     * UNIT TESTING IS ACTUALLY BOOLEAN RETURN
     */
    public function test_example()
    {
        //create new object directly not in constructor
        $actualResult = (new productervice)->calculatePrice(100, 10);
        return $this->assertEquals($actualResult, 110);
    }
}
