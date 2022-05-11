<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
		$usernamee = $_POST["usernamee"];
		$passwordd = $_POST["passwordd"];
		$conn = mysqli_connect("localhost","root","","testa");
		//$sql = 
        if(!$conn){
            die("connection failed:" . mysqli_connect_error() );
        }
        $stmt = $conn->prepare("SELECT * FROM tbuser WHERE txtusername=? AND txtpassword=? LIMIT 1"); 
        $stmt->bind_param("ss", $usernamee,$passwordd);
       
        $stmt->execute();
        
       $result = $stmt->get_result(); // get the mysqli result
       $user = $result->fetch_assoc(); 
        //echo $usernamee;
		if( $user > 0 ) {
           $mess = "Đức đã đăng nhập thành công";
			echo '<script type="text/javascript">alert("'.$mess.'");</script>';
		}else{
			$mess = "Đức đã nhập sai rồi";
			echo '<script type="text/javascript">alert("'.$mess.'");</script>';
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login test</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
        extend: {
            fontFamily: {
            sans: ['Inter', 'sans-serif'],
            },
        }
        }
    }
</script>
</head>
<body> 
    <div class="flex justify-center mt-5">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="test.php" method="POST">
            <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="usernamee" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Password
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  name="passwordd" type="text" placeholder="******************">
            <p class="text-red-500 text-xs italic">Please choose a password.</p>
            </div>
            <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded focus:outline-none focus:shadow-outline" type="submit">
                Login
            </button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline" type="button">
                Exit
            </button>
            </div>

        </form>
    </div>
</body>
</html>