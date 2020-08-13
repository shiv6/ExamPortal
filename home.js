function getBack(){
	var f = document.getElementsByClassName("front");
	var b = document.getElementsByClassName("back");
	f[0].style.transform = "perspective(900px) rotateY(-180deg)";
	b[0].style.transform = "perspective(900px) rotateY(0deg)";
	var x = document.getElementById("login");
	var y = document.getElementById("signup");
	x.style.display = "none";
	y.style.display = "block";
}
function getFront(){
	var f = document.getElementsByClassName("front");
	var b = document.getElementsByClassName("back");
	f[0].style.transform = "perspective(900px) rotateY(0deg)";
	b[0].style.transform = "perspective(900px) rotateY(180deg)";
	var x = document.getElementById("login");
	var y = document.getElementById("signup");
	y.style.display = "none";
	x.style.display = "block";
}

function validate(){
	var name = document.getElementsByName("name")[0];
	var flag = 0;
	if(name.value.length == 0){
		name.classList.remove("is-valid");
		name.classList.add("is-invalid");
		flag = 1;
	}
	else{
		name.classList.remove("is-invalid");
		name.classList.add("is-valid");
	}
	var roll = document.getElementsByName("rollno")[0];
	if(roll.value.length == 0){
		roll.classList.remove("is-valid");
		roll.classList.add("is-invalid");
		flag = 1;
	}
	else{
		roll.classList.remove("is-invalid");
		roll.classList.add("is-valid");
	}
	var mail = document.getElementsByName("email")[0];
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(String(mail.value).toLowerCase()) == false){
		mail.classList.remove("is-valid");
		mail.classList.add("is-invalid");
		flag = 1;
	}
	else{
		mail.classList.remove("is-invalid");
		mail.classList.add("is-valid");
	}
	var password = document.getElementsByName("password")[0];
	re = /^(?=.*[0-9])(?=.*[A-Za-z])[a-zA-Z0-9!@#$%^&*]{6,20}$/;
	if(re.test(String(password.value)) == false){
		password.classList.remove("is-valid");
		password.classList.add("is-invalid");
		flag = 1;
	}
	else{
		password.classList.remove("is-invalid");
		password.classList.add("is-valid");
	}
	var course = document.getElementsByName("course")[0];
	if(course.value == "sel"){
		course.classList.remove("is-valid");
		course.classList.add("is-invalid");
		flag = 1;
	}
	else{
		course.classList.remove("is-invalid");
		course.classList.add("is-valid");
	}
	if(flag == 0)
		return true;
	return false;
}

function setSemester(){
	var course = document.getElementsByName("course")[0];
	var sem = document.getElementsByName("sem")[0];
	if(course.value == "mca"){
		sem.innerHTML = "<option value='1'>I</option><option value='2'>II</option>\
						<option value='3'>III</option><option value='4'>IV</option>\
						<option value='5'>V</option><option value='6'>VI</option>";
	}
	if(course.value == "btech"){
		sem.innerHTML = "<option value='1'>I</option><option value='2'>II</option>\
						<option value='3'>III</option><option value='4'>IV</option>\
						<option value='5'>V</option><option value='6'>VI</option>\
						<option value='7'>VII</option><option value='8'>VIII</option>";
	}
	if(course.value == "mtech"){
		sem.innerHTML = "<option value='1'>I</option><option value='2'>II</option>\
						<option value='3'>III</option><option value='4'>IV</option>";
	}
}
