 <?php
                $DBConnect = mysqli_connect("localhost", "root", "");
                if ($DBConnect === FALSE)
                {
                    echo "<p>Unable to connect to the database server.</p>"
                    . "<p>Error code " . mysqli_errno() . ": "
                    . mysqli_error() . "</p>";
                }
                else
                {
                    $DBName="Netnix";
                    mysqli_select_db($DBConnect, $DBName);
                    $SQLstring = "SELECT comment, userName, userImagePath FROM `comments` JOIN `users` WHERE comments.userId = users.userId ORDER BY commentId DESC";
                    if ($stmt = mysqli_prepare($DBConnect, $SQLstring))
                    {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $message, $userName, $userImage);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) != 0)
                        {
                            echo "<div class='commentBox'>";

                            while (mysqli_stmt_fetch($stmt))
                            {
                                //Change the classes to whatever the hell you want.
                                echo "<div class='message'><div class='messageImage'><img src='".$userImage."'height='100' width='100' alt='".$userImage."'></div>
                                <div class='messageUser'><b>".$userName."</b></div>
                                <div class='messageText'>".$message."</div></div>";
                            }
                            echo"</div>";
                        }
                    }
                    if(isset($_POST['submit']))
                    {
                        if(!empty($_POST['comment']))
                        {
                            $message = htmlentities($_POST['message']);
                            $id = $_SESSION['id'];
                            $SQLstring2 = "INSERT INTO comments VALUES(NULL, ?, ?)";
                            if ($stmt = mysqli_prepare($DBConnect, $SQLstring2))
                            {
                                mysqli_stmt_bind_param($stmt, 'ss', $id, $message);
                                mysqli_stmt_execute($stmt);
                                echo "Message added!";
                                //Change the following header to videoshow.php after testing!
                                header("location: commentTest.php");
                                mysqli_stmt_close($stmt);
                            }
                            else
                            {
                                echo "PLEASE STOP BREAKING CODE ";
                                echo $_SESSION['id'];
                                echo "<a href='logout.php'>logout</a>";
                            }
                        }
                        else
                        {
                            echo"Please fill in a message";
                        }
                        mysqli_close($DBConnect);
                    }
                }
            ?>