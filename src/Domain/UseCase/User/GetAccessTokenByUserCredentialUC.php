<?php

namespace Fira\Domain\UseCase\User;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Repository\UserRepository;
use Fira\Domain\UseCase\UseCaseInterface;
use Firebase\JWT\JWT;
use Webmozart\Assert\Assert;

class GetAccessTokenByUserCredentialUC implements UseCaseInterface
{
    const JWT_KEY = 'lgcyEO^Rs$FfKrpKhy!bAa@jEYEPFK@!XrWOAas$@yfZJI9f!K';

    private UserRepository $userRepo;
    private ?UserEntity $userEntity = null;

    private ?string $email = null;
    private ?string $password = null;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function validate(): void
    {
        Assert::email($this->email);
        Assert::string($this->password);
        Assert::notNull($this->getUserEntity(), 'User not exist!');
        Assert::true($this->isValidPassword(), 'Your password is wrong.');
    }

    private function isValidPassword(): bool
    {
        $userEntity = $this->getUserEntity();
        if ($userEntity === null) {
            return false;
        }

        if(md5($this->password) == $userEntity->getPasswordHash()) {
            return(TRUE);
        }
        else {
            return(FALSE);
        }
    }

    public function execute(): string
    {
        $this->validate();
        $entity = $this->getUserEntity();


        return JWT::encode([
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => time(),
            "nbf" => time() + (30 * 12 * 60 * 60),
            "data" => [
                'userId' => $entity->getId()
            ]
        ], self::JWT_KEY);
    }

    /**
     * @param string|null   $email
     *
     * @return GetAccessTokenByUserCredentialUC
     */
    public function setEmail(?string $email): GetAccessTokenByUserCredentialUC
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null   $password
     *
     * @return GetAccessTokenByUserCredentialUC
     */
    public function setPasswd(?string $password): GetAccessTokenByUserCredentialUC
    {
        $this->password = $password;
        return $this;
    }
    private function getUserEntity(): ?UserEntity
    {
        if ($this->userEntity === null) {
            $this->userEntity = $this->userRepo->getByEmail($this->email);
        }

        return $this->userEntity;
    }


}
