<?php
include 'config.php';
require_once 'lib/WideImage.php';

class controleNoticias {

    //para cada linha instanciar um objeto noticia
    function montaLista(){
        while($var=mysql_fetch_row(selecionaNoticias()){
            noticia= new Noticias($arraynoticias);        
            
        }
    }
    
    function exibeLista(){
        
    }

    function carregaCapa (){
        if(isset($_FILES['capa']['name'])&& $_FILES["capa"]["error"] ==0){
            $arquivo_temp=$_FILES['capa']['tmp_name'];
            $nome =$_FILES['capa']['name'];
            
            $extensao=strrchr($nome,'.');
            
            $extensao=strlower($extensao);
            
            if(strstr('.jpg;.jpeg;.gif;.png',$extensao)){
                $novonome=md5(microtime()). $extensao;
                $destino='imagens/' . $novonome;
                
                if(@move_uploaded_file($arquivo_temp,$destino)){
                    echo '{ "sucesso" : true, "msg" : "Sucesso ao subir a imagem" }';
                }else
                    echo '{ "erro" : false, "msg" : "Erro ao subir a imagem" }';
            }else
                echo '{ "erro" : false, "msg" : "Extensao nao aceita" }';
        }else
            echo '{ "erro" : false, "msg" : "voce nao enviou nenhum arquivo" }';
        
        //cria miniatura
        
        $img=WideImage::load($destino);
        
        $miniatura= $img->resize(300);
        
        $img->saveToFile('imagens/' . $novonome.'_thumb');
        
        
        return $destino;
    }
    
    function insereNoticia(){
        $noticia= new Noticias;
        
        $noticia->setTitulo=$_REQUEST['titulo'];
        $noticia->capa=$_REQUEST['capa'];
        $notica->chamada=$_REQUEST['chamada'];
        $noticia->conteudo=$_REQUEST['conteudo'];
        
        salvaNoticia($noticia);

    }
    
    function editaNoticia(){
        $editnoticia= new Noticias;
        
        $editnoticia->id=$_REQUEST['id'];
        $editnoticia->titulo=$_REQUEST['titulo'];
        $editnoticia->capa=$_REQUEST['capa'];
        $editnotica->chamada=$_REQUEST['chamada'];
        $editnoticia->conteudo=$_REQUEST['conteudo'];
        
        $editnoticia=updateNoticias();
        
    }
    
    function excluiNoticia (){
        $delnoticia= new Noticias;
        
        $delnoticia->id=$_REQUEST['id'];
        
        $delnoticia=deleteNoticias();
    }
    
}
