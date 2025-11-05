<?php

class VoltarController extends Controller
{
	private $data = array();
    public function TableDelivery(){
        header('Location:'. BASE_URL .'Business/Delivery');
        exit;
    }
    public function Compras(){
         header('Location:'. BASE_URL .'Business/ComprasFinalizadas');
        exit;
    }
    public function ComprasPendentes(){
         header('Location:'. BASE_URL .'Business/ComprasPedentes');
        exit;
    }
    public function TableFinish(){
        header('Location:'. BASE_URL .'Business/ComprasRealizadas');
        exit;
    }
}