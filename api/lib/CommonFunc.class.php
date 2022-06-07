<?php
    namespace CommonFuncNamespace
    {
       /* */
        class CommonFunc //extends Conexion
        {
            function __construct()
            {
                //parent::__construct();
            }
            /* Generar Nueva Clase 'Administracion' p/ incluir todas las funciones de menus y permisos,
                logins etc.
            */
            function ArrayToOption($arr, $selected = "0")
            {
                $countElementoArreglo = count($arr);
                $keysElementoArreglo = array_keys($arr[0]);
                $countKeysElementoArreglo = count($keysElementoArreglo);
                $option = '';
                for ($i=0; $i < $countElementoArreglo; $i++) 
                {
                    $elementoArr = $arr[$i];
                    
                    $option.= '<option value="' . $elementoArr['id'] . '" '.($selected == $elementoArr['id'] ? 'selected' : '').'>' . utf8_decode($elementoArr['descripcion']) . '</option>';
                }
                return $option;
            }
            function EditForm($rs, $primaryKey, $d, $ColumnAlias)
            {
                return $this->CreateForm($rs, $primaryKey, $d, $ColumnAlias, true);
            }
            function AddForm($rs, $primaryKey, $d, $ColumnAlias)
            {
                return $this->CreateForm($rs, $primaryKey, $d, $ColumnAlias, false);
            }
            function CreateForm($rs, $primaryKey, $d, $ColumnAlias, $editando)
            {
                $ArrayKeys =    array_keys($rs[0]);
                $countKeys =    count($ArrayKeys);
                $countRow =     count($rs);
                $html = '<div id="frm">';
                for ($i=0; $i < $countRow; $i++)
                { 
                    for ($j=0; $j < $countKeys; $j++) { 
                        if($primaryKey != $ArrayKeys[$j])
                        {
                            $id = str_replace(' ', '', $ArrayKeys[$j]);
                            if(!is_array($rs[$i][$ArrayKeys[$j]]))
                            {                                    
                                if($ArrayKeys[$j] == "password")
                                {
                                    $html .= '<div class="form-group">
                                    <label for="' . $ArrayKeys[$j] . '">' . $ColumnAlias[$ArrayKeys[$j]] . '</label>
                                    <input type="password" class="form-control" id="' . $id . '" name="' . $ArrayKeys[$j] . '" placeholder="" '.$d.'>
                                </div>';
                                    $html .= '<div class="form-group">
                                    <label for="confirma' . $ArrayKeys[$j] . '">Confirma ' . $ColumnAlias[$ArrayKeys[$j]] . '</label>
                                    <input type="password" class="form-control" id="confirma' . $ArrayKeys[$j] . '" placeholder="" '.$d.' />
                                </div>';
                                }
                                else
                                {
                                    $html .= '<div class="form-group">
                                    <label for="' . $ArrayKeys[$j] . '">' . $ArrayKeys[$j] . '</label>
                                    <input type="text" class="form-control" id="' . $id . '" name="' . $ArrayKeys[$j] . '" value="'.$rs[$i][$ArrayKeys[$j]].'" '.$d.'>
                                </div>';
                                }
                            }
                                                    
                        }
                        else
                        {
                            $html .= '<input type="hidden" value="'.$rs[$i][$ArrayKeys[$j]].'" name="'.$primaryKey.'" />';
                        }
                    }
                }
                $html .=    '<div class="text-right"><button class="btn btn-secondary mr-1" type="button" id="btnCancelar">Cancelar</button><button class="btn btn-primary" type="button" id="btnAceptar" data-editando="'.($editando ? 1 : 0).'">Aceptar</button></div>';
                $html .= '</div>';
                return $html;
            }
            function ArrayToJson($arr)
            {
                $countElementoArreglo = count($arr);
                $keysElementoArreglo = array_keys($arr[0]);
                $countKeysElementoArreglo = count($keysElementoArreglo);
                $jsonResponse = '';
                //if($countElementoArreglo > 1)
                    $jsonResponse.= '[';
                for ($i=0; $i < $countElementoArreglo; $i++) 
                {
                    $elementoArr = $arr[$i];
                    $jsonResponse.= '{';
                    for ($j=0; $j < $countKeysElementoArreglo; $j++) {
                        $elemento = $keysElementoArreglo[$j];
                        $jsonResponse.= '"'.$elemento.'":';
                        $jsonResponse.= '"'.($elementoArr[$elemento]).'"'.($j < $countKeysElementoArreglo-1 ?',' : '');
                    }
                    $jsonResponse.= '}'.($i < $countElementoArreglo-1 ? ',' : '');
                }
               // if($countElementoArreglo > 1)
                    $jsonResponse.= ']';
                return $jsonResponse;
            }
            function CreateBody($rs, $withCheck, $inicio)
            {
                $tbody =    '<tbody>';
                $keys =     array_keys( $rs[0] );
                //print_r($keys);
                for ($i = 0; $i < count($rs); $i++) {
                    $element = $rs[$i];
                    $tbody .=   '<tr>';
                    if($withCheck == "check") {
                        $tbody .=   '<td class="text-center"><input type="checkbox" value="' . $element[$keys[0]] . '" /></td>';
                    }
                    else if( $withCheck == "button")
                    {
                        $tbody .=   '<td class="text-center"><button type="button" class="btn btn-outline-primary btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '">Seleccionar <span class="fas fa-check"></span></button></td>';
                    }
                    else if( $withCheck == "buttonDelete")
                    {
                        $tbody .=   '<td class="text-center"><button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '">Editar <span class="fas fa-edit"></span></button>
                        <button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . '">Eliminar <span class="fas fa-trash"></span></button></td>';
                    }
                    else if( $withCheck == "buttonDeleteValidar")
                    {
                        $tbody .=   '<td class="text-center"><button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '">Editar <span class="fas fa-edit"></span></button>
                        <button type="button" data-accion="Validar" class="btn btn-success btn-xs" data-value="' . $element[$keys[0]] . '">Validar <span class="fas fa-check"></span></button>
                        <button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . '">Eliminar <span class="fas fa-trash"></span></button></td>';
                    }
                    else if( $withCheck == "buttonDeleteAggCarrera")
                    {
                        $tbody .=   '<td class="text-center">
                            <button type="button" class="btn btn-warning btn-sm" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . '">Editar <span class="fas fa-edit"></span></button>
                            <button type="button" data-accion="AdministrarCarrera" class="btn btn-success btn-sm" data-value="' . $element[$keys[0]] . '">Carreras <span class="fas fa-check"></span></button>
                            <button type="button" data-accion="Eliminar" class="btn btn-danger btn-sm" data-value="' . $element[$keys[0]] . '">Eliminar <span class="fas fa-trash"></span></button>
                        </td>';
                    }
                    for($j = $inicio; $j < count($keys); $j++) {
                        $tbody .=   '<td>' .( $element[$keys[$j]]) . '</td>';
                    }
                    $tbody .=   '</tr>';
                }
                $tbody .=   '</tbody>';
                return $tbody;
            }
            function ArrayToTable($rs, $withCheck = "check")
            {
                if($rs == null)
                {
                    return 'No existen resultados';
                }
                $table =    '<table class="table">';
                $thead =    '<thead>';
                $keys =     array_keys( $rs[0] );
                //print_r ( $rs[0] );
                $inicio =   0;
                $thead .=   '<tr>';
                if($withCheck == "check") {
                    $thead .=   '<th>Selecciona uno</th>';
                    $inicio =   1;
                }
                else if("button" == $withCheck || "buttonDelete" == $withCheck || "buttonDeleteValidar" == $withCheck || "buttonDeleteAggCarrera" == $withCheck)
                {
                    $thead .=   '<th></th>';
                    $inicio =   1;
                }
                for ($i = $inicio; $i < count($keys); $i++)
                {
                    $element =  utf8_decode($keys[$i]);
                    $thead .=   '<th>' .( $element ). '</th>';
                }
                $thead .=   '</tr></thead>';                
                $table .=   $thead . $this->CreateBody($rs, $withCheck, $inicio) . '</table>';
                return $table;   
            }
             function ArrayToTableButtons($rs, $botones = "")
            {
                if($rs == null)
                {
                    return 'No existen resultados';
                }
                $table =    '<table class="table">';
                $thead =    '<thead>';
                $keys =     array_keys( $rs[0] );
                $inicio =   0;
                $thead .=   '<tr>';
                $withCheck="";
                if($withCheck == "") {
                    $thead .=   '<th></th>';
                    $inicio =   1;
                }
                else if("button" == $botones || "buttonDelete" == $botones || "buttonDeleteValidar" == $botones || "buttonDeleteAggCarrera" == $botones)
                {
                    $thead .=   '<th></th>';
                    $inicio =   1;
                }
                for ($i = $inicio; $i < count($keys); $i++)
                {
                    $element =  utf8_decode($keys[$i]);
                    $thead .=   '<th>' .( $element ). '</th>';
                }
                $thead .=   '</tr></thead>';                
                $table .=   $thead . $this->CreateBody2($rs, $withCheck,$botones, $inicio) . '</table>';
                return $table;   
            }
             function CreateBody2($rs, $withCheck, $botones, $inicio)
            {
                $tbody =    '<tbody>';
                $keys =     array_keys( $rs[0] );
                for ($i = 0; $i < count($rs); $i++) {
                    $element = $rs[$i];
                    $tbody .=   '<tr>';
                    if($withCheck == "check") {
                        $tbody .=   '<td class="text-center"><input type="checkbox" value="' . $element[$keys[0]] . '" /></td>';
                    }
                   if( $botones == "buttonDeleteValidar")
                    {
                        $tbody .=   '<td class="text-center">
                        <button type="button" data-accion="Validar" class="btn btn-success btn-xs" data-value="' . $element[$keys[0]] . ' data-bs-toggle="tooltip" data-bs-placement="top" title="Validar"> <span class="fas fa-check"></span></button>
                        <button type="button" class="btn btn-warning btn-xs" data-accion="Seleccionar" data-value="' . $element[$keys[0]] . ' data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><span class="fas fa-edit"></span></button>
                        <button type="button" data-accion="Eliminar" class="btn btn-danger btn-xs" data-value="' . $element[$keys[0]] . ' data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><span class="fas fa-trash"></span></button></td>';
                    }
                    else if( $botones == "")
                    {
                        $tbody .=   '<td class="text-center">
                           
                        </td>';
                    }
                    for($j = $inicio; $j < count($keys); $j++) {
                        $tbody .=   '<td>' .( $element[$keys[$j]]) . '</td>';
                    }
                    $tbody .=   '</tr>';
                }
                $tbody .=   '</tbody>';
                return $tbody;
            }
        }
        
/*
        $cnx = new CommonFunc();
        print_r($cnx->ObtenerMenu(1, 5));
*/
    }
?>