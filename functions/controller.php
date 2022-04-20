<?php
//DB接続
class ConnectDB
{
    const DBNAME = 'posts';
    const HOST = 'localhost';
    const CHAR = 'utf8';
    const USER = 'root';
    const PASS = 'root';

    public function dbh(){
        $dsn = 'mysql:dbname='.SELF::DBNAME.';host='.SELF::HOST.';charset='.SELF::CHAR;
        $user = SELF::USER;
        $password = SELF::PASS;
        $dbh = new PDO($dsn,$user,$password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
}

//DB操作
class Controller extends ConnectDB
{
    public function selectData($start_number){
        //1ページにつき5個のpost取得
        $sql = "SELECT * FROM posts ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$start_number, PDO::PARAM_INT);
        return $stmt;
    }
    public function searchData($keyword,$start_number){
        //1ページにつき5個のpost取得
        $sql = "SELECT * FROM posts WHERE title LIKE ? ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
        $stmt->bindValue(2,$start_number, PDO::PARAM_INT);
        return $stmt;
    }
    public function insertData($title,$content){
        $sql = 'INSERT INTO posts(title,content) VALUES (?,?)';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        return $stmt;
    }
    public function updateData($title,$content,$id){
        $sql = 'UPDATE posts SET title=?,content=? WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_INT);
        return $stmt;
    }
    public function checkData($id){
        //削除するToDoが存在するかの確認
        $sql = "SELECT COUNT(*) FROM posts WHERE id=?";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        return $stmt;
    }
    public function deleteData($id){
        $sql = 'DELETE FROM posts WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        return $stmt;
    }
}

//ページネーション数算出
class IsPagination extends ConnectDB
{
    private $pagination;

    public function countPost($keyword = null){
        if($keyword){
            $sql = "SELECT COUNT(*) id FROM posts WHERE title LIKE ?";
            $stmt = $this->dbh()->prepare($sql);
            $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
            return $stmt;
        }
        $sql = "SELECT COUNT(*) id FROM posts";
        $stmt = $this->dbh()->prepare($sql);
        return $stmt;
    }
    public function setPagination($keyword = null){
        $stmt = $this->countPost($keyword);
        $stmt->execute();
        $page_number = $stmt->fetchColumn();
        $this->pagination = ceil($page_number/5);
        return $this->pagination;
    }
    public function getPagination($keyword = null){
        $this->setPagination($keyword);
        return $this->$pagination;
    }
}

?>