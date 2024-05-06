<?php include 'connect.php';
$ipAddress=$_SERVER['REMOTE_ADDR'];

  $hasError = false;

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $fullname=$_POST['fullname'];
   
    $phonenumber=$_POST['phonenumber'];
  
    $email=$_POST['email']; 
     $subject=$_POST['subject'];
    
    $message=$_POST['message'];


    $errors = [];

    // Validate fullname
    if (empty($fullname)) {
        $errors[] = "Full name is required.";
        $hasError = true; // Set error flag
    }
     if (!preg_match("/^[0-9]*$/", $phonenumber)) {
        $errors[] = "Phone number contains only numeric values.";
        $hasError = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
        $hasError = true;
    }
    

    // Display errors if any
    if ($hasError) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } 
    else {
    
   

    $sql="insert into forms (fullname, phonenumber, email, subject, message,ipAddress)
    values('$fullname','$phonenumber','$email', '$subject','$message','$ipAddress ')";
    $result=mysqli_query($con,$sql);

    if($result==true){
 
        
        $to=$email;
        $subject="form submitted successfully";
        $message="your details submitted succesfully";
        $header="From:preetitesting43@gmail.com";
       
      
        $mail=mail($to,$subject,$message,$header);
        if($mail==true){
            echo"mail sent";
        }
        else{
            echo "invalid email";
        }
         }else{
        die(mysqli_error($con));
    }
}


}
        

   


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>projectform</title>
</head>
<body>
    <div>
        <h3>Fill the form</h3>
    </div>
    <div>
        <form method ='POST'>
            <div>
                <label>FullName</label>
                <input type='text' value="" name="fullname" required >
            </div>
            <div>
                <label>PhoneNumber</label>
                <input type='tel'  value="" name="phonenumber" required >
            </div>
            <div>
                <label>Email</label>
                <input type='email'  value=""name="email" required >
            </div>
            <div>
                <label>Subject</label>
                <input type='text' value="" name="subject" required >
            </div>
            <div>
                <label>message</label>
                <input type='text' value="" name="message" required >
            </div>
            <div>
                <button type="submit" name="submit">submit</button></div>

        </form>
    </div>
    
</body>
</html>