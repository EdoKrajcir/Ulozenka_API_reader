<?php

namespace App\Entity;

use App\Entity\Coordinates;



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