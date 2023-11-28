<?php

namespace Api\Classes;

class Contato
{
    private $nome;
    private $email_primario;
    private $email_secundario;
    private $telefone_primario;
    private $telefone_secundario;

    public function __construct($nome, $telefone_primario, $email_primario)
    {
        $this->setNome($nome)
            ->setTelefone_primario($telefone_primario)
            ->setEmail_primario($email_primario);
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
     * Get the value of email_primario
     */ 
    public function getEmail_primario()
    {
        return $this->email_primario;
    }

    /**
     * Set the value of email_primario
     *
     * @return  self
     */ 
    public function setEmail_primario($email_primario)
    {
        $this->email_primario = $email_primario;

        return $this;
    }

    /**
     * Get the value of email_secundario
     */ 
    public function getEmail_secundario()
    {
        return $this->email_secundario;
    }

    /**
     * Set the value of email_secundario
     *
     * @return  self
     */ 
    public function setEmail_secundario($email_secundario)
    {
        $this->email_secundario = $email_secundario;

        return $this;
    }

    /**
     * Get the value of telefone_primario
     */ 
    public function getTelefone_primario()
    {
        return $this->telefone_primario;
    }

    /**
     * Set the value of telefone_primario
     *
     * @return  self
     */ 
    public function setTelefone_primario($telefone_primario)
    {
        $this->telefone_primario = $telefone_primario;

        return $this;
    }

    /**
     * Get the value of telefone_secundario
     */ 
    public function getTelefone_secundario()
    {
        return $this->telefone_secundario;
    }

    /**
     * Set the value of telefone_secundario
     *
     * @return  self
     */ 
    public function setTelefone_secundario($telefone_secundario)
    {
        $this->telefone_secundario = $telefone_secundario;

        return $this;
    }
}