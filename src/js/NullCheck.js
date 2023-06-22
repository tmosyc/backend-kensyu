const signUpButton = document.getElementById('signup');
const registerForm = document.getElementById('register_form')
const validationText = document.getElementById('validation')

signUpButton.addEventListener('click',() => {
    const username = registerForm.elements.username;
    const email = registerForm.elements.email;
    const password = registerForm.elements.password;
    if (!(username) && !(email) && !(password)){
        validationText.textContent = '空欄です。登録できません'
    }
})
