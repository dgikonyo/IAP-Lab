function validateForm(){//validates our form
    var fname=document.forms["registrationForm"]["first_name"].value;
    var lname=document.forms["registrationForm"]["last_name"].value;
    var city=document.forms["registrationForm"]["city_name"].value;
    //registrationForm is the name of our form

    if(fname==null||lname==""||city==""){
        alert("Not all required details have been entered");
        return false;
    }
    
    return true;
}