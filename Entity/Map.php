<?php

namespace Nico\GooglemapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Map
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nico\GooglemapsBundle\Entity\MapRepository")
 */
class Map
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * /**
    * @ORM\OneToMany(
    * targetEntity="Nico\GooglemapsBundle\Entity\Marker",
    * mappedBy="map",
    * cascade={"persist","remove"}
    * )
    */
    private $markers;

    /**
     * @var float
     *
     * @ORM\Column(name="centerLat", type="decimal", precision=9, scale=6)
     *  @Assert\Type(type="numeric")
     */
    private $centerLat;

    /**
     * @var float
     *
     * @ORM\Column(name="centerLng", type="decimal", precision=9, scale=6)
     * @Assert\Type(type="numeric")
     */
    private $centerLng;

    /**
     * @var float
     *
     * @ORM\Column(name="zoom", type="decimal",precision=3,scale=1)
     * @Assert\Type(type="numeric")
     */
    private $zoom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     * @Assert\Type(type="bool")
     */
    private $visible;

 

    public function __construct(){
        $this->visible = true;
        $this->markers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString(){
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set centerLat
     *
     * @param float $centerLat
     * @return Map
     */
    public function setCenterLat($centerLat)
    {
        $this->centerLat = $centerLat;
    
        return $this;
    }

    /**
     * Get centerLat
     *
     * @return float 
     */
    public function getCenterLat()
    {
        return $this->centerLat;
    }

    /**
     * Set centerLng
     *
     * @param float $centerLng
     * @return Map
     */
    public function setCenterLng($centerLng)
    {
        $this->centerLng = $centerLng;
    
        return $this;
    }

    /**
     * Get centerLng
     *
     * @return float 
     */
    public function getCenterLng()
    {
        return $this->centerLng;
    }

    /**
     * Set zoom
     *
     * @param float $zoom
     * @return Map
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    
        return $this;
    }

    /**
     * Get zoom
     *
     * @return float 
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Map
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Map
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {

        return (string)$this->name;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Map
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    
        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Add markers
     *
     * @param \Nico\GooglemapsBundle\Entity\Marker $markers
     * @return Map
     */
    public function addMarker(\Nico\GooglemapsBundle\Entity\Marker $markers)
    {
        $this->markers[] = $markers;
    
        return $this;
    }

    /**
     * Remove markers
     *
     * @param \Nico\GooglemapsBundle\Entity\Marker $markers
     */
    public function removeMarker(\Nico\GooglemapsBundle\Entity\Marker $markers)
    {
        $this->markers->removeElement($markers);
    }

    /**
     * Get markers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMarkers()
    {
        return $this->markers;
    }

   
}