/**
 * 
 */


function validateForm(residentForm)
{	
	var proceed = true;
	
	with(loginForm)
	{
		if(username.value.trim() != "")
			unameError.innerHTML = "";
		else{
			unameError.innerHTML = "Invalid username";
			proceed = false;
		}
		if(username.value.indexOf("'")!=-1){
			unameError.innerHTML = "Username can't contain ' ";
			proceed = false;
			
		}
		
		if(password.value.trim() != "")
			passError.innerHTML = "";
		else{
			passError.innerHTML = "Invalid password";
			proceed = false;
		}
		if(password.value.indexOf("'")!=-1){
			passError.innerHTML = "Password can't contain \"'\" ";
			proceed = false;
		
		}
	}
	
	return proceed;
	
}