<?php

// 선언 -> 생성 -> 호출
// 데이터베이스 선언
class Database{
    public $connect;

    // 복합객체 - 객체지향의 (은닉화)
    //public, private, protected
    private $Table;
    public function setTable($name){ // getter setter
        $this -> Table = $name;
        return $this;
    }

    public function getTable(){
        return $this -> Table;
    }

    // 생성자 메소드
    public function __construct($config){
        
        // 테이블 객체 연결
        $this -> Table = new Table($this);

        echo "클래스 생성";
        $this->connect = 
            new mysqli(
                $config['host'],
                $config['user'],
                $config['passwd'],
                $config['database']);
        // new 로 인스턴스를 생성했을때 this 사용가능
        if(!$this->connect->connect_errno){
            echo "DB 접속 성공이에요";
        }else{
            echo "접속이 안되요. ㅠㅠㅠ";
        }
    }

    public function queryExecute($query){
        if($result = mysqli_query($this->connect, $query)){
            echo "쿼리 성공";
        }else{
            print "쿼리 실패";
        }

        return $result;
    }

    // 테이블 확인
    public function isTable($tablename){
        $query = "SHOW TABLES";
        $result = $this->queryExecute($query);
        $count = mysqli_num_rows($result);

        for($i=0;$i<$count;$i++){
            $row = mysqli_fetch_object($result);
            if($row->Tables_in_php == $tablename){ // 테이블이름을 읽어온것과 tablename 이같으면
                return true;
            }
        }
        return false;
    }
}