document.addEventListener('DOMContentLoaded', function(){
    alert('working');
    var wrapper = document.querySelector('.product-description');
    if(wrapper){
        var disclaimer = document.createElement('div');
        disclaimer.style.fontSize = '13px';
        disclaimer.innerHTML = '<em>This is some disclaimer text.</em>';
        wrapper.appendChild(disclaimer);
    }
});