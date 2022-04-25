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
    //5件ずつ取得
    public function selectData($start_number){
        $sql = "SELECT * FROM posts ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$start_number, PDO::PARAM_INT);
        return $stmt;
    }
    //検索結果を5件ずつ取得
    public function searchData($keyword,$start_number){
        $sql = "SELECT * FROM posts WHERE title LIKE ? ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
        $stmt->bindValue(2,$start_number, PDO::PARAM_INT);
        return $stmt;
    }
    //ToDoの作成
    public function insertData($title,$content){
        $sql = 'INSERT INTO posts(title,content) VALUES (?,?)';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        return $stmt;
    }
    //ToDoの更新
    public function updateData($id,$title,$content){
        $sql = 'UPDATE posts SET title=?,content=? WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_INT);
        return $stmt;
    }
    //ToDoが存在するかの確認
    public function checkData($id,$title,$content){
        $sql = "SELECT COUNT(*) FROM posts WHERE id=? AND title=? AND content=?";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        $stmt->bindValue(2,$title,PDO::PARAM_STR);
        $stmt->bindValue(3,$content,PDO::PARAM_STR);
        return $stmt;
    }
    //ToDoの削除
    public function deleteData($id){
        $sql = 'DELETE FROM posts WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        return $stmt;
    }
}

//ページネーション数算出
class CountPages extends ConnectDB
{
    private $pagination;
    
    //pagination数セット
    public function setPagination($keyword = null){
        $stmt = $this->countPost($keyword);
        $stmt->execute();
        $page_number = $stmt->fetchColumn();
        $this->pagination = ceil($page_number/5);
        return null;
    }
    //全件カウント
    public function countPost($keyword = null){
        $sql = "SELECT COUNT(*) id FROM posts";
        if($keyword){
            $sql .= " WHERE title LIKE ?";
            $stmt = $this->dbh()->prepare($sql);
            $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
            return $stmt;
        }
        $stmt = $this->dbh()->prepare($sql);
        return $stmt;
    }
    //pagination取得
    public function getPagination($keyword = null){
        $this->setPagination($keyword);
        return $this->pagination;
    }
}

?>