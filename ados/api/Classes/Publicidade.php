<?php

namespace Api\Classes;

class Publicidade
{
    private $tipo;
    private $titulo;
    private $link;
    private $descricao;
    private $indicadores;
    private $analise;
    private $melhoria;
    private $relatorio;

    public function __construct($titulo, $tipo, $link)
    {
        $this->setTitulo($titulo)
            ->setTipo($tipo)
            ->setLink($link);
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
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

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
     * Get the value of indicadores
     */ 
    public function getIndicadores()
    {
        return $this->indicadores;
    }

    /**
     * Set the value of indicadores
     *
     * @return  self
     */ 
    public function setIndicadores($indicadores)
    {
        $this->indicadores = $indicadores;

        return $this;
    }

    /**
     * Get the value of analise
     */ 
    public function getAnalise()
    {
        return $this->analise;
    }

    /**
     * Set the value of analise
     *
     * @return  self
     */ 
    public function setAnalise($analise)
    {
        $this->analise = $analise;

        return $this;
    }

    /**
     * Get the value of melhoria
     */ 
    public function getMelhoria()
    {
        return $this->melhoria;
    }

    /**
     * Set the value of melhoria
     *
     * @return  self
     */ 
    public function setMelhoria($melhoria)
    {
        $this->melhoria = $melhoria;

        return $this;
    }

    /**
     * Get the value of relatorio
     */ 
    public function getRelatorio()
    {
        return $this->relatorio;
    }

    /**
     * Set the value of relatorio
     *
     * @return  self
     */ 
    public function setRelatorio($relatorio)
    {
        $this->relatorio = $relatorio;

        return $this;
    }
}