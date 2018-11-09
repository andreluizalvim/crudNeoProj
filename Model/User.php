<?php
require_once __DIR__.'/Conn.php';
require_once __DIR__.'/Config.php';
require_once __DIR__.'/Model.php';
/**
 * Modelo de usuário 
 * 
 * @property string $Usuario
 * @property string $Email
 * @property string $Senha
 * @property string $CPF
 * @property int $ID
 *  
 */
class User implements Model{
    
    
    /**
     * Tabela no BD referente ao objeto User
     */
    private const table = 'Usuario';
    public $Usuario;
    public $Email;
    public $ID;
    public $Senha;
    public $CPF;

    public function __construct(string $Usuario, string $Email, string $CPF, string $Senha)
    {   
        $this->Usuario = $Usuario;
        $this->Email = $Email;
        $this->Senha = $Senha;
        $this->CPF = $CPF;
        $this->ID = null;
    }
    
    public function getId(){
        return $this->ID;
    }
    /**
     * Carrega dados do objeto a partir de um banco de dados
     *
     * @param integer $ID
     * @return User
     */
    public static function load(int $ID){
    
        $table = self::table;
        $conn = new Conn();
        $userData = $conn->findById($table,$ID);
        if($userData != null){
            return User::toObject($userData);
        }else{
            echo 'Esse objeto nao existe';
            return null;
        }
    }
    /**
     * Carrega todos os usuarios do banco para uma lista de users
     *
     * @return array[User]
     */
    public static function loadAll(){
        $table = self::table;
        $conn = new Conn();
        $data = $conn->findAll($table);
        $users = [];
        foreach($data as $row){
            $users[] = User::toObject($row);
        }
        
        return $users;
    }
    
    /**
     * Converte o objeto para um Array com seus atributos
     *
     * @return void
     */
    public function toArray(){
        $array = [
            'Usuario' => $this->Usuario,
            'Email' => $this->Email,
            'ID' => $this->ID,
            'Senha' => $this->Senha,
            'CPF' => $this->CPF
        ];
        return $array;
    }
    /**
     * Converte um Array para um objeto User
     *
     * @param array $array
     * @return User
     */
    public static function toObject(array $array){
        $user = new User(
            $array['Usuario'],
            $array['Email'],
            $array['Senha'],
            $array['CPF']
            
        );
        $user->ID = $array['ID'];
        return $user;
    }
    
    /**
     * Salva o objeto no banco de dados
     * ou atualiza se o mesmo CPF ja existir
     *
     * @return void
     */
    public function save(){
        
        $table = self::table;
        $conn = new Conn();
        if($this->ID == null){
            $conn->insert($table,$this->toArray());
            echo 'carai';
        }else{
            $conn->updateById($table,$this->ID,$this->toArray());
            echo 'porra';
        }        
    }
    /**
     * Deleta usuário
     *
     * @return boolean
     */
    public function delete(){
        $table = self::table;
        $conn = new Conn();
        return $conn->deleteById($table,$this->ID);
    }

}