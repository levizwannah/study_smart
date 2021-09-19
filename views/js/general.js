
async function makeRequest(url = '', formData, callback = null) {
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