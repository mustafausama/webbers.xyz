<?php
if(!$config->ajax)
    throw new \ProcessWire\Wire404Exception();

header('Content-Type: application/json');

if(!isset($_POST['case']) || is_null($_POST['case']) || empty($_POST['case']) || !$_POST['case']) {

    $rData['status'] = 'failed';
    $rData['message'] = 'Case must be known';
    die(json_encode($rData));

}

$ajax = $modules->getModule('Helloworld');

switch($_POST['case']) {

    case 'comment':
        
        if(!isset($_POST['comment']) || is_null($_POST['comment']) || empty($_POST['comment']) || !$_POST['comment'] ||
            !isset($_POST['post']) || is_null($_POST['post']) || empty($_POST['post']) || !$_POST['post']) {

            $rData['status'] = 'failed';
            $rData['message'] = 'Some requirements are not there';
            die(json_encode($rData));

        }

        $rData = $ajax->commentOn($_POST['post'], $_POST['comment']);
        echo json_encode($rData);

    break;
    case 'task':
        if(!isset($_POST['unitID']) || is_null($_POST['unitID']) || empty($_POST['unitID']) || !$_POST['unitID'] ||
            !isset($_POST['taskData']) || is_null($_POST['taskData']) || empty($_POST['taskData']) || !$_POST['taskData']) {

            $rData['status'] = 'failed';
            $rData['message'] = 'Some requirements are not there';
            die(json_encode($rData));

        }
        
        $rData = $ajax->taskFor($_POST['unitID'], $_POST['taskData']);
        echo json_encode($rData);
    break;

}

?>
