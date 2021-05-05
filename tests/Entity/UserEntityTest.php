<?php

namespace Fira\Test\Entity;

use Fira\Domain\Entity\UserEntity;
use PHPUnit\Framework\TestCase;

final class UserEntityTest extends TestCase
{
    public function testSetterAndGetters(): void
    {
        $locationEntity = new UserEntity();
        $locationEntity->setName('taha');
        $locationEntity->setFamily('taha');
        $locationEntity->setEmail('taha');
        $locationEntity->setPasswordHash('taha');

        $this->assertEquals('taha', $locationEntity->getName());
        $this->assertEquals('taha', $locationEntity->getFamily());
        $this->assertEquals('taha', $locationEntity->getEmail());
        $this->assertEquals('taha', $locationEntity->getPasswordHash());
    }
}