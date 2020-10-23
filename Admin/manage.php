<?php
  $product_id = $_POST['product_id'];
  $sql="SELECT * FROM products WHERE product_id = '$product_id' ";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                 
              echo json_encode(array('products'=>$row));
            }
        }
?>
