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
    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "dessenha"=>$this->getDesSenha(),
            "deslogin"=>$this->getDesLogin(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y  h:i:s")

        ));
    }
}