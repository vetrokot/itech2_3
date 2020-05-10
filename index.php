<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
</head>
<body>

<div id = "mark-div">

  <form name ="marks">
  <lable>Get all marks: </lable>
  <input type="button" onclick = "getAllMarks()" value="ОК">
  </form> 
  <table style="border: 1px solid"><tr><th> Mark </th></tr>
  <tbody id = "mark-table"></tbody>
  </table>
  <table style="border: 1px solid"><tr><th> Last request </th></tr>
  <tbody id = "markRecent-table"></tbody>
  </table>
</div>

<div id ="race-div">

<form name ="race">
  <lable>Get cars with race lower then: </lable>
  <input type="text" id="race">
    <input type="button" onclick = "getCarsByRace()" value="ОК">
</form> 


<table style="border: 1px solid"><tr><th> Car </th></tr>
  <tbody id = "race-table"></tbody>
  </table>
  <table style="border: 1px solid"><tr><th> Last request </th></tr>
  <tbody id = "raceRecent-table"></tbody>
  </table>

</div>

<div id = "rent-div">

<form name ="rent">
  <lable> Get profit by date: </lable>
  <input type="date" id="date">
  <input type="button" onclick = "getProfit()" value="ОК">
</form> 

<table style="border: 1px solid"><tr><th> Profit </th></tr>
<tr><td>Car</td><td>Profit</td><td>Rent cost</td></tr>
<tbody id = "rent-table"></tbody>
</table>

<table style="border: 1px solid"><tr><th> Last request </th></tr>
<tbody id = "rentRecent-table"></tbody>
</table>

</div>


<script>
const ajax = new XMLHttpRequest();

function getAllMarks(){

    ajax.onreadystatechange = updateMarks;
    ajax.open("GET", "getAllMarks.php");
    ajax.send(null);
}

  function updateMarks(){
    if(ajax.readyState === 4){
      if(ajax.status === 200){
        let text = document.getElementById('mark-table');
        let res = ajax.responseText;
        let resHtml ="";
        let newReq = [];
        let lastReqHtml ="";
        let lastReq = JSON.parse(localStorage.getItem("mark"));

        res = JSON.parse(res);

        res.forEach(car =>{
         resHtml += "<tr><td style = 'border: 1px solid'>" + car["car"] +"</td><td style = 'border: 1px solid'>" + car["year"] +"</td></tr>";
         newReq.push(car);
        });

      if(lastReq == null){
        lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
        document.getElementById("markRecent-table").innerHTML = lastReqHtml;
      }else{
        lastReq.forEach(car =>{
        lastReqHtml += "<tr><td style = 'border: 1px solid'>" + car["car"] +"</td><td style = 'border: 1px solid'>" + car["year"] +"</td></tr>";
      });
        document.getElementById("markRecent-table").innerHTML = lastReqHtml;
    }   
      localStorage.setItem("mark", JSON.stringify(newReq)); 
      text.innerHTML = resHtml;
      }
    }
  }

function getCarsByRace(){
let race = document.getElementById("race").value;

ajax.onreadystatechange = updateRace;
ajax.open("GET", "getCarsByRace.php?race="+ race);
ajax.send(null);
}

function updateRace(){
if(ajax.readyState === 4){
  if(ajax.status === 200){
    let text = document.getElementById('race-table');
    let res = ajax.responseText;
    let resHtml ="";
    let newReq = [];
    
    let lastReqHtml ="";
    let lastReq = JSON.parse(localStorage.getItem("race"));
    
    res = JSON.parse(res);
    if(res == null){
      resHtml += "<tr><td style = 'border: 1px solid'> UNEXISTED </td></tr>";
      newReq.push(car);
    }else{
      res.forEach(car =>{
      resHtml += "<tr><td style = 'border: 1px solid'>" + car["car"] +"</td><td style = 'border: 1px solid'>" + car["year"] +"</td><td style = 'border: 1px solid'>" + car["race"] +"</td></tr>";
      newReq.push(car); 
      });
    }
  
    if(lastReq == null){
        lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
        document.getElementById("raceRecent-table").innerHTML = lastReqHtml;
      }else{
        lastReq.forEach(car =>{
        lastReqHtml += "<tr><td style = 'border: 1px solid'>" + car["car"] +"</td><td style = 'border: 1px solid'>" + car["year"] +"</td><td style = 'border: 1px solid'>" + car["race"] +"</td></tr>"
      });
        document.getElementById("raceRecent-table").innerHTML = lastReqHtml;
    }   
      localStorage.setItem("race", JSON.stringify(newReq)); 
      text.innerHTML = resHtml;
  }
}
}

function getProfit(){
	let date = document.getElementById("date").value;
	ajax.onreadystatechange = updateRent;
	ajax.open("GET", "getProfit.php?date="+ date);
	ajax.send(null);
}

function updateRent(){
if(ajax.readyState === 4){
  if(ajax.status === 200){
    let text = document.getElementById('rent-table');
    let res = ajax.responseText;
    let resHtml ="";
    let newReq = [];
    let lastReqHtml ="";
    let lastReq = JSON.parse(localStorage.getItem("rent"));
	
    res = JSON.parse(res);
    if(res == null){
      resHtml += "<tr><td style = 'border: 1px solid'> UNEXISTED </td></tr>";
      newReq.push(car);
    }else{
      res.forEach(car =>{
      resHtml += "<tr><td style = 'border: 1px solid'>" + car[0] +"</td><td style = 'border: 1px solid'>" + car[1] +"</td><td style = 'border: 1px solid'>" + car[2] +"</td></tr>";
      newReq.push(car); 
      });
    }
  
    if(lastReq == null){
        lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
        document.getElementById("rentRecent-table").innerHTML = lastReqHtml;
      }else{
        lastReq.forEach(car =>{
        lastReqHtml += "<tr><td style = 'border: 1px solid'>" + car[0] +"</td><td style = 'border: 1px solid'>" + car[1] +"</td><td style = 'border: 1px solid'>" + car[2] +"</td></tr>";

      });
        document.getElementById("rentRecent-table").innerHTML = lastReqHtml;
    }   
      localStorage.setItem("rent", JSON.stringify(newReq)); 
      text.innerHTML = resHtml;
  }
}
}
</script>
</body>
</html>