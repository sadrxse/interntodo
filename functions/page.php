<?php
//ページネーション数算出
class IsPage
{
    private $page;
    private $start_number;

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
    public function is_startnumber(){
        return $this->start_number;
    }
}
?>