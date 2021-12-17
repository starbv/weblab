"use strict"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form2');
    form.addEventListener('submit', formSend);
    let formReq = document.querySelectorAll('._reqReg');
    const pass = form.querySelector("._password");
    const reqPass = form.querySelector("._repPas");
    const check = form.querySelector(".form-check");
    let error = false;
    let errordata = false;

    const regExpName = /^[a-z0-9_-]{3,16}$/;
    const regExpEmail = /^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i;
    const regExpPass = /^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8,}$/;


    const submit = () => {
        alert("The data has been sent");
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            console.log(input.value);
        }
    };
    const maskPhone = () => {
        const inputsPhone = document.querySelectorAll('input[name="phone"]');

        inputsPhone.forEach((input) => {
            let keyCode;
            const mask = (event) => {
                event.keyCode && (keyCode = event.keyCode);
                let pos = input.selectionStart;
                if (pos < 3) {
                    event.preventDefault();
                }
                let matrix = "+7 (___) ___ __ __",
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = input.value.replace(/\D/g, ""),
                    newValue = matrix.replace(/[_\d]/g, (a) => {
                        if (i < val.length) {
                            return val.charAt(i++) || def.charAt(i);
                        }
                        else {
                            return a;
                        }
                    });
                i = newValue.indexOf("_");

                if (i != -1) {
                    i < 5 && (i = 3);
                    newValue = newValue.slice(0, i);
                }

                let reg = matrix
                    .substr(0, input.value.length)
                    .replace(/_+/g, (a) => {
                        return "\\d{1," + a.length + "}";
                    })
                    .replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (
                    !reg.test(input.value) ||
                    input.value.length < 5 ||
                    (keyCode > 47 && keyCode < 58)
                ) {
                    input.value = newValue;
                }
                if (event.type == "blur" && input.value.length < 5) {
                    input.value = "";
                }
            };

            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false);
        });
    };
    maskPhone();

    const validateInput = (input) => {
        switch (input.name) {
            case ("username"):
                if (!regExpName.test(input.value) && input.value !== "") {
                    input.nextElementSibling.textContent =
                        "Please enter a valid username";
                    errordata = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
            case ("email"):
                if (!regExpEmail.test(input.value) && input.value !== "") {
                    input.nextElementSibling.textContent =
                        "Please enter a valid email";
                    errordata = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
            case ("password"):
                if (reqPass.value !== pass.value && reqPass.value !== "") {
                    pass.nextElementSibling.textContent = "Password mismatch";
                    reqPass.nextElementSibling.textContent = "Password mismatch";
                    errordata = false;
                } else {
                    pass.nextElementSibling.textContent = "";
                    reqPass.nextElementSibling.textContent = "";
                    errordata = true;
                }

                if (!regExpPass.test(input.value) && input.value !== "") {
                    input.nextElementSibling.textContent =
                        "Please enter correct password";
                    errordata = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
            case ("reqPassword"):
                if (reqPass.value !== pass.value && reqPass.value !== "") {
                    pass.nextElementSibling.textContent = "Password mismatch";
                    reqPass.nextElementSibling.textContent = "Password mismatch";
                    errordata = false;
                } else {
                    pass.nextElementSibling.textContent = "";
                    reqPass.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
        }

    };

    async function formSend(e) {
        e.preventDefault();
        formValidate(form);
        if (error) {

            if (errordata) {
                if (check.checked) {
                    submit();
                    form.reset();
                }
                else {
                    alert("Please confirm your consent to data processing.");
                }
            }
            else {
                alert('Fill in the fields');
            }
        }
        else {
            alert('Fill in the fields');
        }
    }

    for (let index = 0; index < formReq.length; index++) {
        const input = formReq[index];
        if (!input.classList.contains('form-check') && input.tagName != "BUTTON") {

            input.addEventListener("blur", () => {
                validateInput(input);
            });
        }
    }

    function formValidate(form) {
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            if (!input.classList.contains('form-check') && input.tagName != "BUTTON") {

                if (input.value === '') {
                    input.nextElementSibling.textContent = "Please enter data";
                    error = false;
                }
                else {
                    input.nextElementSibling.textContent = "";
                    error = true;
                }
            }

        }

    }

});