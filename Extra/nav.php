<nav>
            <p id="title">stack<b>underflow</b></p>
            <div class="wrapper">
            <div class="search_box">
                <div class="dropdown">
                    <div class="default_option">All</div>  
                    <ul>
                    <li>All</li>
                    <li>Recent</li>
                    <li>Popular</li>
                    </ul>
                </div>
                <div class="search_field">
                <input type="text" class="input" placeholder="Search">
                <i class="fas fa-search"></i>
            </div>
            </div>
        </div>
            <div class="dropdown">
                <button class="dropbtn">Dropdown</button>
                <div class="dropdown-content">
                
                    <a href="index.php">Home</a>
                    <?php
                    
                        if(isset($_SESSION['USER'])){
                            echo '
                            <a onclick="openInboxModal()">Inbox</a>
                            <a onclick="logout()" class="logout">Log out</a>
                            ';
                                
                        }else{
                            echo '
                            <a onclick="openLoginModal()">Login</a>
                            <a onclick="openSignUpModal()">Sign Up</a>';
                        }
                    ?>
                    
                </div>
            </div>
        </nav>