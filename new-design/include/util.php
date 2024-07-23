<?php
    function consultaDB($sql){
        try{
            $conn = connect();
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function obtenerId($id,$default=0){
        return isset($_GET[$id]) ? $_GET[$id] : $default;
    }
    function convertString($string){
        return '{'.$string.'}';
    }
    function buscarYReemplazar($cadena, $texto_a_buscar, $reemplazo) {
        $cadena_modificada = str_replace($texto_a_buscar, $reemplazo, $cadena);
        return $cadena_modificada;
    }
    function listarArray($array,$template,$indice) {
        if (!is_array($array)) {
            echo "El argumento pasado no es un array.";
            return;
        }
        $elementReplace = array_map("convertString", $indice);
        foreach ($array as $elemento) {
            $html = buscarYReemplazar($template, $elementReplace, $elemento);
            echo $html;
        }
    }
    function searchData($arrayData,$id,$indices){
        $search = $indices['buscar'];
        $dato = $indices['valor'];
        $result = '';
        foreach ($arrayData as $value) {
            if($value[$search] == $id ){
                $result = $value[$dato];
            }
        }
        return $result;
    }
    function listCategoria($arrayData){
        function listar($id){
            $query_sublista = "SELECT titulo, archivo FROM detalle WHERE id_seccion = ".$id." AND estado = 1 ORDER BY id ASC";
            $lista = consultaDB($query_sublista);
            $html = '<ul>';
            if(count($lista) > 0){
                foreach($lista as $value){
                    $html .= '<li><a href="upload/'.$value['archivo'].'">'.$value['titulo'].'</a></li>';
                }
            }
            else {
                $html .= '<li>Sin info</li>';
            }
            $html .= '</ul>';
            return $html;
        }
        if (!is_array($arrayData)) {
            echo "El argumento pasado no es un array.";
            return;
        }
        foreach ($arrayData as $value){
            
            if(strlen($value['archivo']) > 0){
                echo '<p><a href="upload/'.$value['archivo'].'">'.$value['titulo'].'</a></p>';
            }
            else {
                $listado = listar($value['id_section']);
                echo '<p>'.$value['titulo'].'</p>'.$listado;
            }
        }
    }
?>