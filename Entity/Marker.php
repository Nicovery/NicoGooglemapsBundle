<?php

namespace Nico\GooglemapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Marker
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Marker
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
    * @ORM\ManyToOne(
    * targetEntity="Nico\GooglemapsBundle\Entity\Map",
    * inversedBy="markers"
    * )
    */
    private $map;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="decimal", precision=9, scale=6)
     * @Assert\Type(type="numeric")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="decimal", precision=9, scale=6)
     * @Assert\Type(type="numeric")
     */
    private $lng;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $visible;

    /**
    * @ORM\ManyToOne(
    * targetEntity="Application\Sonata\MediaBundle\Entity\Media"
    * )
    */
    private $icone;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text",  nullable=true)
     */
    private $information;

    public function __construct(){
        $this->visible = true;
    }

    public function __toString(){
        return (string)$this->getTitle();
    }

    

    private function noRetourLigne($string){
        $string = str_replace("\n", "", $string);
        $string = str_replace("\r", "", $string);
        $string = str_replace("\r\n", "", $string);
        return $string;

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
     * Set title
     *
     * @param string $title
     * @return Marker
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return Marker
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     * @return Marker
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    
        return $this;
    }

    /**
     * Get lng
     *
     * @return float 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Marker
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
     * Set map
     *
     * @param \Nico\GooglemapsBundle\Entity\Map $map
     * @return Marker
     */
    public function setMap(\Nico\GooglemapsBundle\Entity\Map $map = null)
    {
        $this->map = $map;
    
        return $this;
    }

    /**
     * Get map
     *
     * @return \Nico\GooglemapsBundle\Entity\Map 
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set icone
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $icone
     * @return Marker
     */
    public function setIcone(\Application\Sonata\MediaBundle\Entity\Media $icone = null)
    {
        $this->icone = $icone;
    
        return $this;
    }

    /**
     * Get icone
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * Set information
     *
     * @param string $information
     * @return Marker
     */
    public function setInformation($information)
    {
        $this->information = $this->noRetourLigne($information);
    
        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->noRetourLigne($this->information);
    }
}