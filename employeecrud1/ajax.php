<?php

// print_r($_FILES);
// die;



$action=$_REQUEST['action'];

if(!empty($action)){
    require_once 'user.php';
    $obj=new user();
}

// adding user action
if($action=='adduser' && !empty($_POST)){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $address=$_POST['address'];
    $department=$_POST['department'];
    $designation=$_POST['designation'];
    $photo=$_FILES['photo'];

    // $playerid=(!empty($_POST['userId']))? $_POST['userId']: "";
    $playerid=(!empty($_POST['userid'])) ? $_POST['userid']:'';

    // file (photo) upload

    $imagename="";
    if(!empty($photo['name'])){
        $imagename=$obj->uploadPhoto($photo);
        $playerData=[
            'name'=>$name,
            'email'=>$email,
            'number'=>$number,
            'address'=>$address,
            'department'=>$department,
            'designation'=>$designation,
            'photo'=>$imagename,
        ];
    }else{
        $playerData=[
            'name'=>$name,
            'email'=>$email,
            'number'=>$number,
            'address'=>$address,
            'department'=>$department,
            'designation'=>$designation,
        ];
    }
    if($playerid){
        obj->update($playerData,$playerid)
    }else{
        $playerid=$obj->add($playerData);
    }



    
    if(!empty($playerid)){
        $player=$obj->getRow('id',$playerid);
        echo json_encode($player);
        exit(); 
    }
}

// getcountof function and getallusers action

if($action=='getallusers'){
    $page=(!empty($_GET['page']))?$_GET['page']:1;
    $limit = 4; 

    $start=($start-1)*$limit;
    $users=$obj->getRows($start,$limit);
    if(!empty($users)){
        $userlist=$users;
    }else{
        $userlist=[];
    }
    $total=$obj->getCount();
    $userArr=['count'=>$total,'users'=>$userlist]; 
    echo jason_encode($userlist); 
    exit();

}


// action to perform editing
if($action=="editusersdata"){
    $playerid=(!empty($_GET['id'])) ? $_GET['id']:'';
    if(!empty($playerid)){
        $user=$obj->getRow('id',$playerid);
        echo json_encode($user);
        exit(); 
    }
}


// perform deleting
if($action=='deleteuser'){
    $userid=(!empty($_GET['id'])) ? $_GET['id']:'';
    if(!empty($userid)){
        $sideleted=$obj->deleteRow($userid);
        if($isdeleted){
            $displaymessage=['delete'=>1];
        }else{
            $displaymessage=['delete'=>0];
        }
        echo json_encode($displaymessage);
        exit();
    }
}

?>