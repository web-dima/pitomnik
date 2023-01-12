$(document).ready(function () {
    $('.slider').slick();

    const loginBtn = $("#login-btn")
    if (loginBtn.length) {
        loginBtn.on("click", function (e) {
            e.preventDefault()
            const email = $("[name='login-email']").val()
            const pass = $("[name='login-pass']").val()

            $.ajax({
                type: "POST",
                url: "actions/login.php",
                data: {
                    email: email,
                    password: pass
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        document.location.href = "animals.php"
                    } else {
                        $(".message").html(response.error);
                    }

                }
            });
        })
    } else {
        loginBtn.off("click")
    }

    const registerBtn = $("#register-btn")
    if (registerBtn.length) {
        registerBtn.on("click", function (e) {
            e.preventDefault()
            const email = $("[name='register-email']").val()
            const name = $("[name='register-name']").val()
            const pass = $("[name='register-pass']").val()

            $.ajax({
                type: "POST",
                url: "actions/register.php",
                data: {
                    email: email,
                    name: name,
                    password: pass
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        document.location.href = "animals.php"
                    } else {
                        $(".message").html(response.error);
                    }

                }
            });
        })
    } else {
        registerBtn.off("click")
    }

    const addAnimalBtn = $("#add-animal-btn")
    if (addAnimalBtn.length) {
        addAnimalBtn.on("click", function (e) {
            e.preventDefault()

            const type = $("[name='animal-type']").val();
            const name = $("[name='animal-name']").val();
            const sex = $("[name='animal-sex']").val();
            const age = $("[name='animal-age']").val();
            const breed = $("[name='animal-breed']").val();
            const nursery = $("[name='animal-nursery']").val();
            const img = $("[name='animal-img']").prop('files')[0];

            const formData = new FormData()
            formData.append("type", type)
            formData.append("name", name)
            formData.append("sex", sex)
            formData.append("age", age)
            formData.append("breed", breed)
            formData.append("nursery", nursery)
            formData.append("img", img)

            $.ajax({
                url: "actions/add-animal.php",
                type: "POST",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $(".message").removeClass("error").addClass("success").html(response.message)
                        addAnimalBtn[0].closest("form").reset()
                    } else {
                        $(".message").removeClass("success").addClass("error").html(response.error);
                    }

                }
            });
        })
    } else {
        addAnimalBtn.off("click")
    }

    const createOrderBtn = $("#create-order-btn")
    if (createOrderBtn.length) {
        createOrderBtn.on("click", function (e) {
            e.preventDefault()
            const id = $(this).val()
            console.log(id);

            $.ajax({
                type: "POST",
                url: "actions/create-order.php",
                data: {
                    animal_id: id
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        console.log(response);
                        document.location.href = "orders.php"
                    } else {
                        if (response.type === "auth_error") {
                            document.location.href = "login.php"
                        } else {
                            console.log(response.error);
                        }
                    }

                }
            });
        })
    } else {
        createOrderBtn.off("click")
    }

    const changeStatusOrderBtns = document.querySelectorAll(".admOrder__control-btn");
    if (changeStatusOrderBtns.length) {
        function chageStatusHadler(e) {
            e.preventDefault()
            const select = e.currentTarget.closest("form").querySelector(".admOrder__control__select")
            const orderIdInput = e.currentTarget.closest("form").querySelector("#order_id-input")
            const userIdInput = e.currentTarget.closest("form").querySelector("#user_id-input")
            const animalIdInput = e.currentTarget.closest("form").querySelector("#animal_id-input")
            const nurseryIdInput = e.currentTarget.closest("form").querySelector("#nursery_id-input")
            function getEvent() {
                this.e = e;
            }
            const bool = select.value === "отказано" ? confirm("вы уверены что хотите удалить эту заявку?") : true

            if (!bool) return

            const [arrayOfOptions] = Array.from(select.children).filter(i => i.selected);

            $.ajax({
                type: "POST",
                url: "actions/chage-order-status.php",
                data: {
                    status: arrayOfOptions.value,
                    order_id: +orderIdInput.value,
                    user_id: +userIdInput.value,
                    animal_id: +animalIdInput.value,
                    nursery_id: +nurseryIdInput.value,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $(".message").html("");
                        if (response.delete) {
                            const { e } = new getEvent()
                            e.target.closest(".admOrder").style.display = "none";
                        }
                        alert(response.message)
                    } else {
                        $(".message").html(response.error);
                    }

                }
            });
        }

        changeStatusOrderBtns.forEach(btn => {
            btn.addEventListener('click', chageStatusHadler)
        });

    } else {
        changeStatusOrderBtns.forEach(btn => {
            btn.removeEventListener('click', chageStatusHadler)
        })
    }

    function num2word($num) {
        $words = ['год', 'года', 'лет'];
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: {
                return ($words[0]);
            }
            case 2: case 3: case 4: {
                return ($words[1]);
            }
            default: {
                return ($words[2]);
            }
        }
    }


    const filterBtn = $("#fillterBtn")
    if (filterBtn) {
        filterBtn.on("click", function (e) {
            e.preventDefault()
            const arrayOfTypes = $("[name='type']")
            const arrayOfSex = $("[name='sex']")
            const arrayOfBreeds = $("[name='breed']")
            const ageMin = $("[name='age-min']").val()
            const ageMax = $("[name='age-max']").val()
            const request = {
                type: "",
                sex: "",
                age: {
                    min: ageMin,
                    max: ageMax
                },
                breed: [],
            }
            $.each(arrayOfTypes, function (_, item) {
                if (item.checked) {
                    request.type = item.value
                }
            });
            $.each(arrayOfSex, function (_, item) {
                if (item.checked) {
                    request.sex = item.value
                }
            });

            $.each(arrayOfBreeds, function (_, item) {
                if (item.checked) {
                    request.breed = [...request.breed, item.value]
                }
            });
            console.log(request);



            $.ajax({
                type: "POST",
                url: "actions/filter-animals.php",
                data: {
                    request: request
                },
                dataType: "json",
                success: function (response) {
                    $(".catalog").html("");
                    const filteredArray = $.map(response, function (elementOrValue) {
                        return {
                            id: elementOrValue[0],
                            name: elementOrValue[1],
                            img: elementOrValue[2],
                            sex: elementOrValue[3],
                            age: elementOrValue[4],
                        }
                    });
                    filteredArray.forEach(i => {
                        console.log(i);

                        const te = ``
                        $(".catalog").append(
                            `<a class="animal__card-item animal__card-def" href="animal.php?id=${i.id} ">
                                <div class="animal__card-img" >
                                    <img src='img/${i.img}'>
                                </div>
                                <div class="animal__card__content">
                                    <div class="animal__card__name">${i.name}</div>
                                    <div class="animal__card__name">возраст - ${i.age} ${num2word(i.age)}</div>
                                    <div>пол: <span class="animal__card__sex">${i.sex}</span></div>
                                </div>
                            </a>`
                        );
                    });

                }
            });
        })


    } else {
        filterBtn.off("click")
    }

    const resetFiltersBtn = $("#resetBtn")
    if (resetFiltersBtn) {
        resetFiltersBtn.on("click", function (e) {
            e.preventDefault()
            $(this).closest("form").trigger("reset");
            const request = {}
            $.ajax({
                type: "POST",
                url: "actions/filter-animals.php",
                data: {
                    request: request
                },
                dataType: "json",
                success: function (response) {
                    $(".catalog").html("");
                    const filteredArray = $.map(response, function (elementOrValue) {
                        return {
                            id: elementOrValue[0],
                            name: elementOrValue[1],
                            img: elementOrValue[2],
                            sex: elementOrValue[3],
                            age: elementOrValue[4],
                        }
                    });
                    filteredArray.forEach(i => {
                        console.log(i);

                        const te = ``
                        $(".catalog").append(
                            `<a class="animal__card-item animal__card-def" href="animal.php?id=${i.id} ">
                                <div class="animal__card-img" >
                                    <img src='img/${i.img}'>
                                </div>
                                <div class="animal__card__content">
                                    <div class="animal__card__name">${i.name}</div>
                                    <div class="animal__card__name">возраст - ${i.age} ${num2word(i.age)}</div>
                                    <div>пол: <span class="animal__card__sex">${i.sex}</span></div>
                                </div>
                            </a>`
                        );
                    });

                }
            });
        })
    } else {
        resetFiltersBtn.off("click")
    }

    const deleteOrderBtn = $(".order__btn")
    if (deleteOrderBtn) {
        $.each(deleteOrderBtn, function (_, valueOfElement) {
            valueOfElement.addEventListener("click", function (e) {
                e.preventDefault()
                const val = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "actions/delete-order.php",
                    data: {
                        order_id: val
                    },
                    dataType: "json",
                    success: (response) => {
                        if (response.success) {
                            console.log(this.closest(".order"));

                            this.closest(".order").style.display = "none"
                        } else {
                            console.log(response.error)
                        }


                    }
                })
            })
        });

    } else {
        deleteOrderBtn.off("click")
    }



})