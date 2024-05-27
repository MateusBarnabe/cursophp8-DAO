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
            $row = $result[0];
            $this->setIdusuario($row["idusuario"]);
            $this->setDesLogin($row["deslogin"]);
            $this->setDesSenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));

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
            $row = $result[0];
            $this->setIdusuario($row["idusuario"]);
            $this->setDesLogin($row["deslogin"]);
            $this->setDesSenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));

        }else {
            throw new Exception("Login e/ou senha invalidos!");
        }
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