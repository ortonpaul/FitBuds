

document.addEventListener('DOMContentLoaded',function(event){
    
    var button = document.getElementById("submitPassword");
if(button){
    console.log('On Loaded')
    button.addEventListener('click',function(){
    var val = document.getElementById("password").value;    
    var val2 = document.getElementById("confirmPassword").value;    
    console.log('ON CLICK',val,val2);
        
        if (val === val2){
            
            console.log('Password Confirm')
            window.location = "home.html";
        }
        else 
            {
                console.log('made it');
                document.getElementById("passwordError").innerHTML = "Passwords do not match.";
                
            }
        
});
} else {
    console.log('Not Working')
}
})
//console.log(password)
            
  //          function validatePassword()

    //        {
      //      if(password.value != confirm_password.value) 
            
        //    {
            
          //  confirm_password.setCustomValidity("Passwords Don't Match.");
            
            //}
            //else {
            //confirm_password.setCustomValidity('');
            //}
        //}
