
        <div id="id01" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="POST">
                <div class="imgcontainer">
                <?php
                    if(isset($_GET['invalidLog'])){
                        echo "<p class='invalidText'>Invalid login, please try again</p>";
                    }else if(isset($_GET['notLoggedIn'])){
                        echo "<p class='invalidText'>You are not logged in!</p>";
                    }
                ?> 
                <span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container">
                    <label for="userName"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="userName" required>
                    <label for="passw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="passw" required>
                    <button type="submit" class="submit" name="logIn">Login</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="closeLoginModal()" class="cancelbtn">Cancel</button>
                    <span class="passw">Forgot <a onclick="openChangPassw();" href="#">password?</a></span>
                </div>
                <input type="hidden" name="pageName" value="index.php">
            </form>
        </div> 
        
        <div id="id02" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="post">
                <div class="imgcontainer">
                <span onclick="closeSignUpModal()" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container">
                <label for="firstName" required>Full Name: </label><input type="text" name="firstName" placeholder="First Name"><input type="text" name="lastName" placeholder="Last Name"><br>
                <label for="email" required>Email: </label><p><input type="email" name="email"></p>
                <label for="userName" required>Username: </label><p><input type="text" name="userName" placeholder="Username"></p>
                <label for="password" required>Password: </label><p><input type="password" name="passw" placeholder="Password"></p>
                <label for="SQ1" required>Security Question 1: </label>
                <select name="SQ1">
                    <option value="1" selected>What was your favorite subject in high school?</option>
                    <option value="2">What is the name of your first pet?</option>
                    <option value="3">What is the name of the town where you were born?</option>
                    <option value="4">What was the first company that you worked for?</option>
                </select>
                <input type="text" name="SQVAL1" required placeholder="Answer"><br>
                <label for="SQ2">Security Question 2: </label>
                <select name="SQ2" required>
                    <option value="1">What was your favorite subject in high school?</option>
                    <option value="2" selected>What is the name of your first pet?</option>
                    <option value="3">What is the name of the town where you were born?</option>
                    <option value="4">What was the first company that you worked for?</option>
                </select>
                <input type="text" name="SQVAL2" required placeholder="Answer"><br>
                <button type="submit" class="submit" name="signUp">Sign up</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="closeSignUpModal()" class="cancelbtn">Cancel</button>
                </div>
                <input type="hidden" name="pageName" value="index.php">
            </form>
        </div>


        <div id="id03" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="POST">
                
                <?php
                    $query = getInbox($_SESSION['USER']);
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                            $action = $row['act'];
                            
                            
                            
                            if($action == "markA"){
                                $reply = getReplyByID($row['act_val']);
                                $q_ID = $reply['question_id'];
                                
                                $question = getQuestionByID($q_ID);
                                $qTitle = $question['subject'];
                                $qAuthor = getUserByID($question['asked_by']);
                                echo "<div class='inboxContainer'>
                                        <h3 class='markedA'>Your reply got marked as a answer!!!</h3>
                                        <h4 class='qTitle'><a href='question.php?ID=";echo"$q_ID"; echo "'>$qTitle</a></h4>
                                        <h5 class='qAuthor'>Asked by: $qAuthor</h5>
                                    </div>";
                            }else if($action == "newRep"){
                                $rAuthor = getUserByID($row['act_val']);
                                echo "<div class='inboxContainer'>
                                        <h3 class='markedA'>Someone replied to your question!!!</h3>
                                        <h4 class='qTitle'><a href='question.php?ID=";echo"$q_ID"; echo "'>$qTitle</a></h4>
                                        <h5 class='qAuthor'>Replied By: $rAuthor</h5>
                                    </div>";
                            }   

                    }
                }else{
                    echo "<h3 class='markedA'>No new messages</h3>";
                }
                ?>

                
                <button type="button" onclick="closeInboxModal()" class="cancelbtn">Close</button>
                
            </form>
        </div> 

        <div id="id04" class="modal">
            <form class="modal-content animate" action="userDATA.php" method="post">
                <div class="imgcontainer">
                    <?php
                        if(isset($_GET['passwNotMatch'])){
                            echo "<p class='invalidText'>Passwords do not match</p>";
                        }else if(isset($_GET['wrongSecQ'])){
                            echo "<p class='invalidText'>Wrong security question answer</p>";
                        }else if(isset($_GET['passwChanged'])){
                            echo "<p class='markedA'>Password changed successfully, you can now login!</p>";
                        }
                    ?>
                <span onclick="closeChangPassw()" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container">
                    <label for="userName" required>Username: </label><p><input type="text" name="userName" placeholder="Username"></p>
                    <label for="password" required>New Password: </label><p><input type="password" name="passw" placeholder="New password"></p>
                    <label for="password" required>Confirm Password: </label><p><input type="password" name="confPassw" placeholder="Confirm password"></p>
                    <p><i>When creating you'r account, we asked you 2 security questions and the answers,<br>Please confirm with us the questions and answers</p></i>
                    <label for="SQ1" required>Security Question 1: </label>
                    <select name="SQ1">
                        <option value="1" selected>What was your favorite subject in high school?</option>
                        <option value="2">What is the name of your first pet?</option>
                        <option value="3">What is the name of the town where you were born?</option>
                        <option value="4">What was the first company that you worked for?</option>
                    </select>
                    <input type="text" name="SQVAL1" required placeholder="Answer"><br>
                    <label for="SQ2">Security Question 2: </label>
                    <select name="SQ2" required>
                        <option value="1">What was your favorite subject in high school?</option>
                        <option value="2" selected>What is the name of your first pet?</option>
                        <option value="3">What is the name of the town where you were born?</option>
                        <option value="4">What was the first company that you worked for?</option>
                    </select>
                    <input type="text" name="SQVAL2" required placeholder="Answer"><br>
                    <button type="submit" class="submit" name="changPassw">Confirm</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="closeChangPassw()" class="cancelbtn">Cancel</button>
                </div>
                <input type="hidden" name="pageName" value="index.php">
            </form>
        </div>