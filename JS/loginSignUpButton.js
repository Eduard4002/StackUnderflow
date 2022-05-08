function openLoginModal(){
    document.getElementById('id01').style.display = "block";
}
function openSignUpModal(){
    document.getElementById('id02').style.display = "block";
}
function openInboxModal(){
    document.getElementById('id03').style.display = "block";
}
function openChangPassw(){
    document.getElementById('id04').style.display = "block";
}
function closeLoginModal(){
    document.getElementById('id01').style.display = "none";
}
function closeSignUpModal(){
    document.getElementById('id02').style.display = "none";
}
function closeInboxModal(){
    document.getElementById('id03').style.display = "none";
}
function closeChangPassw(){
    document.getElementById('id04').style.display = "none";
}
function logout(){
    window.location.href = "userDATA.php?logout";
}