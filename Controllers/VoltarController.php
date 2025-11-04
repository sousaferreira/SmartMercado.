<?php

class VoltarController extends Controller
{
	private $data = array();
    public function TableDelivery(){
        header('Location:'. BASE_URL .'Business/Delivery');
        exit;
    }
    public function Compras(){
         header('Location:'. BASE_URL .'Business/Buy');
        exit;
    }
    public function TableFinish(){
        header('Location:'. BASE_URL .'Business/ComprasRealizadas');
        exit;
    }
}