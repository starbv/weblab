"use strict"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form1');
    form.addEventListener('submit', formSend);
    let formReq = document.querySelectorAll('._reqSign');
    let error = false;
    let errordata = false;

    const regExpPass = /^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8,}$/;


    const submit = () => {
        let sendData = {};
        sendData['email'] = formReq[0].value;
        sendData['password'] = formReq[1].value;
        $(document).ready(function () {
            $.ajax({
                url: '/ajax_login',
                type: 'POST',
                data: {
                    'data': sendData
                },
                success: function (data) {
                    let json = JSON.parse(data);
                    if (json.msg != null) {
                        alert(json.msg);
                    } else {
                        location.reload(true);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            })
        });
    };

    const validateInput = (input) => {
        switch (input.name) {
            case ("email"):
                if (input.value == "") {
                    input.nextElementSibling.textContent =
                        "Please enter a valid email";
                    errordata = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
            case ("password"):
                console.log(input.value);
                let pwd = input.value.trim();
                if (pwd.length<8) {
                    input.nextElementSibling.textContent =
                        "Please enter correct password";
                    errordata = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    errordata = true;
                }
                break;
        }
    };


    for (let index = 0; index < formReq.length; index++) {
        const input = formReq[index];
        if (!input.classList.contains('form-check') && input.tagName != "BUTTON") {

            input.addEventListener("blur", () => {
                validateInput(input);
            });
        }
    }

    async function formSend(e) {
        e.preventDefault();
        formValidate(form);
        if (error) {
            if (errordata) {
                submit();
            } else {
                alert('Fill in the fields');
            }
        } else {
            alert('Fill in the fields');
        }
    }

    function formValidate(form) {
        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            if (!input.classList.contains('form-check') && input.tagName != "BUTTON") {

                if (input.value === '') {
                    input.nextElementSibling.textContent = "Please enter data";
                    error = false;
                } else {
                    input.nextElementSibling.textContent = "";
                    error = true;
                }
            }

        }

    }

});

