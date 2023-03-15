function checkMailsDifferent(){
    var mail1 = document.getElementById('myInput1');
    var mail2 = document.getElementById('myInput2');

    var btn = document.getElementById('btn-exchange');
    console.log(mail1.value);
    console.log(mail1.textContent);
    console.log(mail2.value);
    console.log(mail2.textContent);
    if(mail1.textContent == mail2.textContent ){
        btn.disabled = true;
    }else{
        btn.disabled = false;
    }
}

document.getElementById('mail1').onchange = checkMailsDifferent;
document.getElementById('mail2').onchange = checkMailsDifferent;