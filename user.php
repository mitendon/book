<?php
//declear the variable;
    $insert=false;
    $update=false;
    $delete=false;
    //connect to the data base;
    $con=mysqli_connect("localhost","root","","miten112");
// delete logic start;
    if(isset($_GET['delete']))
    {
       
        $delete=true;
        $Id = $_GET['delete'];

        $sql="DELETE FROM `book` WHERE `Id`= $Id";
        $result=mysqli_query($con,$sql);
      
    }
// delete logic End;
//update logic and else create logic sart;
    if($_SERVER['REQUEST_METHOD']=='POST') 
    {
      if(isset($_POST['IdEdit'])){
        
        $son=$_POST['IdEdit'];
        $title=$_POST['titleEdit'];
        $description=$_POST['descriptionEdit'];

      
          $sql="UPDATE `book` SET `title` = '$title' , `description` = '$description' WHERE `book`.`Id` = '$son'";
          $result=mysqli_query($con,$sql);
          if($result)
          { 

            $update=true;
            // <div class="alert alert-success" role="alert">
            //  update succsesfully ... 
            
            // <a href="user.php"><button class="temp" type="submit" name="save">conformation</button></a>
            // </div>
      
          } 


      }else
      {
        $title=$_POST['title'];
        $description=$_POST['description'];

      
          $sql="INSERT INTO `book` (`title`,`description`)VALUES ('$title','$description')";
          $result=mysqli_query($con,$sql);
          
        
          if($result) 
          {
            // echo "The recod insert successfuly";
            $insert= true;
          
          }   
        
        }   

    }

  
?>
<!-- strt the body -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
   
  </head>
  <body class="bg-secondary">

    <!-- edit modal check the button -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  edit modallabel 
</button>  -->

<!-- edit Modal start -->
<div class="modal fade" id="editModal" tabuser="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/php file/user.php" method="POST">
        <div class="modal-body">
         <!-- edit form start-->
          <input type="hidden" name="IdEdit" id="IdEdit">
            <div class="mb-3">
                <label for="title" class="form-label"><h5>Note Tital</h5></label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><h5>Note Discription</h5></label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="5"></textarea>
            </div>
            <br>
    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
      <!-- edit form end -->
    </div>
  </div>
</div>
<!-- edit modal end -->

<!-- start the navbar  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-black">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="image/logo.png" width="0"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-4" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- end the navbar -->
<!-- create data massage start-->
<?php
  if($insert)
  {
  ?>
    <div class="alert alert-success" role="alert">
      your recoud as been insert a successfuly.. 
      
      <a href="user.php"><button class="temp" type="submit" name="save">conformation</button></a>

      </div>
<?php } ?> 
<!-- create data massage End -->
<!-- update data massage start -->
<?php
  if($update)
  { 
  ?>
      <div class="alert alert-success" role="alert">
        update succsesfully ... 
            
      <a href="user.php"><button class="temp" type="submit" name="save">conformation</button></a>
      </div>
<?php } ?>
<!-- update data massage end -->

<!-- delete data massage start -->
<?php
if($delete)
  { 
  ?>
      <div class="alert alert-success" role="alert">
        your data is deleted succsesfully ... 
            
      <a href="user.php"><button class="temp" type="submit" name="save">conformation</button></a>
      </div>
<?php } ?>
<!-- delete data massage end -->
<!-- add note form start  -->
<div class="container my-5 bg-secondary">
    <h2><font color="broun">Add Note</font></h2>
    <br>
    <form action="/php file/user.php" method="post" >
        <div class="mb-3">
            <label for="title" class="form-label"><h5><font color="white">Note Tital</font></h5></label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label"><h5><font color="white">Note Discription</font></h5></label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>


        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="Checked" checked>
            <label class="form-check-label" for="flexCheckChecked"><font color="white">Checked checkbox</font></label>
        </div>
        <br>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="save">add book</button>
        </div>
        <br>
    <form>
</div>
<!-- add note form end -->
<!-- start the data table -->
<div class="container my-4 bg-light" >
    <br>
    <table class="table" id="mytable">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Real Time</th>
          <th scope="col">Actions</th>

        </tr>
      </thead>
      <tbody>
      <?php
        $no=1;
        $sql="SELECT * FROM `book`";
        $result=mysqli_query($con,$sql);
        While($row=mysqli_fetch_assoc($result))
        {
      
      ?>
          <tr class>
            <th scope="row"><?php echo $no++?></th>
            <td scope="row"><?php echo $row['title']; ?></td>
            <td scope="row"><?php echo $row['description']; ?></td>
            <td scope="row"><?php echo $row['time']; ?></td>
            <?php
              echo "<td><button class='edit btn btn-sm btn-primary' id=".$row['Id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['Id']." >Delete</button></td>"
            ?>
          </tr>

  <?php } ?>

      </tbody>
    </table>
</div>
<hr color="black" size="10">
<!-- end of the table -->
<!-- start table java script logic and liblery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
          $('#mytable').DataTable();

        });
    </script>
<!-- end table java script logic and liblery -->

<!-- strt edit java script logic -->
    <script type="text/javascript">
        edits=document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
          element.addEventListener("click",(e)=>{
            console.log("edit",e.target.parentNode.parentNode);
            tr=e.target.parentNode.parentNode;
            
            title=tr.getElementsByTagName("td")[0].innerText;
            description=tr.getElementsByTagName("td")[1].innerText;
            
            console.log(title,description);

             titleEdit.value=title;
             descriptionEdit.value=description;

             IdEdit.value=e.target.id;
             console.log(e.target.id);

             $('#editModal').modal('toggle');

          })
        
        }) 
    </script>
<!-- start delete java script logic -->
    <script>
        
        deletes=document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
          element.addEventListener("click",(e)=>{
            console.log("edit",e.target.parentNode.parentNode);
            Id=e.target.id.substr(1,);
        
            if(confirm("Are you sure delete this data..."))
            {
                console.log("yes");
                window.location=`/php file/user.php?delete=${Id}`;

            }else
            {

                console.log("no");
            }


          })

        })
  </script>
<!-- end delete java script logic -->
  </body>
</html>