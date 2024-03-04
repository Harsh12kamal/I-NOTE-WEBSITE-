<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Note</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="INOTE.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
</head>
<body>
    <?php
     $servername ="localhost";
     $username ="root";
     $password ="";
     $database="curd1";
     $conn = mysqli_connect($servername,$username,$password,$database);
     if(!$conn){
         die("sorry we fail to connect :". mysqli_connect_error());
     }
     if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `table1` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (isset( $_POST['snoEdit'])){
        // Update the record
          $sno = $_POST["snoEdit"];
          $title = $_POST["titleEdit"];
          $description = $_POST["descriptionEdit"];
      
        // Sql query to be executed
        $sql = "UPDATE `table1` SET `sno`='snoEdit',`title`='titleEdit',`description`='descriptionEdit' WHERE 1";
        $result = mysqli_query($conn, $sql);
        if($result){
        echo '<script>alert("UPDATED")</script>';
      }
      else{
          echo "We could not update the record successfully";
      }
      }
      else{
        $title=$_POST["heading"];
        $desc=$_POST["content"];
    
        $sql="INSERT INTO `table1` (`title`, `description`) VALUES ('$title', '$desc')";
        $result=mysqli_query($conn,$sql);
    
        if($result){ 
          
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        } 
      }
      }

    $sql1="SELECT *FROM `table1`";
    $output=mysqli_query($conn,$sql1);
    


    ?>
        <style>
        #myForm {
            display: none;
        }
    </style>
</head>
<body>
  <div class="top">I NOTE </div>
  <div class="container">
    
   <div class="box">
        <form action="/php/final%20project/INOTE.php" method="post">
        <div class="frm1" >
            Title
            <br>
            <lable for="titleof"></lable>
            <input type="text" name="heading" placeholder="Enter the title..." id="heading">
        </div>
        <div class="frm1">
        Description
            <br>
            <lable for="descof"></lable>
            <textarea id="content" name="content" placeholder="Enter your description here..."></textarea>
        </div>
        <button class="but1">Finish</button>


        </form>
      </div>
    
      <div class="box2">
        <table class="table" id="myTableS">
        <thread>
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">TITLE</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col" >ACTION </th>
            </tr>
        </thread>
        <tbody>
            <?php
            $number=0;
            while($row=mysqli_fetch_assoc($output))

            { echo "  
                <tr>
                    <th>".$number."</th>
                    <th>".$row['title']."</th>
                    <th>".$row['description']."</th>
                    <td><button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
                </tr>" ;
            $number=$number+1;
                
            }
        
            ?>
        </tbody>
        </table>
    </div>
  </div>
    
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);
          window.location = `/php/final%20project/INOTE.php?delete=${sno}`;
      })
    })
  </script>

</body>
</html>