<?php
include_once __DIR__.'/DB.php';
include_once __DIR__.'/helper.php';
class User{
    static public function all()
    {
       $sql ="SELECT * FROM users";
       $users=DB::execute($sql);

       return $users;
    }
    static public function create($dataCreate){
        $sql="INSERT INTO users (name, email, password) values (:name,:email,:password)";
        DB::execute($sql,$dataCreate);
    }

    static public function find($id)
    {
        $sql='SELECT * FROM users where id=:id';
        $dataFind=['id'=>$id];
        $user= DB::execute($sql,$dataFind);
       
        return count($user)>0 ? $user[0]: [];
    }
    static public function update($dataUpdate)
    {
        $sql="UPDATE users set name=:name, email=:email, password=:password WHERE id=:id";
        DB::execute($sql,$dataUpdate);
    }

    static public function destroy($id)
    {
        $sql="DELETE FROM users WHERE id=:id;";
       $dataDelete=['id'=>$id];
       DB::execute($sql,$dataDelete);
    }


    public static function search($keyword) {
        $sql = "SELECT * FROM users WHERE name LIKE :keyword OR email LIKE :keyword";
        $data = ['keyword' => "%$keyword%"];
        return DB::execute($sql, $data);
      }
      public static function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];
        return DB::execute($sql, $data);
    }

    
    public static function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $data = ['email' => $email];
        $user = DB::execute($sql, $data);

        if (!empty($user) && password_verify($password, $user[0]['password'])) {
            return $user[0];
        }
        return false;
    }
}
?>