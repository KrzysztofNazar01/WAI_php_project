
function load_counter()
{
  if(localStorage.getItem("counter")!=null)
      {
          counter = Number(localStorage.getItem("counter"));
          document.getElementById("ilosc").value = counter;
      }

}

var counter= 0;        

function increment() {          
  counter = Number(localStorage.getItem("counter"));

  console.log(counter);
  counter += 1;
  localStorage.setItem("counter",counter);             
  document.getElementById("ilosc").value= counter;


}

function decrement() {          
  counter = Number(localStorage.getItem("counter"));

  console.log(counter);
  if(counter>1)
  {
      counter -= 1;
  localStorage.setItem("counter",counter);             
  document.getElementById("ilosc").value= counter;

  }

}


function myFunction(wartosc) {
  counter = Number(localStorage.getItem("counter"));
  console.log(counter);
  counter =wartosc;
  localStorage.setItem("counter",wartosc);             
  document.getElementById("ilosc").value= counter;

  



}


    
function setfor1() {
  counter = Number(localStorage.getItem("counter"));
  console.log(counter);
  counter =1;
  localStorage.setItem("counter",counter);             
  document.getElementById("ilosc2").value= counter;
  

}

function hide(){
  document.getElementById("ilosc2").style.visibility = "hidden";
}


function sampleFunction() {
  location.reload();
}



