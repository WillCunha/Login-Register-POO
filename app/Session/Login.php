<?php

namespace App\Session;

class Login{


    /**
     * Método que inicializa a sessão
     */
    private static function init(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
    }


    public static function getUserLogado(){
        self::init();

        return self::isLogged() ? $_SESSION['user'] : null;
    }

    /**
     * Método que loga o user
     * @param User $obUser;
     */
    public static function login($obUsuario){
        //CHAMA O MÉTODO QUE INICIA A SESSÃO
        self::init();

        //SESSÃO DE USUARIO
        $_SESSION['user'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email,
        ];

        header('Location: index.php');
        exit;
    }

    /**
     * Método que desloga o user
     */
    public static function logout(){

        //Inicia a sessão
        self::init();

        //Quebra a sessão do usuario
        unset($_SESSION['user']);

        //Redireciona pra login
        header('location: login.php');
        exit;
    }


    /**
     * Método que verifica se o user ta logado
     * @return boolean
     */
    public static function isLogged(){
        
        //CHAMA O MÉTODO QUE INICIA A SESSÃO
        self::init();

        //VALIDA A SESSÃO
        return isset($_SESSION['user']['id']);;


    }

    /**
     * Método que requere o login nas páginas
     */
    public static function requireLogin(){
        if(!self::isLogged()){
            header('Location: login.php');
            exit;
        }
    }

    /**
     * Método que força o user já logado a ser redirecionado
     */
    public static function requireLogout(){
        if(self::isLogged()){
            header('Location: index.php');
            exit;
        }
    }


}
