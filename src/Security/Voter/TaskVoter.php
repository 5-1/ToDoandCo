<?php

namespace App\Security\Voter;

use App\Entity\Task;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskVoter extends Voter
{
    /**
     * @var Security
     */
    private $security;
    /**
     * @var string|UserInterface
     */
    private $user;

    /**
     * TaskVoter constructor.
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['MANAGE', 'TASK_SHOW_LIST']) && ($subject instanceof Task || null === $subject);
    }

    /**
     * @param string $attribute
     * @param Task   $subject
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $this->user = $token->getUser();
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'MANAGE':
                return $this->canEdit($subject);
            case 'TASK_SHOW_LIST':
                return $this->security->isGranted('ROLE_USER');
        }

        return false;
    }

    private function canDelete($subject)
    {
        if ($this->isAnonymous($subject)) {
            return $this->isAdmin();
        }
        if ($this->user->getId() == $subject->getUser()->getId()) {
            return true;
        }
    }

    private function canEdit($subject)
    {
        if ($this->isAnonymous($subject)) {
            return $this->isAdmin();
        }
        if ($this->isAdmin() || $this->user->getId() == $subject->getUser()->getId()) {
            return true;
        }
    }

    private function isAdmin()
    {
        return $this->security->isGranted('ROLE_ADMIN');
    }

    private function isAnonymous($subject)
    {
        return null === $subject->getUser();
    }
}
