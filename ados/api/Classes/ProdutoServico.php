<?php

namespace Api\Classes;

class ProdutoServico
{
    private $nome;
    private $descricao;
    private $tipo;
    private $persona;
    private $funil;
    private $copy;
    private $vsl;
    private $hedline;
    private $mail;
    private $posts;
    private $google_ads;
    private $facebook_ads;

    public function __construct($nome, $descricao, $tipo)
    {
        $this->setNome($nome)
            ->setDescricao($descricao)
            ->setTipo($tipo);
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of persona
     */ 
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set the value of persona
     *
     * @return  self
     */ 
    public function setPersona($persona)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get the value of funil
     */ 
    public function getFunil()
    {
        return $this->funil;
    }

    /**
     * Set the value of funil
     *
     * @return  self
     */ 
    public function setFunil($funil)
    {
        $this->funil = $funil;

        return $this;
    }

    /**
     * Get the value of copy
     */ 
    public function getCopy()
    {
        return $this->copy;
    }

    /**
     * Set the value of copy
     *
     * @return  self
     */ 
    public function setCopy($copy)
    {
        $this->copy = $copy;

        return $this;
    }

    /**
     * Get the value of vsl
     */ 
    public function getVsl()
    {
        return $this->vsl;
    }

    /**
     * Set the value of vsl
     *
     * @return  self
     */ 
    public function setVsl($vsl)
    {
        $this->vsl = $vsl;

        return $this;
    }

    /**
     * Get the value of hedline
     */ 
    public function getHedline()
    {
        return $this->hedline;
    }

    /**
     * Set the value of hedline
     *
     * @return  self
     */ 
    public function setHedline($hedline)
    {
        $this->hedline = $hedline;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of posts
     */ 
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set the value of posts
     *
     * @return  self
     */ 
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get the value of google_ads
     */ 
    public function getGoogle_ads()
    {
        return $this->google_ads;
    }

    /**
     * Set the value of google_ads
     *
     * @return  self
     */ 
    public function setGoogle_ads($google_ads)
    {
        $this->google_ads = $google_ads;

        return $this;
    }

    /**
     * Get the value of facebook_ads
     */ 
    public function getFacebook_ads()
    {
        return $this->facebook_ads;
    }

    /**
     * Set the value of facebook_ads
     *
     * @return  self
     */ 
    public function setFacebook_ads($facebook_ads)
    {
        $this->facebook_ads = $facebook_ads;

        return $this;
    }
}