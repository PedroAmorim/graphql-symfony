<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetRepository::class)
 */
class Planet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Astronaut")
     * @ORM\JoinTable(name="planet_astronaut")
     */
    private $astronauts;

    public function __construct()
    {
        $this->astronauts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getAstronauts()
    {
        return $this->astronauts;
    }

    public function setAstronauts($astronauts)
    {
        $this->astronauts = $astronauts;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}