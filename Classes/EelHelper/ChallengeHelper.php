<?php

namespace Networkteam\FusionForm\Altcha\EelHelper;

use AltchaOrg\Altcha\Hasher\Algorithm;
use Neos\Eel\ProtectedContextAwareInterface;

/***************************************************************
 *  (c) 2025 networkteam GmbH - all rights reserved
 ***************************************************************/


class ChallengeHelper implements ProtectedContextAwareInterface
{

    protected ChallengeParameterToken $challengeParameterToken;

    public function create(): ?array
    {
        return $this->getToken()->create();
    }

    public function algorithm(string $algorithm): ChallengeParameterToken
    {
        return $this->getToken()->algorithm($algorithm);
    }

    public function minNumber(int $minNumber): ChallengeParameterToken
    {
        return $this->getToken()->minNumber($minNumber);
    }

    public function maxNumber(int $manNumber): ChallengeParameterToken
    {
        return $this->getToken()->maxNumber($manNumber);
    }

    public function expires(int $expires): ChallengeParameterToken
    {
        return $this->getToken()->expires($expires);
    }

    public function saltLength(int $saltLength): ChallengeParameterToken
    {
        return $this->getToken()->saltLength($saltLength);
    }

    protected function getToken(): ChallengeParameterToken
    {
        if (empty($this->challengeParameterToken)) {
            $this->challengeParameterToken = new ChallengeParameterToken();
        }
        return $this->challengeParameterToken;
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}