<?php
namespace App\Data;

use Doctrine\Common\Collections\ArrayCollection;

class Data
{

    /**
     * @var User[]
     */

    private $person = [];


    /**
     * @var User[]
     */

    private $pere = [];


    /**
     * @var User[]
     */


    private $mere = [];


    public function __construct()
    {
        $this->person = new ArrayCollection();
        $this->pere = new ArrayCollection();
        $this->mere = new ArrayCollection();
    }

    public function getPerson()
    {
        return $this->person;
    }


    public function getPere()
    {
        return $this->pere;
    }


    public function getMere()
    {
        return $this->mere;
    }

//     public function __construct()
// {
//     $this->users = new ArrayCollection();
// }

//   private $users;

//       public function getUsers()
//     {
//         return $this->users;
//     }



}
