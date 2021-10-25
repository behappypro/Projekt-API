'use strict';

// Variabel för att spara url
var url = 'http://studenter.miun.se/~asha1900/dt173g/moment5-2/rest.php';

//Händelsehanterare som startar när sidan öppnas
window.onload = getCourses;

function getCourses(){
    fetch(url)
    .then((res)=>res.json())
    .then((data)=>{
        // Variabel som kommer innehålla all data
        let outPut = '';
        // loop för att gå igenom all data för utskrift
        data.forEach(function(post){
            outPut +=`
            <tr>
            <td>${post.code}</td>
            <td>${post.name}</td>
            <td>${post.progression}</td>
            <td><a href="${post.course_syllabus}" target="_blank">Webblänk</a></td>
            </tr>
            `
        });
        // Skriver ut innehållet i outPut till DOM
        document.getElementById('output').innerHTML = outPut;
    })
}

function addCourse(){
    // Hämtar värden från formuläret och lagrar i variabler
    let code = document.getElementById('code').value;
    let name = document.getElementById('name').value;
    let progression = document.getElementById('progression').value;
    let course_syllabus = document.getElementById('course_syllabus').value;

    // Gör en kontroll ifall textfälten är ifyllda, annars skrivs ett felmeddelande ut (null-check)
    if ((code == '' || code == null) ||
        (name == '' || name == null) ||
        (progression == '' || progression == null) ||
        (course_syllabus == '' || course_syllabus == null)
      )
      {
        // Skriver ut nedanstående meddelande om formuläret inte är ifyllt
        document.getElementById('message').innerHTML = 'Vänligen fyll i samtliga fält!';
      }
      else{
        // Gör om all data till json för att skicka det
        let jsonStr = JSON.stringify({
            code: code,
            name: name,
            progression: progression,
            course_syllabus: course_syllabus
          });
          // Skapar en POST fetch som skickar med all data 
          fetch(url, {
            method: 'POST',
            body: jsonStr
          })
            .then(res => res.json())
        }

      }



