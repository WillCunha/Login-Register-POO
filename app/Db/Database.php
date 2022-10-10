<?php

namespace App\Db;

use \PDO;
use PDOException;

class Database{

    /**
     * Define o host do banco
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Define o nome do banco
     * @var string
     */
    const NAME = 'wfvagas';

    /**
     * Define o user do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Define a senha do banco
     * @var string
     */
    const PASS = '';

    /**
     * Define o nome da tabela
     * @var string
     */
    private $table;

    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    public function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    public function execute($query, $params = []){
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die ('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método que insere os dados no banco
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */
    public function insert($values){
        //DADOS DA QUERY
        $campos = array_keys($values);
        $dados = array_pad([], count($campos), '?');
        
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$campos).') VALUES ('.implode(',',$dados).')';

        $this->execute($query,array_values($values));

        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*'){

        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT * FROM '.$this->table.' ' . $where . ' ' . $order . ' ' . $limit . ' ';

        return $this->execute($query);

    }


    

}

?>