<?php
namespace Memory\Entity;

/**
 * @name Gamer
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Entity
 * @abstract Poor entity implementation (with Doctrine support!)
 * 
 * @ORM\Entity(repositoryClass=Memory\Repository\GamerRepository::class)
 * @ORM\Table(name="gamer")
 */

use Doctrine\ORM\Mapping as ORM;

class Gamer {

    /**
     * ID for the gamer
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * Name of the gamer
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $name;
    
    public function __construct(){}
    
    /**
     * Get the ID of the gamer
     * @return int
     */
    public function getId(): ?int {
        return $this->id;
    }
    
    /**
     * Sets the ID of the gamer
     * @param int $id
     * @return Gamer
     */
    public function setId(int $id): Gamer {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Sets the gamer name
     * @param string $name
     * @return Gamer
     */
    public function setName(string $name): Gamer {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Gets the gamer name
     * @return string
     */
    public function getName(): ?string {
        return $this->name;
    }
}

