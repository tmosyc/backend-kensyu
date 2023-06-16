const images = document.getElementById('images');
images.addEventListener('change', function (e){
    const imageList = e.target.files;
    const imageArray = Array.from(imageList);
    let imageAttribute = document.querySelector(".image-attribute")
    imageArray.forEach(function (element){
        let check = document.createElement('input');
        check.setAttribute('type','checkbox');
        check.setAttribute('name','check');
        check.setAttribute('value',element['name']);
        let label = document.createElement('label');
        label.appendChild(check);
        label.appendChild(document.createTextNode(element['name']))
        imageAttribute.insertBefore(label, imageAttribute.firstChild)
    })

    const checkGet = document.getElementsByName('check');
    checkGet.forEach((check) => {
        check.addEventListener('click', () => {
            if(check.checked) {
                checkGet.forEach((allChecks) => {
                    allChecks.checked = false;
                });
                check.checked = true;
            }
        });
    });
})
