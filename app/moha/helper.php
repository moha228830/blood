<?php

 function get_response($state,$msg,$data)
{
$response=[
"state"=>$state,
"msg"=>$msg,
"data"=>$data

];

return  response()->json($response);


}





?>
