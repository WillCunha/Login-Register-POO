<?php

namespace App\Entidade;

use \App\Db\Database;
use \PDO;

class User{

    /**
     * Identificador do user
     * @var integer
     */
    public $id;

    /**
     * Nome do user
     * @var string
     */
    public $nome;

    /**
     * E-mail do user
     * @var string
     */
    public $email;

    /**
     * Hash da senha do user
     * @var string
     */
    public $senha;

    /**
     * Método que cadastrada o user
     * @return boolean
     */
    public function cadastrar(){

        //DATABASE
        $obDatabase = new Database('user');

        //Insere user
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
        ]);

        //Sucesso
        return true;

    }

    /**
     * Método que busca o usuario pelo email
     * @param string $email
     * @return User
     */
    public static function getUserEmail($email){
        return (new Database('user'))->select('email = "' .$email.'"')
                                ->fetchObject(self::class);
    }


}

?>