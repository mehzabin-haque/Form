<?php
$nameErr = $emailErr = $addrErr = $picErr = "";
$photo = array();
$firstname = $lastname = $email = $addr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo = $_FILES["photo"]["name"];
    // $firstname = $_POST["firstname"];


    if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
        $nameErr = "*Name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        $lastname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname) || !preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $nameErr = "*Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";
        }
    }


    if (empty($_POST["add"])) {
        $addrErr = "*Address is required";
    } else {
        $addr = test_input($_POST["add"]);
    }

    if(empty($photo)){
        $picErr = "Photo is required";
    }

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($addr) && !empty($photo)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        header("Location: test.php?first-name=$firstname&last-name=$lastname&email=$email&address=$addr&photo=$target_file");
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
<!-- <img src="tt.jpg" alt="tt" width="100%" style="opacity: 0.5;"> -->
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="container patterns pt1">
            <h3 style="text-align: center;"> </h3>
            <ul class="form-style-1">
                <li><label>Full Name <span class="required">*</span></label><input type="text" name="firstname"
                        class="field-divided" placeholder="First" /> <input type="text" name="lastname"
                        class="field-divided" placeholder="Last" /></li>
                <span class="error">
                    <?php echo $nameErr; ?>
                </span>
                <li>
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="email" class="field-long" />
                    <span class="error">
                        <?php echo $emailErr; ?>
                    </span>
                </li>
                <li>
                    <label> Address <span class="required">*</span></label>
                    <textarea name="add" id="field5" class="field-long field-textarea"></textarea>
                    <span class="error">
                        <?php echo $addrErr; ?>
                        <br>
                    </span>

                </li>

                <div class="upload-btn-wrapper">
                    <button class="btn"> <b> Photo </b><span class="required">*</span></button>
                    <input name="photo" accept="image/*" class="form-control" type="file" id="photo">
                    <span class="error">
                        <br>
                        <?php echo $picErr; ?>
                    </span>
                </div>

                <li>
                    <button type="reset" id="can"> Cancel </button>
                    <input type="submit" value="Submit" />
                </li>
            </ul>
        </div>
    </form>

    <div class="container1">
    <div class="coffee-header">
      <div class="coffee-header__buttons coffee-header__button-one"></div>
      <div class="coffee-header__buttons coffee-header__button-two"></div>
      <div class="coffee-header__display"></div>
      <div class="coffee-header__details"></div>
    </div>
    <div class="coffee-medium">
      <div class="coffe-medium__exit"></div>
      <div class="coffee-medium__arm"></div>
      <div class="coffee-medium__liquid"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-one"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-two"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-three"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-for"></div>
      <div class="coffee-medium__cup"></div>
    </div>
    <div class="coffee-footer"></div>
  </div>

</body>
</html>