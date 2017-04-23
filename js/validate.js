
  //validate register form
   function chkregister(){
	   
	   var Names = document.register_form.names ; 
	   var Email = document.register_form.email ;
	   var Phone = document.register_form.phone ;
	   var Pass = document.register_form.password ;
	   var Cpass = document.register_form.cpassword ;
	   
	       if(Names.value =="") {
		   alert("Please Enter Your Names");
		   document.register_form.names.focus();
		   return false;
		   }
		   
		   if (Email.value.indexOf("@", 0) < 0)
			{
				window.alert("Please enter a valid e-mail address.");
				document.register_form.email.focus();
				return false;
			}
			
			
			if (Email.value.indexOf(".", 0) < 0)
			{
				window.alert("Please enter a valid e-mail address.");
				document.register_form.email.focus();
				return false;
			}
		    
		   if(Phone.value =="") {
		   alert("Please Enter Your Phone Number");
		   document.register_form.phone.focus();
		   return false;
		   }
		   
		   if(Pass.value =="") {
		   alert("Please Enter Your Password");
		   document.register_form.password.focus();
		   return false;
		   }
		   
		   if(Cpass.value =="") {
		   alert("Please confirm your password");
		   document.register_form.cpassword.focus();
		   return false;
		   }
	   return true; 
	   }
	   
	   //validate password
	   function chkpass(){
		   
	   var Pass = document.register_form.password ;
	   var Cpass = document.register_form.cpassword ;
	   
	       if(Pass.value!=Cpass.value){
		   alert("PASSWORDS DO NOT MATCH");
		   document.register_form.cpassword.value = "";
		   return false; 
		   }
		   return true; 
		   }
  
  
  
  //validate Update register form
   function chkUpdateregister(){
	   
	   var Names = document.register_form.names ; 
	   var Phone = document.register_form.phone ;
	   var Pass = document.register_form.password ;
	   var Cpass = document.register_form.cpassword ;
	   
	       if(Names.value =="") {
		   alert("Please Enter Your Names");
		   document.register_form.names.focus();
		   return false;
		   }
		   
		 
		   if(Phone.value =="") {
		   alert("Please Enter Your Phone Number");
		   document.register_form.phone.focus();
		   return false;
		   }
		   
		   if((Pass.value !="")||(Cpass.value !="")) {
		   alert("Please Enter Your Password and confirm password");
		   document.register_form.password.focus();
		   return false;
		   }
		   
		 alert("Your Account has been updated successfully!");   
	   return true; 
	   }
	   
	   //validate password
	   function chkpass(){
		   
	   var Pass = document.register_form.password ;
	   var Cpass = document.register_form.cpassword ;
	   
	       if(Pass.value!=Cpass.value){
		   alert("PASSWORDS DO NOT MATCH");
		   document.register_form.cpassword.value = "";
		   return false; 
		   }
		   return true; 
		   }
  
  
  
  
           //validate phone number
			            function isNumeric(elem,helperMsg)
						{
							var NumPhone = document.register_form.phone;
							
							if(NumPhone.value !=""){
								
							var numericExpression=/^[0-9]{10}$/;
							if(elem.value.match(numericExpression)){
								return true;
							}
							else
							{
								alert(helperMsg);
								elem.focus();
								return false;
								
								} 
								} 
						}
						
						
						
						
						
						  function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}