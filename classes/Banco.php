<?php

abstract class banco {
    public $servidor ="localhost";
    public $usuario = "root";
    public $senha ="";
    public $nomebanco = "acts";
    public $conexao =NULL;
    public $dataset = NULL;
    public $linhasafetadas =-1;
    
    //construtor
    public function __construct(){
        $this->conecta(); 
    }
    
    //destruidor
    public function __destruct(){
        if($this->conexao !=NULL):
            mysql_close($this->conexao);
        endif;
    }

//metodo para conexao
    public function conecta(){
        $this->conexao = mysql_connect($this->servidor,$this->usuario,$this->senha,TRUE) or die ($this->trataerro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),TRUE)); //faz a conexao
        mysql_select_db($this->nomebanco) or die ($this->trataerro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),TRUE)); // seleciona o banco 
        echo "deu certo";
    }
    
    //tratar erros
    public function trataerro($arquivo=NULL,$rotina=NULL,$numerro=NULL,$msgerro=NULL,$geraexcept=FALSE){
        if($arquivo==NULL) $arquivo="nao informado";
        if ($rotina==NULL) $rotina="nao informado";
        if($numerro==NULL) $numerro=  mysql_errno ($this->conexao);
        if(msgerro==NULL) $msgerro=  mysql_error($this->conexao);
        $resultado ='Ocorreu um erro <br /> <strong> Arquivo: </strong>'.
                $arquivo. '<br /> <strong>Rotina:</strong>' .$rotina.
                '<br /><strong>Codigo:</strong>' .$numerro. '<br /> <strong>Mensagem: </strong>'
                .$msgerro;
        if($geraexcept==FALSE):
            echo($resultado);
        else:
            die($resultado);
        endif;
                
    }
}
