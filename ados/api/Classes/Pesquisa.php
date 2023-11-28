<?php

namespace Api\Classes;

class Pesquisa
{
    private $key_words;
    private $referencias;
    private $ideias;

    /**
     * Get the value of key_words
     */ 
    public function getKey_words()
    {
        return $this->key_words;
    }

    /**
     * Set the value of key_words
     *
     * @return  self
     */ 
    public function setKey_words($key_words)
    {
        $this->key_words = $key_words;

        return $this;
    }

    /**
     * Get the value of referencias
     */ 
    public function getReferencias()
    {
        return $this->referencias;
    }

    /**
     * Set the value of referencias
     *
     * @return  self
     */ 
    public function setReferencias($referencias)
    {
        $this->referencias = $referencias;

        return $this;
    }

    /**
     * Get the value of ideias
     */ 
    public function getIdeias()
    {
        return $this->ideias;
    }

    /**
     * Set the value of ideias
     *
     * @return  self
     */ 
    public function setIdeias($ideias)
    {
        $this->ideias = $ideias;

        return $this;
    }
}