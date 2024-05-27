<?php

class usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;
    }
    
    public function getDesLogin(){
        return $this->deslogin;
    }
    public function setDesLogin($value){
        $this->deslogin = $value;
    }
    
    public function getDesSenha(){
        return $this->dessenha;
    }
    public function setDesSenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){

        $Sql = new SQL();

        $result = $Sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        if (count($result)>0) {
            $this->setData($result[0]);
        }
    }

    public static function getList(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login){
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH   ORDER BY deslogin", array(
            ":SEARCH"=>"%".$login."%"
        ));
    } 

    public function login($login, $password){

        $Sql = new SQL();

        $result = $Sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN AND dessenha LIKE :PASSWORD", array(
            ":LOGIN"=>$login, ":PASSWORD"=>$password
        ));
        if (count($result)>0) {
            $this->setData($result[0]);

        }else {
            throw new Exception("Login e/ou senha invalidos!");
        }
    }


    public function setData($Data){
    
        $this->setIdusuario($Data["idusuario"]);
        $this->setDesLogin($Data["deslogin"]);
        $this->setDesSenha($Data["dessenha"]);
        $this->setDtcadastro(new DateTime($Data["dtcadastro"]));

    }


    public function insert(){
        $sql = new SQL();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"=>$this->getDesLogin(),
            ":PASSWORD"=>$this->getDesSenha()
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }

    public function update($login, $password){
        $this->setDesLogin($login);
        $this->setDesSenha($password);

        $sql = new SQL();
        $results = $sql->executeQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID ", array(
            ":LOGIN"=>$this->getDesLogin(),
            ":PASSWORD"=>$this->getDesSenha(),
            ":ID"=>$this->getIdusuario(),
        ));
        

    }
    public function __construct($login = "", $password = "")
    {
        $this->setDesLogin($login);
        $this->setDesSenha($password);
    }



    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDesLogin(),
            "dessenha"=>$this->getDesSenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y  h:i:s")
        ));
    }
}