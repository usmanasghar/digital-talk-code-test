<?php

namespace Tests\Unit;

use DTApi\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

/** php artisan test --filter UserRepositoryTest */
class UserRepositoryTest extends TestCase
{
    public function testCreateOrUpdate()
    {
        $requestData = [
            'role' => 'customer',
            'name' => 'John Doe',
            'company_id' => 1,
            'department_id' => 2,
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'mobile' => '1234567890',
            //... other data also

        ];

        $userRepository = new UserRepository(new User);
        $result = $userRepository->createOrUpdate(1, $requestData);

        $this->assertInstanceOf(User::class, $result);

        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('customer', $result->user_type);
    }
}
