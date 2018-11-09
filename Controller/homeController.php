<?php
require'../Model/User.php';
/**
 * Arquivos de rotas para as requisições AJAX 
 * que utilizam o atributo 'key' da requisição 
 * para especificar qual função será utilizada
 * 
 */
switch($_SERVER['REQUEST_METHOD']){
    case'POST':
        switch($_POST['key']){
            case'save':
                $Usuario = $_POST['Usuario'];
                $Email = $_POST['Email'];
                $Senha = $_POST['Senha'];
                $CPF = $_POST['CPF'];
                
                if($Usuario !='' && $Email!='' && $Senha !='' && $CPF != '' &&
                        $Usuario !=null && $Email!=null && $Senha !=null && $CPF !=null){
                    $user = new User($Usuario,$Senha,$Email,$CPF);
                    $user->save();
                    echo 'controller linkado';
                }
                break;
            
            case'update':
                $Usuario = $_POST['Usuario'];
                $Email = $_POST['Email'];
                $Senha = $_POST['Senha'];
                $CPF = $_POST['CPF'];
                $user = User::load($ID);
                if($Usuario !='' && $Email!='' && $Senha !='' && $CPF != '' &&
                        $Usuario !=null && $Email!=null && $Senha !=null && $CPF !=null){
                $user->save();
                break;
                }    
            default:    
                echo'Ajax error';
                break;
        }
    case'GET':
        switch($_GET['key']){
            case'delete':
                $ID = $_GET['ID'];
                $user = User::load($ID);
                $user->delete();
                break;
            
            /**
             * Retorna uma lista de usuarios no formato JSON
             */
            case'renderTable':
                $users = User::loadAll();
                echo json_encode($users);
                break;
            
            default:    
                echo'Ajax error';
                break;
        }
        
}