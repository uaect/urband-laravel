<?php
function getOrders()
{
$result = \App\Orders::where('read', '=', '0')->get(['read']);
return $result;
}
function getOrderRead($id = NULL)
{
$result = \App\Orders::where(array('id'=>$id,'read'=>'0'))->get(['read']);
return $result;
}
function getTickets()
{
$result = \App\EventTickets::where(array('read'=>'0'))->get(['read']);
return $result;
}
function getTicketRead($id = NULL)
{
$result = \App\EventTickets::where(array('id'=>$id,'read'=>'0'))->get(['read']);
return $result;
}
