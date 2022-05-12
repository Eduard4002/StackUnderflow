<nav>
    <a href="index.php" id="title">stack<b>underflow</b></a>
        <div class="wrapper">
            <div class="search_box">
                    <div class="search_field">
                        <form action="searchSite.php" method="GET">
                            <input type="text" class="input" placeholder="Search" name="searchVal">
                        </form>
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