 
<?php   
        include 'admin/config.php' ;
        $id=$_POST['id'];
        $sql="SELECT * FROM products WHERE product_id = '$id' ";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                 
              echo json_encode(array('product'=>$row));
            }
          }
?>


 