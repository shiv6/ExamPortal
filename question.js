function changeQuestion(val){
	if(val.className == "question-button unatempted"){
		val.classList.remove("unatempted");
		val.classList.add("skipped");
	}
	val.classList.add("current-question");
	var q = document.getElementById("q"+val.id);
	var p = document.getElementById("detector");
	var x = document.getElementById(p.innerHTML.substring(1));
	x.classList.remove("current-question");
	var o = document.getElementById(p.innerHTML);
	o.style.transform = "scale(0, 1)";
	o.style.display = "none";
	q.style.display = "block";
	q.style.transform = "scale(1, 1)";
	p.innerHTML = q.id;	
}

function markat(val){
	var b = document.getElementById(val);
	b.classList.remove("skipped");
	b.classList.add("atempted");
}

function getPrev(){
	var span = document.getElementById("detector");
	var oldId = span.innerHTML;
	if(oldId != "q1"){
		var prevNumber = String(parseInt(oldId.substring(1))-1);
		var newId = "q"+ prevNumber;
		var newEle = document.getElementById(newId);
		var oldEle = document.getElementById(oldId);
		var newBtn = document.getElementById(prevNumber);
		if(newBtn.className == "question-button unatempted"){
			newBtn.classList.remove("unatempted");
			newBtn.classList.add("skipped");
		}
		newBtn.classList.add("current-question");
		var oldBtn = document.getElementById(oldId.substring(1));
		oldBtn.classList.remove("current-question");
		oldEle.style.transform = "scale(0, 1)";
		oldEle.style.display = "none";
		newEle.style.display = "block";
		newEle.style.transform = "scale(1, 1)";
		span.innerHTML = newEle.id;
	}
}

function getNext(){
	var span = document.getElementById("detector");
	var oldId = span.innerHTML;
	if(oldId != "q10"){
		var prevNumber = String(parseInt(oldId.substring(1))+1);
		var newId = "q"+ prevNumber;
		var newEle = document.getElementById(newId);
		var oldEle = document.getElementById(oldId);
		var newBtn = document.getElementById(prevNumber);
		if(newBtn.className == "question-button unatempted"){
			newBtn.classList.remove("unatempted");
			newBtn.classList.add("skipped");
		}
		newBtn.classList.add("current-question");
		var oldBtn = document.getElementById(oldId.substring(1));
		oldBtn.classList.remove("current-question");
		oldEle.style.transform = "scale(0, 1)";
		oldEle.style.display = "none";
		newEle.style.display = "block";
		newEle.style.transform = "scale(1, 1)";
		span.innerHTML = newEle.id;
	}
}

function timer(start_time){
	var current_time = parseInt(new Date().getTime()/1000);
	var remaining_time = 600 - (current_time - start_time);
	var sec = remaining_time % 60;
	var min = parseInt(remaining_time / 60);
	var block = document.getElementById("timer");
	var btn = document.getElementById("done");
	var check = setInterval(function(){
		block.innerHTML = "Time Remaining: " + String(min) + " : "+ String(sec);
		sec--;
		if(min <= -1){
			alert("time up");
			btn.click();
		}
		if(sec < 0){
			min--;
			sec = 59;
			if(min == 0)
				block.style.color = "red";
		}
	}, 1000);
}

function getContent(){
	var mod = document.getElementById("conf-modal-body");
	var ques = document.getElementById("ques-ans");
	mod.innerHTML = ques.innerHTML;
	var r = document.getElementsByName("radio1");
	for(var i = 0; i < r.length; i++){
		if(r[i].checked)
			alert(r[i].value);
	}
}

function conf(){
	var r = confirm("you must have to submit fist");
	if(r) document.getElementById("done").click();
}