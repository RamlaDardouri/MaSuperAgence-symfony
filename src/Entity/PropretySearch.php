<?php
namespace App\Entity;

use Symfony\component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class PropretySearch {

    /**
     * @var int|null
     */
    private $maxPrice;
    
    /**
     * @var int|null
     */
    private $minSurface;
    
    /**
     * @var ArrayCollection
     */
    private $option;
    public function __construct()
    {
        $this->option = new ArrayCollection();
    }



    /**
     * @var int|null
     */
    public function getMaxPrice(): ?int
{
    return $this->maxPrice;
}
/**
 * @param int|null $maxPrice
 * @return PropretySearch
 */
    public function setMaxPrice(int $maxPrice): PropretySearch
    {
        $this->maxPrice= $maxPrice;
        return $this;
    }

    /**
     * @var int|null
     * @Assert\Range(min=10, max=400)
     */
    public function getMinSurface(): ?int
{
    return $this->minSurface;
}
/**
 * @param int|null $minSurface
 * @return PropretySearch
 */
    public function setMinSurface(int $minSurface): PropretySearch
    {
        $this->minSurface= $minSurface;
        return $this;
    }

/**
 * @return ArrayCollection 
 */
public function getOptions(): ArrayCollection
{
    return $this->option;
}

/**
 * @param ArrayCollection $options
 */
public function setOptions(ArrayCollection $options): void
{
    $this->options = $options;
}


}