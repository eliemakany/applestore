<?php


namespace App\Entity;


use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;

class AppleSearch
{

    /**
     * @var string|null
     */
    private $category;
    /**
     * @var string|null
     */
    private $tag;
    /**
     * @var string|null
     */
    private $origin;


    public function getCategory()
    {
        return $this->category;
    }

    /**
     *
     * @param Category $category
     * @return AppleSearch
     */
    public function setCategory(Category $category): AppleSearch
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string|null $tag
     * @return AppleSearch
     */
    public function setTag(?string $tag): AppleSearch
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @param string|null $origin
     * @return AppleSearch
     */
    public function setOrigin(?string $origin): AppleSearch
    {
        $this->origin = $origin;
        return $this;
    }





}