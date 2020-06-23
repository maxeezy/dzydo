<?php


class DB extends PDO
{
    public function __construct()
    {
        $db_paramPath = ROOT.'/config/db_params.php';
        $db_param = include ($db_paramPath);
        $dsn = "mysql:host={$db_param['host']};dbname={$db_param['dbname']}";
        try{
            parent::__construct($dsn, $db_param['user'], $db_param['password'],$db_param['option']);
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public  function add($sql, $params)
    {
        $stmt = $this->prepare($sql);
        return $stmt->execute($params);
    }

    public  function queryObj($sql, $params)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $some = $stmt->fetch(PDO::FETCH_OBJ);

    }
    public  function queryAssoc($sql, $params)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $some = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public  function queryAssocNoP($sql)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $some = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public  function queryObjNoP($sql)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $some = $stmt->fetch(PDO::FETCH_OBJ);

    }


}