<?php

namespace Api\Classes;

class Marca
{
    private $nome;
    private $descricao;
    private $pesquisa;
    private $estrutura_estrategica;
    private $produto_servico;
    private $publicidade;
    private $contato;

    public function __construct($nome, $descricao)
    {
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->pesquisa = new Pesquisa();
        $this->estrutura_estrategica = new EstruturaEstrategica();
        // $this->produto_servico = new ProdutosServicos();
        // $this->publicidade = new Publicidade();
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
     * Get the value of pesquisa
     */ 
    public function getPesquisa()
    {
        return $this->pesquisa;
    }

    /**
     * Set the value of pesquisa
     *
     * @return  self
     */ 
    public function setPesquisa(Pesquisa $pesquisa)
    {
        $this->pesquisa = $pesquisa;

        return $this;
    }

    /**
     * Get the value of estrutura_estrategica
     */ 
    public function getEstrutura_estrategica()
    {
        return $this->estrutura_estrategica;
    }

    /**
     * Set the value of estrutura_estrategica
     *
     * @return  self
     */ 
    public function setEstrutura_estrategica(EstruturaEstrategica $estrutura_estrategica)
    {
        $this->estrutura_estrategica = $estrutura_estrategica;

        return $this;
    }    

    /**
     * Get the value of produto_servico
     */ 
    public function getProduto_servico()
    {
        return $this->produto_servico;
    }

    /**
     * Set the value of produto_servico
     *
     * @return  self
     */ 
    public function setProduto_servico(ProdutoServico $produto_servico)
    {
        $this->produto_servico = $produto_servico;

        return $this;
    }

    /**
     * Get the value of publicidade
     */ 
    public function getPublicidade()
    {
        return $this->publicidade;
    }

    /**
     * Set the value of publicidade
     *
     * @return  self
     */ 
    public function setPublicidade(Publicidade $publicidade)
    {
        $this->publicidade = $publicidade;

        return $this;
    }

    /**
     * Get the value of contato
     */ 
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set the value of contato
     *
     * @return  self
     */ 
    public function setContato(Contato $contato)
    {
        $this->contato = $contato;

        return $this;
    }

}