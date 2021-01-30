<?php

namespace App\Entity;



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