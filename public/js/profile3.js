function show_edit(){
    if(document.getElementsByClassName('edit-panel')[0].style.display == 'block'){
        document.getElementsByClassName('edit-panel')[0].style.display = 'none';
        document.getElementsByClassName('edit-profile')[0].value = 'edit profile';
    }else{
        document.getElementsByClassName('edit-panel')[0].style.display = 'block';
        document.getElementsByClassName('edit-profile')[0].value = 'close edit profile';
    }
}

function setEditBox(){
    var isPost = document.getElementsByName('isPost')[0].value;

    if(isPost == 1){
        document.getElementsByClassName('edit-panel')[0].style.display = 'block';
    }else{
        document.getElementsByClassName('edit-panel')[0].style.display = 'none';
    }
}

window.addEventListener('pageshow', setEditBox);

function show(){
    document.getElementById('confirmation').style.display = 'block';
}

function close_modal(){
    document.getElementById('confirmation').style.display = 'none';
}