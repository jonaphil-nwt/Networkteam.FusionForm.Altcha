<?php

namespace Networkteam\FusionForm\Altcha\EelHelper;

use AltchaOrg\Altcha\Hasher\Algorithm;
use Networkteam\Flow\Altcha\Service\AltchaService;
use Neos\Flow\Annotations as Flow;

/***************************************************************
 *  (c) 2025 networkteam GmbH - all rights reserved
 ***************************************************************/
class ChallengeParameterToken implements \Neos\Eel\ProtectedContextAwareInterface
{

    #[Flow\Inject]
    protected AltchaService $altchaService;

    protected array $parameters = [];

    public function algorithm(string $algorithm): self
    {
        $this->parameters['algorithm'] = $algorithm;
        return $this;
    }

    public function minNumber(int $minNumber): self
    {
        $this->parameters['minNumber'] = $minNumber;
        return $this;
    }

    public function maxNumber(int $maxNumber): self
    {
        $this->parameters['maxNumber'] = $maxNumber;
        return $this;
    }

    public function expires(int $expires)
    {
        $this->parameters['expires'] = $expires;
        return $this;
    }

    public function saltLength(int $saltLength): self
    {
        $this->parameters['saltLength'] = $saltLength;
        return $this;
    }

    public function create(): ?array
    {
        // configure service
        if (!empty($this->parameters['algorithm'])) {
            $this->altchaService->setAlgorithm($this->parameters['algorithm']);
        }
        if (!empty($this->parameters['minNumber'])) {
            $this->altchaService->setMinNumber($this->parameters['minNumber']);
        }
        if (!empty($this->parameters['maxNumber'])) {
            $this->altchaService->setMaxNumber($this->parameters['manNumber']);
        }
        if (!empty($this->parameters['expires'])) {
            $this->altchaService->setExpires($this->parameters['expires']);
        }
        if (!empty($this->parameters['saltLength'])) {
            $this->altchaService->setExpires($this->parameters['saltLength']);
        }

        try {
            $challenge = $this->altchaService->createChallenge();
        } catch (\Exception $exception) {
            $challenge = null;
        }

        return $challenge;
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}