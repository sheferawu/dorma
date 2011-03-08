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
		
		if(password.value.trim() != "")
			passError.innerHTML = "";
		else{
			passError.innerHTML = "Invalid password";
			proceed = false;
		}
	}
	
	return proceed;
	
}