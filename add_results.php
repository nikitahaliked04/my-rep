<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="./css/form.css">
    <title>Dashboard</title>
</head>
<body style="background-color:rosybrown;">
        
    <div class="title">
        <a href="dashboard.php"></a>
        <span class="heading"> Admin Dashboard</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <div class="nav">
        <ul>
            <li class="dropdown" onclick="toggleDisplay('1')">
                <a href="" class="dropbtn">Semester &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Semester</a>
                    <a href="manage_classes.php">Show Semester Details</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Show Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
        <form action="" method="post">
            <fieldset>
            <legend>Enter Marks</legend>

                <?php
                    include("init.php");
                    include("session.php");

                    $select_class_query="SELECT `Sem` from `Semester`";
                    $class_result=mysqli_query($conn,$select_class_query);
                    //select class
                    echo '<select name="Sem">';
                    echo '<option selected disabled>Select Semester</option>';
                    
                        while($row = mysqli_fetch_array($class_result)) {
                            $display=$row['Sem'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                    echo'</select>';                      
                ?>

                <input type="text" name="RegNo" placeholder="Reg No">
                <input type="text" name="Semester" id="" placeholder="sem">
                <input type="text" name="Code" id="" placeholder="code">
                <input type="text" name="Subject" id="" placeholder="Enter sub name">
                <input type="text" name="MaxMarks" id="" placeholder="enter max marks">
                <input type="text" name="credits" id="" placeholder="enter total credits">
				<input type="text" name="IAMarks" id="" placeholder="enter total IA Marks">
				<input type="text" name="EAMarks" id="" placeholder="enter total EA marks">
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </div>

</body>
</html>

<?php
    if(isset($_POST['RegNo'],$_POST['Semester'],$_POST['Code'],$_POST['Subject'],$_POST['MaxMarks'],$_POST['credits'],$_POST['IAMarks'],$_POST['EAMarks']))
    {
        $rno=$_POST['RegNo'];
        if(!isset($_POST['Sem']))
            $class_name=null;
        else
            $class_name=$_POST['Sem'];
		$s=$_POST['Semester'];
		$c=$_POST['Code'];
        $sub=$_POST['Subject'];
        $max=$_POST['MaxMarks'];
        $cr=$_POST['credits'];
		$ia=$_POST['IAMarks'];
		$ea=$_POST['EAMarks'];
        $total=$ia+$ea;
      


        $name=mysqli_query($conn,"SELECT `Name` FROM `students` WHERE `RegNo`='$rno' and `Sem`='$class_name'");
        while($row = mysqli_fetch_array($name)) {
            $display=$row['Name'];
         }

        $sql="INSERT INTO `result` (`Name`, `RegNo`, `Semester`, `Code`, `Subject`, `Maximum Marks`, `Credits`, `IA Marks`, `EA Marks`,`Total Marks`) VALUES ('$display', '$rno', '$class_name','$c', '$sub', '$max', '$cr', '$ia','$ea','$total')";
        $sql=mysqli_query($conn,$sql);

        if (!$sql) {
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }
    }
?>