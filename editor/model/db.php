<?php
class db
{
    function openCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "newsdb";
        $con = new mysqli($dbhost, $dbuser, $dbpass, $db);

        return $con;
    }
    function checkEditor($con, $table, $email, $password)
    {
        $result = $con->query("SELECT * FROM " . $table . " WHERE email='" . $email . "' AND password='" . $password . "' AND status = 'approved'");
        return $result;
    }

    function checkEditorinfo($con, $table, $email, $password)
    {
        $result = $con->query("SELECT * FROM " . $table . " WHERE email='" . $email . "' AND password='" . $password . "'");
        return $result;
    }

    function checkEditorExist($con, $table, $email)
    {
        $result = $con->query("SELECT * FROM " . $table . " WHERE email='" . $email . "'");
        return $result;
    }

    function addEditor($con, $table, $name, $email, $password, $gender, $dob,$phone,$address,$profile)
    {
        $sql = "INSERT INTO " . $table . " (name, email, password, gender, dob, phone, address, image, status) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $gender . "','" . $dob . "','" . $phone . "','" . $address . "','" . $profile . "','pending')";
        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function updateEditorData($con,$table,$session_mail,$name, $email, $password, $gender, $dob,$phone,$address,$profile)
    {
        $sql ="UPDATE $table set name = '".$name."', email='".$email."', password='".$password."', gender='".$gender."', dob='".$dob."', phone='".$phone."', address='".$address."', image='".$profile."' where email = '".$session_mail."'";
        echo $sql;
        $result = $con->query($sql);
    }

    function updateNewsData($con,$table,$id,$date,$eid,$status,$remark)
    {
        $sql ="UPDATE $table set date = '".$$date."', eid='".$eid."', status='".$status."', remark='".$remark."' where id = '".$id."'";
        echo $sql;
        $result = $con->query($sql);
    }

    function getEditorData($con,$table,$email)
    {
        $result = $con->query("SELECT * FROM  $table where email = '".$email."'");
        return $result;
    }

    function deleteEditor($con,$table,$email)
    {
        $sql ="DELETE  from ".$table." where email = '".$email."'";
        $result = $con->query($sql);
        
    }
    
    function getPendingNewsRequest($con,$table)
    {
        $result = $con->query("SELECT * FROM  $table where status = 'pending'"); 
        return $result;
    }
    function update_news_status($con,$table,$id,$status)
    {
        $sql ="update ".$table." set status = '".$status."' where id = '".$id."'";  //delete
        $result = $con->query($sql);
    }

    function closeCon($con)
    {
        $con->close();
    }
}