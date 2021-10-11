<?php

namespace App\Entity;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

/**
 * @return (Role|string)[] 
 */

public function getRoles()
{
    return ['ROLE_ADMIN'];
}



/**
 * @return string|null  
 */
public function getSalt()
{
    return null;
}


public function eraseCredentials()
{

}


    /**
     * @see \Serializable::serialize()
     */

public function serialize()
{
   return serialize(
       [
           $this->id,
           $this->username,
           $this->password
       ]
       );
       }




  /**
   *  @see \Serializable::unserialize() 
   */

 public function unserialize($serialized)
 {
   list(
       $this->id,
       $this->username,
       $this->password
   ) = unserialize($serialized, ['allowed_classes' => false]);
 }




}
