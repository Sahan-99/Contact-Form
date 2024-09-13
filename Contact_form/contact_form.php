<html>
    <head>
        <title>Contact Form</title>
        <link href="contact_form.css" rel="stylesheet">
        <link href="bootstrap.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css" rel="stylesheet">

        <style>
            .required-field::after {
                content: " *";
                color: red;
            }
        </style>

    </head>
    <body>

        <!---form start--->

        <div class="formms">
            <section class="form-container">
                <header>Contact Form</header>

                <form action="contact_form.php" class="form" method="post" onsubmit="return validateForm()">

                    <div class="input-box">
                        <label>Name <span class="required-field"></span></label>
                        <input type="text" placeholder="Enter Name" name="name">
                    </div>

                    <div class="input-box">
                        <label>Phone Number<span class="required-field"></span></label>
                        <input type="text" placeholder="Enter Mobile Number" name="phoneNumber">
                    </div>

                    <div class="input-box">
                        <label>Email<span class="required-field"></span></label>
                        <input type="email" placeholder="Enter email address" name="email">
                    </div>

                    <button type="submit" name="submit" data-mobilelabel="ok"><span>Submit</span></button>
                </form>
            </section>
        </div>

        <script>
        function validateForm() {
            var name = document.forms[0]["name"].value;
            var phoneNumber = document.forms[0]["phoneNumber"].value;
            var email = document.forms[0]["email"].value;

            if (name == "" || phoneNumber == "" || email == "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "All fields must be filled out"
                });
                return false;
            }

            var numRegex = /^\d{10}$/;

            if (!numRegex.test(phoneNumber)) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Invalid Mobile number!"
                });
                return false;
            }

            return true;
        }
    </script>
    <!---form End--->

    <!--php Start-->

    <?php

    if (isset($_POST['submit'])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "contact";

        // Create connection
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
    
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);

        }

        $name = $_POST["name"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];

        $sql = "INSERT INTO contact_form(name,phoneNumber,email)
        VALUES ('" . $name . "','" . $phoneNumber . "','" . $email . "')";

        if ($conn->query($sql) === TRUE) {

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Good job!",
                    text: "Form submit successfully!",
                    icon: "success"
                  });
            });
          </script>';
        } else {
            echo

                "<script type= 'text/javascript'>
                    alert('Error: " . $sql . "<br>" . $conn->error . "');
                </script>";

        }

        $conn->close();

    }?>

    <!--php End-->

    </body>
</html>