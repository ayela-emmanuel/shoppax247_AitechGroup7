
var handler = document.getElementById("handler");



function AddTask(Task, Index){
    var Task = `
        <button style="color: red;" onclick="DeleteTask(${Index})" >Delete</button>
    ${Task}
    `;
    var taskdiv = document.createElement("div");
    taskdiv.id = "task-"+Index;
    taskdiv.innerHTML = Task;
    handler.appendChild(taskdiv)
}


function CreateNewTask(TaskInputID){
    var input = document.getElementById(TaskInputID)
    var value = input.value;
    if(value){
        var data = {
            "task": value
        }
        
        fetch("/api/new_task.php",{
            method:"POST",
            body:JSON.stringify(data),
        }).then((res)=>{
            if(res.ok){
                GetTasks()
            }
        })
    }
}


function DeleteTask(Index){
    // /api/delete_task.php
    var element = document.getElementById("task-"+Index);
    element.remove();
    fetch("/api/delete_task.php?delete="+Index).then(t =>{ GetTasks()});
}

function GetTasks(){
    // /api/tasks.php
    /**
     * [
     *  "Hello World", 
     *  "Wash The Car"
     * ]
     * 
     */
    fetch("/api/tasks.php").then(res=>{
        if(res.ok){
            return res.json();
        }
    }).then(data=>{
        handler.innerHTML = "";
        console.table(data)
        var i = 0
        data.forEach(element => {
            AddTask(element, i)
            i ++;
        });
    })

}


GetTasks();


