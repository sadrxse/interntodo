<?php

class CreatePagination
{
    private $page;
    private $pagination;
    
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
    }
    public function isSearchPage($i,$keyword = null){
        if($keyword){
            $html = '<li class="page-item"><a class="page-link" href="?page='.$i.'&keyword='.$keyword.'">'.$i.'</a></li>';
            return $html;
        }
        $html = '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        return $html;
    }
    public function isActive($i,$keyword = null){
        if($i==$this->page){
            $html = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">'.$i.'</a></li>';
            return $html;
        }
        $html = $this->isSearchPage($i,$keyword);
        return $html;
    }
    public function numbersPage($keyword = null){
        $html = "";
        for($i=1;$i<=$this->pagination;$i++){
            $html .= $this->isActive($i,$keyword);
        }
        return $html;
    }
    public function nextPage(){
        if($this->page!=$this->pagination){
            $page = $this->page + 1;
            $html = '<li class="page-item"><a class="page-link" href="?page='.$page.'">Next</a></li>';
            return $html;
        }
    }
    public function createPagination($keyword = null){
        $html = $this->previousPage();
        $html .= $this->numbersPage($keyword);
        $html .= $this->nextPage();
        return $html;
    }
}

?>