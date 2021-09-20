
function deleteTask(taskId){
    if(!confirm("Do you really want to remove this")) return;
    
    let formData = buildFormData({
        "task-id": taskId
    })
    makeRequest(`task/delete.php`, formData, (json) => {removeTask(taskId, json)});
}