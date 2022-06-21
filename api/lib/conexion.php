<?php
    namespace ConexionNameSpace
    {
        use PDO;
        class ConexionMysql
        {
            private $server, $usr, $pwd, $cnx, $db, $debug;
            function __construct()
            {
                $this->debug =  true;
                $this->server = "localhost";
                if($this->debug)
                {
                    $this->usr =    "root";
                    $this->pwd =    "";
                    $this->db =     "bdveranoAPI";
                }
                else
                {
                    $this->usr =    "tecmon5_veranoAPI";
                    $this->pwd =    "s!.CzLki?fe+";
                    $this->db =     "tecmon5_veranoAPI";
                }
                    
            }
            function Open()
            {
                $this->cnx = new PDO("mysql:host=$this->server;dbname=$this->db;charset=UTF8",$this->usr, $this->pwd);
                $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$this->Update("SET NAMES 'utf8'");
                
                return "1"; 
            }
            function Close()
            {
                $this->cnx = null;
            }
            function Select( $sql )
            {
                try 
                {
                    $x =        $this->Open();
                    $stmt =     $this->cnx->prepare( $sql ); 
                    $stmt->execute();
                    $this->Close();
                    $result =   $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $arr =       $stmt->fetchAll();
                    $countElementoArreglo = count($arr);
                    if($countElementoArreglo === 0)
                        return null;
                    $keysElementoArreglo = array_keys($arr[0]);
                    $countKeysElementoArreglo = count($keysElementoArreglo);
                    $option = '';
                    for ($i=0; $i < $countElementoArreglo; $i++) 
                    {
                        $elementoArr = $arr[$i];
                        for ($j=0; $j < $countKeysElementoArreglo; $j++){                             
                            $arr[$i][$keysElementoArreglo[$j]] = utf8_encode($elementoArr[$keysElementoArreglo[$j]]) ;
                        }
                    }
                    return $arr;
                } 
                catch(PDOException $e)
                {
                    return "Select error: " . $e->getMessage();
                }
            }
            function Selecciona( $sql )
            {
                try 
                {
                    $x =        $this->Open();
                    $stmt =     $this->cnx->prepare( $sql ); 
                    $stmt->execute();
                    $this->Close();
                    $result =   $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $arr =       $stmt->fetchAll();
                    $countElementoArreglo = count($arr);
                    if($countElementoArreglo === 0)
                        return null;
                    $keysElementoArreglo = array_keys($arr[0]);
                    $countKeysElementoArreglo = count($keysElementoArreglo);
                    $option = '';
                    for ($i=0; $i < $countElementoArreglo; $i++) 
                    {
                        $elementoArr = $arr[$i];
                        for ($j=0; $j < $countKeysElementoArreglo; $j++){                             
                            $arr[$i][$keysElementoArreglo[$j]] = ($elementoArr[$keysElementoArreglo[$j]]) ;
                        }
                    }
                    return $arr;
                } 
                catch(PDOException $e)
                {
                    return "Select error: " . $e->getMessage();
                }
            }
            function Insert( $sql )
            {
                try
                {
                    $this->Open();
                    $this->cnx->exec($sql);
                    $lastInsertedId = $this->cnx->lastInsertId();
                    $this->Close();
                    return $lastInsertedId;
                }
                catch(PDOException $e)
                {
                    return $sql . "<br>" . $e->getMessage();
                }
            }
            function Delete( $sql )
            {
                try
                {
                    $this->Open();
                    $this->cnx->exec($sql);
                    $this->Close();
                    return "1";
                }
                catch(PDOException $e)
                {
                    return "0";
                }
            }
            function Update( $sql )
            {
                try 
                {
                    $this->Open();
                    $stmt = $this->cnx->prepare( $sql );
                    $stmt->execute();
                    $this->Close();
                    return $stmt->rowCount();
                } 
                catch (PDOException $e) 
                {
                    return $e->getMessage();
                }
            }
        }
        
    }
?>