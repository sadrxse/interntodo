<?php

//connection to DB
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

//slect,insert,update,delete
class Controller extends ConnectDB
{
    public function selectData($start_number){
        //1ページにつき5個のpost取得
        $sql = "SELECT * FROM posts ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$start_number, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function searchData($keyword,$start_number){
        //1ページにつき5個のpost取得
        $sql = "SELECT * FROM posts WHERE title LIKE ? ORDER BY updated_at DESC LIMIT ?,5";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
        $stmt->bindValue(2,$start_number, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function insertData($title,$content){
        $sql = 'INSERT INTO posts(title,content) VALUES (?,?)';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        $stmt->execute();
    }
    public function updateData($title,$content,$id){
        $sql = 'UPDATE posts SET title=?,content=? WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$title,PDO::PARAM_STR);
        $stmt->bindValue(2,$content,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_INT);
        $stmt->execute();
    }
    public function checkData($id){
        //削除するToDoが存在するかの確認
        $sql = "SELECT COUNT(*) FROM posts WHERE id=?";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function deleteData($id){
        $sql = 'DELETE FROM posts WHERE id=?';
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_INT);
        $stmt->execute();
    }
}

class setValue extends ConnectDB
{
    private $page;
    private $start_number;
    private $pagination;

    function __construct(){
        $this->page = 1;
        //現在のページを取得
        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }
        //現在のページで取得する最初のpost番号
        $this->start_number = ($this->page-1)*5; 
    }

    public function is_page(){
        return $this->page;
    }

    public function is_startnum(){
        return $this->start_number;
    }

    public function index_pagination(){
        //合計のpost数からページネーション数算出
        $stmt = $this->dbh()->prepare("SELECT COUNT(*) id FROM posts");
        $stmt->execute();
        $page_num = $stmt->fetchColumn();
        $this->pagination = ceil($page_num/5);
        return $this->pagination;
    }

    public function is_paging(){
        return $this->$pagination;
    }

    public function search_pagination($keyword){
        //合計のpost数からページネーション数算出
        $sql = "SELECT COUNT(*) id FROM posts WHERE title LIKE ?";
        $stmt = $this->dbh()->prepare($sql);
        $stmt->bindValue(1,"%{$keyword}%",PDO::PARAM_STR);
        $stmt->execute();
        $page_num = $stmt->fetchColumn();
        $this->pagination = ceil($page_num/5);
        return $this->pagination;
    }
}

?>