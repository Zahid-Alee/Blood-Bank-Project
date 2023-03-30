<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // $name = ;
  // $email = ;
  
  $data=['name'=>$_POST['name'],'email'=>$_POST['email']];
  print_r($data);
  // Do something with the data (e.g. store it in a database)

  $response = 'Data received successfully!';
  echo $response;
}
?>
