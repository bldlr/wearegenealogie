<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class UserNode
{
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getUsers()
    {
        return $this->users;
    }
}
