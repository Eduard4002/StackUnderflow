function openLoginModal(){
    document.getElementById('id01').style.display = "block";
}
function openSignUpModal(){
    document.getElementById('id02').style.display = "block";
}
function closeLoginModal(){
    document.getElementById('id01').style.display = "none";
}
function closeSignUpModal(){
    document.getElementById('id02').style.display = "none";
}
function logout(){
    window.location.href = "userDATA.php?logout";
}