<?php
include_once "process.php";

$filename = "C:/Users/bijoy/Desktop/file_read_project/data/database.txt";

// student info from db
$students = getStudentData($filename);

$error = "";
// file submission
if($_SERVER['REQUEST_METHOD']== "POST"){
    if(isset($_FILES) && $_FILES['txt_file']['type']=='text/plain'){
        $tmp_name = $_FILES['txt_file']['tmp_name'];

        $filename =  time().mt_rand(1,100).".".pathinfo($_FILES['txt_file']['name'])['extension'];

        move_uploaded_file($tmp_name, "data/$filename");

        addStudentData($filename);
    }else{
        $error = "Please upload a text file";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Add Student Info</h1>
    </div>
    <div class="container">
        <div class="format">
        <p class="caption">Upload text file in this format: </p>
<pre>
firstname, lastname, roll, class, section
Mahedi, Hasan, 10, 9, B
Nazmul, Sakib, 23, 10, A
</pre>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="txt">Upload .txt file</label><br>
            <input id="txt" type="file" name="txt_file">
            <br>
            <p style="color:crimson;" > 
            <?php
            if(!empty($error)){
                echo $error;
            }
            ?>
            </p>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <div class="data">
        <p class="title">Students Info:</p>
        <?php
        if(count($students)>0):
        ?>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Roll</th>
                <th>Class</th>
                <th>Section</th>
            </tr>
            <?php
            foreach($students as $student):
            
            echo "<tr>
                <td>{$student[0]}</td>
                <td>{$student[1]}</td>
                <td>{$student[2]}</td>
                <td>{$student[3]}</td>
                <td>{$student[4]}</td>
            </tr>";
            endforeach;
            ?>
        </table>
        <?php
            endif;
        ?>
    </div>
</body>
</html>