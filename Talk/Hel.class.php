<?php
//连接数据库，查询数据库中的未读消息，返回未读的消息，并把该消息改为已读
final class Hel{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $psd = 'root';
    protected $dbName = 'test';
    protected $tableName = 'comments';
    protected $conn;//mysqli连接
    protected static $hel;//mysqli连接
    protected $idArr = array();//记录上次的未读消息

    // 单例连接数据库
    private function __construct(){
        $this->conn = new Mysqli($this->host,$this->user,$this->psd,$this->dbName);
        if ($this->conn->connect_error) {
            die($this->conn->connect_error.'<br/>');
        }
    }

    // 获取单例连接Hel类
    static public function getHel(){
        if (self::$hel instanceof Hel) {
            return self::$hel;
        }else{
            self::$hel = new Hel();
            return self::$hel;
        }
    }

    // 查询未读消息,通过idArr记录id
    public function sel($fl){
        $arr = array();
        $sql = 'select id,name,rep,com from '.$this->tableName.' where '.$fl.' = 0 limit 1';
        if ($res = $this->conn->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                $this->idArr[] = $row['id'];
                $arr[] = $row;
            }
        }
        return $arr;
    }
    // 把上次未读消息改为已读
    public function change($fl){
        $count = 0;
        $sql = 'update '.$this->tableName.' set '.$fl.'=1 where id =? ';
        $stmt = $this->conn->prepare($sql);
        foreach ($this->idArr as $k => $v) {
            $stmt->bind_param('i',$v);
            if($stmt->execute()){
                $count++;
            }
        }
        $stmt->close();
        return $count;
    }
    // 把客服的回复入库
    public function insert($name,$rep='',$com){
        $sql = 'insert into '.$this->tableName.' (name,rep,com) values ('.'"'.$name.'"'.',"'.$rep.'"'.',"'.$com.'"'.')';
        $this->conn->query($sql);
    }

    // 关闭连接
    public function __destruct(){
        $this->conn->close();
    }
}
/*
update comments set flag=0;
insert into comments (name,com,flag) values('lisi','hahaha',0);
 */
