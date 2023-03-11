<?php

// database file read and get the data
function getStudentData($filename)
{
    $students = array();

    if (is_readable($filename)) {

        $fp = fopen($filename, 'r');

        while ($line = fgets($fp)) {
            $student = explode(',', $line);
            
            if(!(count($student)<5)){
                array_push($students, $student);
            }
        }
        fclose($fp);

        return $students;
    }
}


function addStudentData($filename){
    $filename = "C:/Users/bijoy/Desktop/file_read_project/data/".$filename;
    $db = "C:/Users/bijoy/Desktop/file_read_project/data/database.txt";
    $data = file_get_contents($filename);

    file_put_contents($db, $data, FILE_APPEND);

    header("location:index.php");
}
