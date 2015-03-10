<?php
include_once "dbconfig.php";
/*
 * generic database CRUD
 * JSONP return;
 */
function processCmd($params,$validvars=null) {
    global $module;
    $orgcmd = $params;
    
    $cmd = $params['cmd'];
    $id = $params['id'];

    unset($params['cmd']);
    if (empty($id)) unset($params['id']);
    //unset($params['id']);

    switch($cmd){
        case"add":
                $validate = true;
                $validationError = array();
                
                if ($validate === true) {   // handle insert
                    if (!isset($params['id'])) {
                        unset($params['id']);
                        $var1 = array();
                        $varvalues = "";
                        $i=0;
                        foreach ($validvars as $v) {
                            if (!isset($params[$v])) continue;
                            $vars[] = $v;
                            if ($i != 0) $varvalues .= "','" . $params[$v];
                            else $varvalues .= $params[$v];
                            $i++;
                        }
                        $varvalues = "('$varvalues')";
                        $varnames = "(".implode(",",$vars).")";
                        
                        $query = "INSERT INTO ".$module."s $varnames VALUE $varvalues";

                        $result = mysql_query($query);
                        if($result) { exit(json_encode(array('success' => true, 'msg' => 'Saved!','id' => mysql_insert_id(),'query'=> $query,"params"=>$orgcmd))); }
                        exit(json_encode(array('success' => false, 'msg' => 'Failed!','query'=> $query,"params"=>$orgcmd,"SQL Error"=>mysql_error() )));
                    } 
                    else {  // handle update
                        $varvalues = "";
                        if ($module=="queue") {
                            if ($params["schedule_random"]) {
                                unset($params["schedule_random"]);
                                $random60 = "floor(rand() * 60)"; // randome number between 0-30
                                $params['schedule_date'] = "#( NOW() + INTERVAL $random60 DAY )";
                                $params['scheduled'] = 1;
                            }
                        } 
                        $i = 0;
                        foreach ($params as $k => $v) {
                            //if (!isset($validvars[$k])) continue;
                            if (substr($v,0,1)=="#") {
                                if ($i!=0) $varvalues .= ", $k = ".substr($v,1);
                                else $varvalues .= "$k = ".substr($v,1);
                            }
                            else {
                                if ($i!=0) $varvalues .= ", $k = '".$v."'";
                                else $varvalues .= "$k = '".$v."'";
                            }   
                            $i++;
                        }
                        //$varvalues = "('".$varvalues."')";

                        $query = "UPDATE ".$module."s SET $varvalues WHERE id = '$id'";

                        $result = mysql_query($query);
                        if($result) { exit(json_encode(array('success' => true, 'msg' => 'Saved!','query'=> $query,"params"=>$orgcmd))); }
                        exit(json_encode(array('success' => false, 'msg' => 'Failed!','query'=> $query,"params"=>$orgcmd,"SQL Error"=>mysql_error())));
                    }
                    
                }
                echo json_encode(array(
                    'success' => false, 
                    'msg'     => 'there is a problem, please check ', 
                    'validationError' => $validationError,
                    'validation' => $validate,
                    'id' => $id,
                    'params' => print_r($params,true),
                    'query' => $query
                ));
            break;

        case"delete":
                $query = "DELETE FROM ".$module."s WHERE id = '$id' ";
                $result = mysql_query($query);

                if ($result) {
                   echo json_encode(array('success' => true,'query'=> $query,"params"=>$orgcmd));
                }
                else {
                   echo json_encode(array('success' => false,
                        'msg' => 'Error deleting '.$module,'query'=> $query,"params"=>$orgcmd,"SQL Error"=>mysql_error()
                   ));
                }
            break;
        case"list":
                if($id) {
                    $query = "SELECT * FROM ".$module."s WHERE id = '$id' ORDER BY id DESC";
                }
                else if(count($params)) {
                    // only handles one parameter for now.
                    foreach($params as $k => $v) {
                        $query = "SELECT * FROM ".$module."s WHERE $k = '$v' ORDER BY id DESC";
                        break;
                    }
                }
                else {
                    $query = "SELECT * FROM ".$module."s ORDER BY id DESC";
                }
                $feeds = array();
                $items = array();
                $result = mysql_query($query);

                while($row = mysql_fetch_array($result)):
                    foreach ($row as $k => $v) $items[$k] = $v;
                    $feeds[] = $items;
                endwhile;

                echo json_encode($feeds);
            break;
    }
}
?>
