<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\ORM\Mapping as ORM;


class Branch
{
    /** @var int */
    private $id;

    /** @var string */
    private $internalId;

    /** @var string */
    private $internalName;

    /** @var Coordinates */
    private $location;

    /** @var array<BusinessHourModel> */
    private $businessHours;

    /** @var string */
    private $address;

    /** @var string */
    private $web;

    /** @var string */
    private $announcement;

    /** @var int */
    private $active;

    /** @var int */
    private $public;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInternalId(): ?int
    {
        return $this->internalId;
    }

    public function setInternalId(int $internalId): self
    {
        $this->internalId = $internalId;

        return $this;
    }

    public function getInternalName(): ?string
    {
        return $this->internalName;
    }

    public function setInternalName(string $internalName): self
    {
        $this->internalName = $internalName;

        return $this;
    }


    public function getLocation(): ?Coordinates
    {
        return $this->location;
    }

    public function setLocation(float $lan, float $lng): self
    {
        $this->location = new Coordinates;
        $this->location->setLat($lan);
        $this->location->setLng($lng);

        return $this;
    }

    public function getBusinessHours(): ?array
    {
        return $this->businessHours;
    }

    public function setBusinessHours(array $businessHours): self
    {
        $this->businessHours = array();

        foreach ($businessHours as $hours){
            if (empty($this->businessHours[$hours["day"]-1])) 
                $this->businessHours[$hours["day"]-1] = new BusinessHourModel;
            $this->businessHours[$hours["day"]-1]->setDayOfWeek($hours["day"]);
            $opening = $hours["open"];
            $opening .= " - ";
            $opening .= $hours["close"];
            if($this->businessHours[$hours["day"]-1]->getBusinessHour() == "") 
            { $this->businessHours[$hours["day"]-1]->setBusinessHour($opening); }
            else 
            { $this->businessHours[$hours["day"]-1]->addBusinessHour($opening); }
        }

        $businessHours;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(string $web): self
    {
        $this->web = $web;

        return $this;
    }

    public function getAnnouncement(): ?string
    {
        return $this->announcement;
    }

    public function setAnnouncement(string $announcement): self
    {
        $this->announcement = $announcement;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPublic(): ?int
    {
        return $this->public;
    }

    public function setPublic(int $public): self
    {
        $this->public = $public;

        return $this;
    }
}

class BusinessHourModel
{
    /** @var int */
    private $dayOfWeek;
    
    /** @var string */
    private $businessHour;



    public function getDayOfWeek(): ?int
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(int $dayOfWeek): self
    {
        $this->dayOfWeek= $dayOfWeek;

        return $this;
    }



    public function getBusinessHour(): ?string
    {
        return $this->businessHour;
    }

    public function setBusinessHour(string $businessHour): self
    {
        $this->businessHour = $businessHour;

        return $this;
    }

    public function addBusinessHour(string $businessHour): self
    {
        $this->businessHour .= " , ";
        $this->businessHour .= $businessHour;

        return $this;
    }

}

class Coordinates
{
    /** @var float */
    private $lat;
    
    /** @var float */
    private $lng;


    public function getLat(): ?float
    {
        return $this->lan;
    }

    public function setLat(float $lan): self
    {
        $this->lan= $lan;

        return $this;
    }



    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

}



