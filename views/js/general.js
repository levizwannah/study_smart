
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