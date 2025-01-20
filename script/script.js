
const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const nextBtnFourth = document.querySelector(".next-3");
const prevBtnFifth = document.querySelector(".prev-4");
const nextBtnFifth = document.querySelector(".next-4");
const prevBtnSixth = document.querySelector(".prev-5");
const nextBtnSixth = document.querySelector(".next-5");
const prevBtnSeventh = document.querySelector(".prev-6");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step-samad .bullet-samad");
const progressCheck = document.querySelectorAll(".step-samad .check");
const bullet = document.querySelectorAll(".step-samad .bullet-samad");
let current = 1;
let body = document.getElementById("body")
let alertMsg=`
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
<strong>Alert !</strong> Veuillez saisir tous les champs indiqués pour continuer`;
nextBtnFirst.addEventListener("click", function (event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-14.3%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
    removeAlert();
});
nextBtnSec.addEventListener("click", function (event) {
  event.preventDefault();
  removeAlert();
  let q1 = document.getElementsByName("q1")[0];
  let q2 = document.getElementsByName("q2")[0];
  let q3 = document.getElementsByName("q3")[0];
  let q4 = document.getElementsByName("q4")[0];
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if(q1.value!==""&&q2.value!==""&&q3.value!==""&&q4.value!==""){
    if(!emailRegex.test(q2.value)){
      let alertDiv = document.createElement("div");
    alertDiv.className="alert";
    alertDiv.innerHTML = `
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <strong>Alert !</strong> Veuillez entrer une adresse e-mail valide`;
    body.appendChild(alertDiv);
    }else{
      nextBtnSec.disabled=false;
      slidePage.style.marginLeft = "-28.6%";
      bullet[current - 1].classList.add("active");
      progressCheck[current - 1].classList.add("active");
      progressText[current - 1].classList.add("active");
      current += 1;
    }
    
  }else{
    nextBtnSec.removeAttribute("disabled");
    let alertDiv = document.createElement("div");
    alertDiv.className="alert";
    alertDiv.innerHTML = alertMsg;
    body.appendChild(alertDiv);
  }
 
});
nextBtnThird.addEventListener("click", function (event) {
  removeAlert();
  event.preventDefault();
  let q5 = document.getElementsByName("q5")[0];
  let q6 = document.getElementsByName("q6")[0];
  let q7 = document.getElementsByName("q7")[0];

  if (q5.selectedIndex > 0 && q6.selectedIndex > 0 && q7.selectedIndex > 0) {
    nextBtnThird.disabled = false;
    slidePage.style.marginLeft = "-42.9%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
  } else {
    nextBtnThird.removeAttribute("disabled");
    let alertDiv = document.createElement("div");
    alertDiv.className = "alert";
    alertDiv.innerHTML = alertMsg;  // Remove the duplicated line
    body.appendChild(alertDiv);
  }
});
nextBtnFourth.addEventListener("click", function (event) {
  removeAlert();
  event.preventDefault();
  let q8 = document.querySelectorAll('input[name="q8[]"]:checked');
  let q9 = document.getElementsByName("q9")[0];
  if (q8.length > 0 && q9.selectedIndex > 0) {
    nextBtnFourth.disabled = false;
    slidePage.style.marginLeft = "-57.2%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  } else {
    nextBtnFourth.removeAttribute("disabled");
    let alertDiv = document.createElement("div");
    alertDiv.className = "alert";
    alertDiv.innerHTML = alertMsg;  // Remove the duplicated line
    body.appendChild(alertDiv);
  }
});
nextBtnFifth.addEventListener("click", function (event) {
  removeAlert();
  event.preventDefault();
  let q11 = document.querySelectorAll('input[name="q11[]"]:checked');
  let q10 = document.getElementsByName("q10")[0];
  if (q11.length > 0 && q10.selectedIndex > 0) {
    nextBtnFifth.disabled = false;
    slidePage.style.marginLeft = "-71.5%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  } else {
    nextBtnFifth.removeAttribute("disabled");
    let alertDiv = document.createElement("div");
    alertDiv.className = "alert";
    alertDiv.innerHTML = alertMsg;  // Remove the duplicated line
    body.appendChild(alertDiv);
  }
});
nextBtnSixth.addEventListener("click", function (event) {
  removeAlert();
  let q12 = document.getElementsByName("q12")[0];
  let q12Extra = document.getElementsByName("q12Extra")[0];
  let q13 = document.getElementsByName("q13")[0];
  let q14 = document.getElementsByName("q14")[0];
  let q14Extra = document.getElementsByName("q14Extra")[0];
  if (q12.selectedIndex ==1 && q12Extra.selectedIndex > 0 && q13.selectedIndex>0 && q14.selectedIndex ==1 && q14Extra.selectedIndex > 0){
    nextBtnSixth.disabled = false;
  }else if(q14.selectedIndex ==1 && q14Extra.selectedIndex > 0  && q13.selectedIndex>0 && q12.selectedIndex ==2){
    nextBtnSixth.disabled = false;
  }else if(q12.selectedIndex ==1 && q12Extra.selectedIndex > 0  && q13.selectedIndex>0 && q14.selectedIndex ==2){
    nextBtnSixth.disabled = false;
  }else if(q12.selectedIndex ==2  && q13.selectedIndex>0 && q14.selectedIndex ==2){
    nextBtnSixth.disabled = false;
  }else {
    nextBtnSixth.removeAttribute("disabled");
    let alertDiv = document.createElement("div");
    alertDiv.className = "alert";
    alertDiv.innerHTML = alertMsg;  // Remove the duplicated line
    body.appendChild(alertDiv);
    event.preventDefault();
  }
});
submitBtn.addEventListener("click", function () {
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
prevBtnSec.addEventListener("click", function (event) {
  current=2;
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnThird.addEventListener("click", function (event) {
  current=3;
  event.preventDefault();
  slidePage.style.marginLeft = "-14.3%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function (event) {
  current=4;
  event.preventDefault();
  slidePage.style.marginLeft = "-28.6%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFifth.addEventListener("click", function (event) {
  current=5;
  event.preventDefault();
  slidePage.style.marginLeft = "-42.9%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnSixth.addEventListener("click", function (event) {
  current=6;
  event.preventDefault();
  slidePage.style.marginLeft = "-57.2%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnSeventh.addEventListener("click", function (event) {
  current=7;
  event.preventDefault();
  slidePage.style.marginLeft = "-71.5%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});

function showSpecifyInput2(a, b) {
  //  var select = document.getElementById("Autre");
  let input = document.getElementById(`${a}`);
  let specifyInput = document.getElementById(`${b}`);
    if (input.value === "Oui") {
      specifyInput.style.display = "block";
    } else {
      specifyInput.style.display = "none";
      specifyInput.value="";
    };
  }
function showSpecifyInput3(a,b,c) {
  //  var select = document.getElementById("Autre");
  let input = document.getElementById(`${a}`);
  let specifyInput = document.getElementById(`${b}`);
  let btn = document.getElementById(`${c}`);
    if (input.value === "Autre")  {
      specifyInput.style.display = "block";
      btn.disabled = true;
    } else {
      specifyInput.style.display = "none";
      specifyInput.value="";
      btn.disabled = false;
    };
  }

function showSpecifyInput(a, b, c, d, e,f,g) {
  //  var select = document.getElementById("Autre");
  let input1 = document.getElementById(`${a}`);
  let input2 = document.getElementById(`${b}`);
  let specifyInput = document.getElementById(`${c}`);
  let specifyInput2 = document.getElementById(`${d}`);
  let btn = document.getElementById(`${e}`);
  let type = input1.getAttribute('type');
  if (type == "checkbox") {
    if (input1.checked || input2.value === "Autre") {
      if (input1.checked) {
        specifyInput.style.display = "block";
      } else {
        specifyInput.style.display = "none";
      };
      if (input2.value === "Autre") {

        specifyInput2.style.display = "block";
      } else {

        specifyInput2.style.display = "none";
      };
      btn.disabled = true;
    } else {
      specifyInput.style.display = "none";
      specifyInput2.style.display = "none";
      btn.disabled = false;
    }

  } else if (input1.value === "Autre" || input2.value === "Autre") {

    if (input1.value === "Autre") {
      specifyInput.style.display = "block";
    } else {
      specifyInput.style.display = "none";
    };
    if (input2.value === "Autre") {
      specifyInput2.style.display = "block";
    } else {
      specifyInput2.style.display = "none";
    };
    btn.disabled = true; // Disabling the button
  } else {
    specifyInput.style.display = "none";
    specifyInput2.style.display = "none";
    btn.disabled = false; // Enabling the button
  }
}


function slider() {
  let q12field = document.getElementById("q12field");
  let q14field = document.getElementById("q14field");
  let q12 = document.getElementsByName("q12")[0];
  let q14 = document.getElementsByName("q14")[0];
  if(q12field.selectedIndex>0){
    q12field.style.display="block";
    q12.selectedIndex=1;
  };
   if(q14field.selectedIndex>0){
    q14field.style.display="block";
    q14.selectedIndex=1;
  };
   let current = 1;
  slidePage.style.marginLeft = "-85.8%";
  for(i=0;i<bullet.length;i++){
    bullet[i].classList.add("active");
    current += i;
  }
  for(i=0;i<progressText.length;i++){
    progressText[i].classList.add("active");
    current += i;
  }
  for(i=0;i<progressCheck.length;i++){
    progressCheck[i].classList.add("active");
    current += i;
  }
  bullet[6].classList.remove("active");
  progressText[6].classList.remove("active");
  progressCheck[6].classList.remove("active");
};
let formStatus = document.querySelector("#formStatus");

        if(formStatus.value==="submitted"){
          let current = 1;
          slider();
          function edit(x,y) {
            slidePage.style.marginLeft = `${x}`;
            for(i=y;i<bullet.length;i++){
              bullet[i].classList.remove("active");
              current += i;
            }
            for(i=y;i<progressText.length;i++){
              progressText[i].classList.remove("active");
              current += i;
            }
            for(i=y;i<progressCheck.length;i++){
              progressCheck[i].classList.remove("active");
              current += i;
            }
          };
}
function removeAlert(){
  let alertmsg = document.querySelectorAll('.alert');
  if(alertmsg.length>0){
    alertmsg[0].remove()
  }
}
function copyToClipboard(x) {
  
  // Get the text content from the div
  var dataToCopy = document.getElementById("dataToCopy");
  var textToCopy = dataToCopy.innerText || dataToCopy.textContent;

  // Create a temporary textarea element
  var textarea = document.createElement("textarea");
  textarea.value = textToCopy;
  document.body.appendChild(textarea);

  // Select and copy the text from the textarea
  textarea.select();
  document.execCommand("copy");

  // Remove the temporary textarea
  document.body.removeChild(textarea);
  let icon = document.getElementById("icon");
  icon.classList.remove("fa-copy");
  icon.classList.add("fa-check");
}

// step 1
// let q1 = document.getElementsByName("q1");
// let nextbtn = document.querySelector(".next-1");
// if(q1.value!==""){
//   nextbtn.setAttribute("disabled",'true')
// }else{

//   nextbtn.setAttribute("disabled",'false')
// }


