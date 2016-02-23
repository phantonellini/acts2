<?php
include 'config.php';
include_once 'Banco.php';

class Noticias extends Banco {
    private $id;
    private $titulo;
    private $capa;
    private $chamada;
    private $conteudo;
    private $arraynoticitas;
    
    
    //contrutor
    public function __construct($arraynoticias) {
        $this->id=valida($arraynoticias['id']);
        $this->titulo=valida($arraynoticias['titulo']);
        $this->capa=valida($arraynoticias['capa']);
        $this->chamada=valida($arraynoticias['chamada']);
        $this->conteudo=valida($arraynoticias['conteudo']);
    }
    
    //tratamento de dados
    
    public function valida($var){
        htmlspecialchars($_REQUEST[$var]);
        
        if (is_int($var)){
            (int)$_REQUEST[$var];
        }
        $scaped=mysql_escape_string($var);
        
    }
    
    //sets
    
    public function setId ($id){
        $this->id=$id;
    }
    
    public function setTitulo($titulo){
        $this->titulo=$titulo;
    }
    
    public function setCapa($capa){
        $this->capa=$capa;
    }
    
    public function setChamada($chamada){
        $this->chamada=$chamada;
    }
    
    public function setConteudo($conteudo){
        $this->conteudo=$conteudo;
    }
    
    //gets
    
    public function getId(){
        return $this->id;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getCapa(){
        return $this->capa;
    }
    
    public function getChamada(){
        return $this->chamada;
    }
    
    public function getConteudo(){
        return $this->conteudo;
    }
    
    //funções crud
            
    public function salvaNoticias(){
        $insereNoticias= mysql_query("insert into noticias values('$this->titulo','$this->capa','$this->chamada','$this->conteudo')");
        if($insereNoticias){
            echo '{ "sucesso" : true, "msg" : "NotÃ­cia cadastrada com sucesso!" }';
        }
        else{
            echo'{ "erro" : false, "msg" : "NotÃ­cia nao cadastrada!" }';
        }
    }
    
    public function selecionaNoticias(){
        $selecionaNoticias= mysql_query("select *from noticias");
        /*while($linha=mysql_fetch_array($selecionaNoticias)){
            $this->titulo=$linha["titulo"];
            $this->capa=$linha["capa"];
            $this->chamada=$linha["chamada"];
            $this->conteudo=$linha["conteudo"];
        }*/
        
        $teste = new Notícia();
$teste->seleciomanoticias();
        return $selecionaNoticias;
    }
    
    public function deletaNoticias(){
        mysql_query("DELETE from noticias WHERE id='".$this->id."'");
        echo '{ "sucesso" : true, "msg" : "NotÃ­cia excluÃ­da com sucesso!" }';
    }
    
    public function updateNoticias(){
        $up=  mysql_query("UPDATE noticias SET titulo='$this->titulo',capa='$this->capa',chamada='$this->chamada',conteudo='$this->conteudo'WHERE id='$this->id'");
        
        if(mysql_affected_rows()>0){
            echo '{ "sucesso" : true, "msg" : "NotÃ­cia alterada com sucesso!" }';
        }
        else{
            echo '{ "erro" : false, "msg" : "NotÃ­cia nao alterada!" }';
        }
    }
}
