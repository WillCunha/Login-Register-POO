<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entidade\User;
use \App\Session\Login;
Login::requireLogout();

$alertaLogin = '';
$alertaCadastro = '';

if(isset($_POST['acao'])){
    

    switch ($_POST['acao']) {
        case 'logar':

            //BUSCA USER POR EMAIL
            $obUsuario = User::getUserEmail($_POST['email']);

            //VALIDA A INSTANCIA E A SENHA
            if(!$obUsuario instanceof User  || password_verify($_POST['senha'],$obUsuario->senha)){
                $alertaLogin = 'Usuário e/ou senha incorretos';
                break;
            }
            Login::login($obUsuario);
            exit; 
            break;
        
        case 'cadastrar':
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){

                $obUsuario = User::getUserEmail($_POST['email']);
                if($obUsuario instanceof User){
                    $alertaCadastro = 'O e-mail já está cadastrado!';
                    break;
                }

                $obUsuario = new User;
                $obUsuario->nome = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();

                Login::login($obUsuario);
            }

            break;
    }
    
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/form-login.php';
include __DIR__.'/includes/footer.php';

?>