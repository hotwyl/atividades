<?php

namespace Api\Classes;

class EstruturaEstrategica
{
    private $business_plan;
    private $canvas;
    private $jornada;
    private $identidade;
    private $midia_kit;
    
    /**
     * Get the value of business_plan
     */ 
    public function getBusiness_plan()
    {
        return $this->business_plan;
    }

    /**
     * Set the value of business_plan
     *
     * @return  self
     */ 
    public function setBusiness_plan($business_plan)
    {
        $this->business_plan = $business_plan;

        return $this;
    }
}