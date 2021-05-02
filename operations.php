<?php

require_once 'DB.php';

$request = $_REQUEST['actions'];

$DBO = new DB();
$DBO->DBConnect();

switch ($request) {
    case 'getCities':
        
        $state_id = $_REQUEST['state_id'];

        $city_lists = $DBO->getCityByState($state_id);

        $html = '';

        $html .= '<option value="" selected>Select City</option>';

        for ($i=0; $i<count($city_lists); $i++) { 
            $html .= '<option value="'.$city_lists[$i]['id'].'">'.$city_lists[$i]['city_name'].'</option>';
        }

        echo json_encode($html);

    break;

    case 'addFeedback':

        $data = array(
            'name' => $_REQUEST['name'],
            'state_id' => $_REQUEST['state'],
            'city_id' => $_REQUEST['city'],
            'feedback' => $_REQUEST['feedback']
        );

        $results = $DBO->addFeedback($data);
        header('Location:index.php');
        

    break;    

    default:
        
    break;
}


?>