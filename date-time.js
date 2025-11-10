function updateDateTime(){
    const now= new Date();
    const date= now.toLocaleDateString();
    const time=now.toLocaleTimeString();
    document.getElementById('time').textContent = time;
    document.getElementById('date').textContent = date;
 
}

setInterval(updateDateTime, 1000);
updateDateTime();
