<?php
//indexページネーション作成
class IndexPagination
{
    protected $page;
    protected $pagination;
    
    public function __construct($page,$pagination){
        $this->page = $page;
        $this->pagination = $pagination;
    }
    public function previousPage(){
        $page = $this->page -1;
        $html = '<li class="page-item"><a class="page-link" href="?page='.$page.'">Previous</a></li>';
        if($this->page!=1){
            return $html;
        }
        return null;
    }
    public function numbersPage(){
        $html = "";
        for($i=1;$i<=$this->pagination;$i++){
            $html .= $this->isActive($i);
        }
        return $html;
    }
    public function isActive($i){
        if($i==$this->page){
            $html = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">'.$i.'</a></li>';
            return $html;
        }
        $html = '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        return $html;
    }
    public function nextPage(){
        $page = $this->page + 1;
        $html = '<li class="page-item"><a class="page-link" href="?page='.$page.'">Next</a></li>';
        if($this->page!=$this->pagination){
            return $html;
        }
        return null;
    }
    public function createPagination(){
        $html = $this->previousPage();
        $html .= $this->numbersPage();
        $html .= $this->nextPage();
        return $html;
    }
}

//searchページネーション
class SearchPagination extends IndexPagination
{

    public function previousPage($keyword){
        $page = $this->page -1;
        $html = '<li class="page-item"><a class="page-link" href="?page='.$page.'&keyword='.$keyword.'">Previous</a></li>';
        if($this->page!=1){
            return $html;
        }
        return null;
    }
    public function numbersPage($keyword){
        $html = "";
        for($i=1;$i<=$this->pagination;$i++){
            $html .= $this->isActive($i,$keyword);
        }
        return $html;
    }
    public function isActive($i,$keyword){
        if($i==$this->page){
            $html = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">'.$i.'</a></li>';
            return $html;
        }
        $html = '<li class="page-item"><a class="page-link" href="?page='.$i.'&keyword='.$keyword.'">'.$i.'</a></li>';
        return $html;
    }
    public function nextPage($keyword){
        $page = $this->page + 1;
        $html = '<li class="page-item"><a class="page-link" href="?page='.$page.'&keyword='.$keyword.'">Next</a></li>';
        if($this->page!=$this->pagination){
            return $html;
        }
        return null;
    }
    public function createPagination($keyword){
        $html = $this->previousPage($keyword);
        $html .= $this->numbersPage($keyword);
        $html .= $this->nextPage($keyword);
        return $html;
    }
}

?>