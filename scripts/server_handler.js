function update_file_list(){
  const select_menu = document.getElementById('fview');
  const xhr = new XMLHttpRequest(); // Creating a new XMLHttpRequest object
  xhr.open("POST", "update.php"); // Setting the request method and URL
  xhr.onload = function(){ // Setting the callback function for when the request is completed
      if(xhr.status == 200){ // Checking if the response status is OK
          select_menu.innerHTML = xhr.responseText; // Updating the inner HTML of the element with the response text
      } else {
          console.log("Request failed: " + xhr.status); // Logging the error status
      }
  }
  xhr.send(); // Sending the request
}


function fread(){
    hideModal();
    $.ajax({
        url:"handler.php",
        type:"POST",
        data:{
            read: document.getElementById('fview').value
        },
        success:function(response){
            $('#response').html(response)
        },
        error:function(error){
            console.log(error);
        }
    })
}
function fremove(){
    hideModal();
    const xhr = new XMLHttpRequest();
    xhr.open("POST","handler.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//for sending data
    xhr.onload = function(){
      if(xhr.status === 200){
        $("#response").html(xhr.responseText);
        update_file_list();
      }else{
        console.log("ERR: erro happened. "+ xhr.status);
      }
    }
    const rem = document.getElementById('fview').value
    xhr.send("rem=" + rem);
}
// Fetch hashToComma.php for converting texts;
document.querySelector("#hashForm").addEventListener("submit", function(e) {
    e.preventDefault();
  
    fetch("hashToComma.php", {
      method: "POST",
      body: new FormData(this)
    })
      .then(response =>{
        if(response.ok){
          return response.text()
        }else{
          throw new Error("Failed to execute the operation")
        }
      })
      .then(data => {
        document.querySelector("#response").innerHTML = data;
      })
      .catch(error => {
        console.log(error);
      });
  });
  
// Fetch commaToHash.php for converting hashtags;
document.querySelector("#commaForm").addEventListener("submit", function(e) {
  e.preventDefault();

  fetch("commaToHash.php", {
    method: "POST",
    body: new FormData(this)
  })
  .then(response =>{
    if(response.ok){
      return response.text()
    }else{
      throw new Error("Failed to execute the operation")
    }
  })
    .then(data => {
      document.querySelector("#response").innerHTML = data;
    })
    .catch(error => {
      console.log(error);
    });
});
// Fetch save.php
  document.querySelector("#saveForm").addEventListener("submit", function(e) {
    e.preventDefault();

    fetch("save.php", {
      method: "POST",
      body: new FormData(this)
    })
    .then(r =>{
      if(r.ok){
        return r.text()
      }else{
        throw new Error("Failed to execute the operation")
      }
    })
      .then(data => {
        document.querySelector("#response").innerHTML = data;

        update_file_list();
        hideModal();
      })
      .catch(error => {
        document.querySelector("#response").innerHTML = "Failed To Save File";
        console.log(error);
        hideModal();
      });
  });
  

