<?php include('partials/menu.php')?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		
		<br><br>
		
		<?php 
		//Checking whether the Session is Set or Not
		if(isset($_SESSION['add'])) {
		    echo $_SESSION['add']; //Displaying Session Message
		    unset($_SESSION['add']); //Removing Session Message
		}
		?>
		
		<br><br>
		
		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td>
						<input type="text" name="full_name" placeholder="Enter Your Name">
					</td>
				</tr>
				<tr>
					<td>Username: </td>
					<td>
						<input type="text" name="username" placeholder="Your Username">
					</td>
				</tr>
				<tr>
					<td>Password: </td>
					<td>
						<input type="password" name="password" placeholder="Your Password">
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
			
		</form>
		
	</div>
</div>

<?php include('partials/footer.php')?>

<?php 
//Process the Value from Form and Save it in Database

//Check whether the button is clicked or not
    
if(isset($_POST['submit'])) {
    //Button Clicked
    //echo "Button Clicked";
    
    //1. Get the Data from Form
    $full_name = $_POST['full_name'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']); //Password Encryption with MD5
    $password = mysqli_real_escape_string($conn, $raw_password);
    
    //2. SQL Query to Save the Data into Database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";
    
    //3. Executing Query and Saving Data into Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
    //4. Check whether the (Query is Excuted) data is inserted or not and display appropriate message
    if ($res == TRUE) {
        //Data Inserted
        //echo "Data Inserted";
        
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        //Redirect Page to Manage Admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        //Failed to Insert Data
        //echo "Failed to Insert Data";
        
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
        //Redirect Page to Manage Admin
        header('location:'.SITEURL.'admin/add-admin.php');
    }
}
?>