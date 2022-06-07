<?php 
    namespace BaseNamespace
    {
        require 'conexion.php';
        $included_files = get_included_files();
        if(!in_array(realpath((__DIR__).'/../lib/CommonFunc.class.php'), $included_files))
        {
            require (__DIR__).'/../lib/CommonFunc.class.php';            
        }
        use CommonFuncNamespace\CommonFunc as Funciones;
        use ConexionNameSpace\ConexionMysql as Conexion;
        class Base extends Conexion
        {
            private $object, 
                    $table, 
                    $keys, 
                    $countKeys, 
                    $primaryKey, 
                    $ColumnAlias, 
                    $values;
            function __construct($object, $table, $primaryKey, $ColumnAlias, $id=0)
            {
                parent::__construct();
                $this->object =         $object;
                $this->table =          $table;
                $this->primaryKey =     $primaryKey;
                $this->keys =           array_keys($this->object);
                $this->countKeys =      count($this->keys);
                $this->ColumnAlias =    $ColumnAlias;
                if($id > 0)
                {
                    $this->values = $this->Select("select * from $table where $primaryKey=$id");
                    for ($i=0; $i < $this->countKeys; $i++) { 
                        
                        if(is_array($object[$this->keys[$i]]) == false )
                        {
                            $prop =         $this->keys[$i];
                            $this->$prop =  utf8_decode($this->values[0][$this->keys[$i]]);
                        }
                    }
                    
                }
            }
            function SetValues($values)
            {
                $this->values = $values;
            }
            function GetValues()
            {
                return $this->values;
            }
            function GetValue($column)
            {
                return $this->values[0][$column];
            }
            function SanitizeData($value)
            {
                //^[a-zA-ZÀ-ÿ\u00f1\u00d1]
                //$result  = preg_replace('/[^a-zA-Z0-9_ @.!#$%:&()\/-]/s','',$value);   
                //$result  = preg_replace('/[^a-zA-ZÀ-ÿ\u00f1\u00d10-9_ @.!#$%:&()\/-]/s','',$value);   
                ///^[a-zA-ZñÑ\s\W]/
                $result  = $value;// preg_replace('/[^a-zA-ZÀ-ÿñÑ0-9_ @.!#$%:&()\/-]/s','',$value);   
                return ($result);
            }
            function checkType($valor)
            {
                if(is_string($valor) && $valor!="null")
                {
                    $valor =        $this->SanitizeData($valor);    
                    return "'$valor'";
                }
                else
                    return $valor;
            }
            function InflateObject()
            {
                try
                {
                    $this->object = get_object_vars($this);
                } 
                catch (Exception $e)
                {
                    return $e->getMessage();
                }
            }
            function CreateInsert()
            {                
                $this->InflateObject();
                $sql =      "INSERT INTO $this->table ";
                $columnas = "(";
                $valores =  "(";
                for ($i=0; $i < $this->countKeys; $i++)
                { 
                    if($this->primaryKey != $this->keys[$i])
                    {
                        if(!is_array($this->object[$this->keys[$i]]))
                        {
                            $columnas.= $this->keys[$i].($i < $this->countKeys-1 ? "," : "");
                            $valores.=  $this->checkType(($this->object[$this->keys[$i]])).($i < $this->countKeys-1 ? "," : "");
                        }
                    }
                }
                $valores =      trim($valores, ',');
                $columnas =     trim($columnas, ',');
                $valores .=     ")";
                $columnas .=    ") VALUES ";
                //return $sql.$columnas.$valores;
                return          $this->Insert($sql.$columnas.$valores);
            }
            function CreateUpdate()
            {
                $this->InflateObject();
                $sql =          "UPDATE $this->table SET ";
                $columnaValor = "";
                for ($i=0; $i < $this->countKeys; $i++)
                { 
                    if($this->primaryKey != $this->keys[$i])
                    {
                        if($this->object[$this->keys[$i]] != null)
                        {
                            if(!is_array($this->object[$this->keys[$i]]))
                            {
                                $columnaValor.= $this->keys[$i]."=".$this->checkType(($this->object[$this->keys[$i]])).($i < $this->countKeys-1 ? "," : "");
                            }
                        }                        
                    }
                }
                $sql.=  trim($columnaValor, ',')." WHERE $this->primaryKey=".$this->object[$this->primaryKey];
                //echo $sql;
                return  $this->Update($sql);
            }
            function CreateDelete()
            {
                $this->InflateObject();
                $sql = "UPDATE $this->table SET estatus=0 WHERE $this->primaryKey=".$this->object[$this->primaryKey];
                return $this->Update($sql);
            }
            function SelectOne($view)
            {
                $this->InflateObject();
                $sql =          "SELECT * FROM $view where $this->primaryKey=".$this->object[$this->primaryKey];
                $resultSet =    $this->Select($sql);
                if(empty($resultSet))
                    return null;
                $countResultSet = count($resultSet);
                $ArrayObject = array();
                $consultaKeys = array_keys($resultSet[0]);
                for ($i=0; $i < $countResultSet; $i++) { 
                    for ($j=0; $j < $this->countKeys; $j++) { 
                        if(!is_array($this->keys[$j]))
                        {
                            if(array_key_exists($this->keys[$j], $resultSet[0]))
                            {
                                //$ArrayObject[$i][$this->ColumnAlias[$this->keys[$j]]] = utf8_decode($resultSet[$i][$this->keys[$j]]);
                                $ArrayObject[$i][$this->ColumnAlias[$this->keys[$j]]] = utf8_decode($resultSet[$i][$this->keys[$j]]);
                            }
                            else if(array_key_exists($j, $consultaKeys))
                            { 
                                
                                $ArrayObject[$i][$consultaKeys[$j]] = utf8_decode($resultSet[$i][$consultaKeys[$j]]);
                            }
                        }
                        else
                        {
                        }
                    }
                }
                return $ArrayObject;
            }
            function SelectAll($view, $columnas="*", $condition = 1, $orderBy="")
            {
                if($orderBy == "")
                {
                    $orderBy = "order by $this->primaryKey desc";
                }
                //EJEMPLO de condition= 
                $sql = "SELECT $columnas FROM $view WHERE estatus=1 AND $condition $orderBy";
                //echo "***************** ". $sql. "******************";
                $resultSet = $this->Select($sql);
                if(empty($resultSet))
                    return null;
                $countResultSet = count($resultSet);
                $ArrayObject = array();
                $consultaKeys = array_keys($resultSet[0]);
                for ($i=0; $i < $countResultSet; $i++) { 
                    for ($j=0; $j < $this->countKeys; $j++) { 
                        if(!is_array($this->keys[$j]))
                        {
                            if(array_key_exists($this->keys[$j], $resultSet[0]))
                            {
                                $ArrayObject[$i][$this->ColumnAlias[$this->keys[$j]]] = utf8_decode($resultSet[$i][$this->keys[$j]]);
                                //echo $this->keys[$j];
                            }
                            else if(array_key_exists($j, $consultaKeys))
                            { //print_r($consultaKeys);
                                
                                //iconv('ISO-8859-1', 'UTF-8', $iso88591);
                                $ArrayObject[$i][$consultaKeys[$j]] = utf8_decode($resultSet[$i][$consultaKeys[$j]]);
                                //$ArrayObject[$i][$consultaKeys[$j]] = utf8_decode($resultSet[$i][$consultaKeys[$j]]);
                                //$ArrayObject[$i][$consultaKeys[$j]] = iconv('ISO-8859-1', 'UTF-8', $resultSet[$i][$consultaKeys[$j]]);
                            }
                        }
                        else
                        {
                        }
                    }
                }
                //print_r($ArrayObject);
                return  $ArrayObject;
            }
            function ToJson()
            {
                $fn = new Funciones();
                return $fn->ArrayToJson($this->values);
            }
            function ResultSetToJson($resultSet)
            {
                $fn = new Funciones();
                return $fn->ArrayToJson($resultSet);
            }
                  
        }
    }
?>