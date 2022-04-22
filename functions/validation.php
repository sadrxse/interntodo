<?php
//入力値,データのチェック
class Validator
{
    private $message;

    public function isInputValid($title,$content){
        if(!($this->issetTitle($title))){return false;}
        if(!($this->checkTitleLength($title))){return false;}
        if(!($this->issetContent($content))){return false;}
        return true;
    }
    public function issetTitle($title){
        if($title==null){
            $this->message = "The title is null";
            return false;
        }
        return true;
    }
    public function checkTitleLength($title){
        if(mb_strlen($title)>200){
            $this->message = "The title is too long";
            return false;
        }
        return true;
    }
    public function issetContent($content){
        if($content==null){
            $this->message = "The content is null";
            return false;
        }
        return true;
    }
    public function issetKeyword($keyword){
        if($keyword==null){
            $this->message = "The keyword is null";
            return false;
        }
        return true;
    }
    public function dataExists($stmt){
        $data = $stmt->fetchColumn();
        if($data==false){
            $this->message = "No such ToDo found";
            return false;
        }
        return true;
    }
    public function getMessage(){
        return $this->message;
    }
}
?>