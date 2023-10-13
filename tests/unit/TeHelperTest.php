<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TeHelperTest extends TestCase
{
    /** php artisan test --filter TeHelperTest */
    public function testWillExpireAt()
    {
        $due_time = '2023-10-11 12:00:00';
        $created_at = '2023-10-11 10:00:00';
        $result = TeHelper::willExpireAt($due_time, $created_at);
        $expectedResult = '2023-10-11 13:30:00';
        $this->assertEquals($expectedResult, $result);
    }
}
