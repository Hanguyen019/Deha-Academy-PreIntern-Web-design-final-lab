<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
class DB{
static private $connection;
const DB_TYPE = "mysql";
const DB_HOST = "localhost";
const DB_NAME = "curd";
CONST USER_NAME = "root";
CONST USER_PASSWORD = "";

static public function getConnection()
  { if (static ::$connection == null)
    {
        try 
    {static::$connection =  new PDO( self::DB_TYPE.":host=".self::DB_HOST.";dbname=".self::DB_NAME, self::USER_NAME,self::USER_PASSWORD);
    }catch (Exception $exception)
    { throw new Exception ("connection fail");
    }
  }
    return static ::$connection;
    }

 static public function execute($sql,$data=[])
{
  
    $stmt = DB::getConnection()->prepare($sql);  
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute($data);
    $result=[];

    while($item = $stmt->fetch()) 
    {
    $result[]=$item;
    }
return $result;
}
}
?>