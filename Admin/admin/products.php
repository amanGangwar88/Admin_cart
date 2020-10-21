<?php  
   
    include 'config.php' ;
    include 'header.php' ; 
    if(isset($_POST['submit'])){
	  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
	  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
	  $name = isset($_POST['name']) ? $_POST['name'] : '';
	  $price = isset($_POST['price']) ? $_POST['price'] : '';
	 
	  
	  $filename = $_FILES['image']['name'];
	  $filetempname = $_FILES['image']['tmp_name'];
	  $folder = 'Resources/images/'.$filename;
	  move_uploaded_file($filetempname, $folder);
	  
	  
	  $category = isset($_POST['category']) ? $_POST['category'] : '';
	  $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
      $description = isset($_POST['description']) ? $_POST['description'] : '';
	  $tag = implode(",", $_POST['tag']);
      $sql = "INSERT INTO products(`product_id`, `category_id`, `name`, `price`,`image`,`Category`, `tag`,`description`) VALUES('$product_id', '$category_id', '$name', '$price', '$filename', '$category', '$tag', '$description')";         
		    if ($conn->query($sql) === TRUE) {
					 
				} else {
					echo "Error:" . $conn->error;					 
				}	
		if(isset($_GET['action']) && isset($_GET['id']))
		{   
			$id = $_GET['id'];
			if($_GET['action']=='edit')
			{  
				$update="UPDATE products SET `product_id`='$product_id', `category_id`='$category_id', `name`='$name', `price`='$price'   WHERE `product_id`='$id' " ;
				$conn->query($update);
			}
		}
		else
		{
			$sql= "INSERT INTO products('name') VALUES('.$name.') ";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error:" . $conn->error;					 
			}
		}
	}
	if(isset($_GET['action']) && isset($_GET['id']))
	{   
		$id = $_GET['id'];
		if($_GET['action']=='delete')
		{
			$delete="DELETE FROM products WHERE `product_id`='$id'" ;
			$conn->query($delete);
		}
	}
	
 
 
	 
?>
 
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome John</h2>
			 
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Products</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div>
						
						<table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>Image</th>
								   <th>Product_id</th>
								   <th>Category_id</th>
								   <th>Name</th>
								   <th>Price</th>
                                    
								   <th>Category</th>
								   <th>Tags</th>
                                   <!--<th>Tags</th>-->
                                   <th>Description</th>
                                   <th>Action</th>
								</tr>
								
							</thead>
						 
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<a class="button" href="#">Apply to selected</a>
										</div>
										
										<div class="pagination">
											<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
											<a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						 
							<tbody>
								<?php
								    $table_data = "SELECT * FROM products" ;
									$result = $conn -> query($table_data);
									if($result->num_rows >0)
									{
										while($row = $result->fetch_assoc())
										{
											echo "<tr><td><input type='checkbox' /></td>";
											echo "<td><img src='Resources/images/".$row['image']."'></td><td>".$row['product_id']."</td><td>".$row['category_id']."</td><td>".$row['name']."</td><td>".$row['price']."</td><td>".$row['Category']."</td><td>".$row['tag']."</td><td>".$row['description']."</td>";
											echo "<td>";
											echo "<a href='products.php?action=edit&id=".$row['product_id']."&cat_id=".$row['category_id']."&name=".$row['name']."&price=".$row['price']."&image=".$row['image']."&category=".$row['Category']."&tag=".$row['tag']."&description=".$row['description']." title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>";
											echo '<a href="products.php?action=delete&id='.$row['product_id'].'" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>';
											echo "<a href='#' title='Edit Meta'><img src='resources/images/icons/hammer_screwdriver.png' alt='Edit Meta' /></a>";
											echo "</td></tr>";
										}
									}                                      
								?>	 
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">              
						<form action="" method="POST" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<label>Product_id</label>
								<input class="text-input small-input" type="text" id="small-input" name="product_id" <?php if(isset($_GET['id'])): ?> value='<?php echo $_GET['id'] ;?>' <?php endif; ?> required/>   <!-- Classes for input-notification: success, error, information, attention -->
										<br /> 
								</p>
								<p>
									<label>Category_id</label>
										<input class="text-input small-input" type="text" id="small-input" name="category_id" <?php if(isset($_GET['cat_id'])): ?> value='<?php echo $_GET['cat_id'] ;?>' <?php endif; ?> required/>   <!-- Classes for input-notification: success, error, information, attention -->
										<br /> 
                                </p>
                                
								<p>
									<label>Name</label>
										<input class="text-input small-input" type="text" id="small-input" name="name" <?php if(isset($_GET['name'])): ?> value='<?php echo $_GET['name'] ;?>' <?php endif; ?> required />  <!-- Classes for input-notification: success, error, information, attention -->
										<br /> 
								</p>
								
								<p>
									<label>Price</label>
									<input class="text-input medium-input datepicker" type="text" id="medium-input" name="price" <?php if(isset($_GET['price'])): ?> value='<?php echo $_GET['price'] ;?>' <?php endif; ?>  required/> 
								</p>
                                
								<p>
									<label>Insert Product Image</label>
										<input class="text-input small-input" type="file" id="image" name="image" <?php if(isset($_GET['image'])): ?> value='<?php echo $_GET['image'] ;?>' <?php endif; ?> required /> 
								</p>
                                
                                <p>
									<label>Category</label>
									<select name="category" class="small-input">
										<option value="Men">Men</option>
										<option value="Women">Women</option>
										<option value="Kids">Kids</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Sports">Sports</option>
									</select>
                                </p>

								<p>
									<label>Tags</label>
									<input type="checkbox" value="Fashion" name="tag[]" /> Fashion<input type="checkbox" value="Ecommerce" name="tag[]" /> Ecommerce<input type="checkbox" value="Shop" name="tag[]" />Shop <input type="checkbox"value="HandBag"  name="tag[]" /> Hand Bag<input type="checkbox" value="Laptop" name="tag[]" /> Laptop<input type="checkbox" value="Headphone"  name="tag[]" />Headphone
								</p>
								 
								<p>
									<label>Discription</label>
									<textarea class="text-input textarea wysiwyg" id="textarea" name="description" <?php if(isset($_GET['description'])): ?> value='<?php echo $_GET['description'] ;?>' <?php endif; ?> cols="79" rows="15"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" name="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
 
			<div class="clear"></div>
			
			 
		 	<!-- Start Notifications -->
			
		<!--	<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
            -->
			<!-- End Notifications -->  
			
			<?php include 'footer.php' ?>