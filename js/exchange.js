function checkMailsDifferent(){
    /** var mail1 = document.getElementById('myInput1');
    var mail2 = document.getElementById('myInput2');

    var btn = document.getElementById('btn-exchange');
    if(mail1.value == mail2.value ){
        btn.disabled = true;
    }else{
        btn.disabled = false;
        btn.style.backgroundColor = "#45a049";
    }*/
}

document.getElementById('myInput1').onchange = checkMailsDifferent;
document.getElementById('myInput2').onchange = checkMailsDifferent;