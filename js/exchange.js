function checkMailsDifferent(){
    var mail1 = document.getElementById('mail1');
    var mail2 = document.getElementById('mail2');

    var btn = document.getElementById('btn-exchange');
    if(mail1.value == mail2.value ){
        btn.disabled = true;
    }else{
        btn.disabled = false;
    }
}

document.getElementById('mail1').onchange = checkMailsDifferent;
document.getElementById('mail2').onchange = checkMailsDifferent;