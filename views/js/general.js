
var error = document.getElementById("error-div");
var successDiv = document.getElementById("success-div");

/**
 * 
 * @param {string} url - do add the ../src/ to the url, it will be added automatically 
 * @param {FormData} formData  - the formData to send
 * @param {Function} callback - callback if needed
 * @returns 
 */
async function makeRequest(url = '', formData, callback = null) {
    url = `../src/${url}`;

    let user = {token: "nothing"};

    if(!url.match(/.*\/src\/signup.php$/g)){
        user = window.localStorage.getItem("user");
        if(!user){
            location.href = "login.php";
        }

        user = JSON.parse(user);
    }

    // Default options are marked with *
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Authorization': user.token
      },
      body: formData
    });

    if(callback){
        callback(response.json);
    }

    return response.json();
  }


  function showError(data, error_div = null){
    hideSuccess();
    if(error_div){
        error_div.style.opacity = "1";  
        error_div.addEventListener('transitionend', ()=>{
            error_div.innerHTML = data;
        });

        error_div.scrollIntoView({behavior: "smooth", block: "center"});
        setTimeout(() => {
            hideError(error_div);
        }, 5000);
        return;
    }
    error.style.opacity = "1";
    error.addEventListener('transitionend', ()=>{
        error.innerHTML = data;
    });
    viewError();
    setTimeout(() => {
        hideError();
    }, 5000);
}

function hideError(error_div = null){
    if(error_div){
        error_div.style.opacity = "0";
        error_div.addEventListener('transitionend', ()=>{
            error_div.innerHTML = "";
        });
        
        return;
    } 
    
    error.style.opacity = "0";
    error.addEventListener('transitionend', ()=>{
        error.innerHTML = "";
    });
}

function showSuccess(data)
{
    hideError();
    successDiv.style.opacity = "1"; 
    successDiv.addEventListener('transitionend', ()=>{
        successDiv.innerHTML = data;
    });
    viewSuccess();
    setTimeout(() => {
        hideSuccess();
    }, 5000);
}
 
function viewError(){
    error.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function viewSuccess(){
    successDiv.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function hideSuccess()
{
    successDiv.style.opacity = "0";
    
    successDiv.addEventListener('transitionend', ()=>{
        successDiv.innerHTML = "";
    });
}

function getFullStorageLink(link){
    return `../storage/${link}`;
}
