const burger = () => {

    const buttonOpen = document.querySelectorAll('.burger');
    if (!buttonOpen) return false;

    const parent = document.querySelector('.modal-burger');
    if (!parent) return false;
    const content = parent.querySelector('.content');
    if (!content) return false;
    const buttonClose = parent.querySelector('.close');
    if (!buttonClose) return false;

    const bg = document.querySelector('.bg-black');

    if (!bg) return false;

    buttonOpen.forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            parent.classList.add('active');
            bg.classList.add('active');
            setTimeout(() => {
                content.classList.add('active')
            }, 0)
        });
    });


    buttonClose.addEventListener('click', (e) => {
        e.preventDefault();
        content.classList.remove('active');
        setTimeout(() => {
            parent.classList.remove('active');
        }, 300);
        bg.classList.remove('active');

    });

    parent.addEventListener('click', (e) => {
        if (e.target == parent) {
            content.classList.remove('active');
            setTimeout(() => {
                parent.classList.remove('active');

            }, 300)
            bg.classList.remove('active');
        }
    });
};

const modal = ($openClass, $closeClass, $parentClass) => {

    const openButtons = document.querySelectorAll($openClass);
    if (!openButtons) return false;

    const closeButtons = document.querySelectorAll($closeClass);
    if (!closeButtons) return false;

    const parents = document.querySelectorAll($parentClass);
    if (!parents) return false;

    openButtons.forEach((openButton) => {
        openButton.addEventListener('click', (e) => {
            e.preventDefault();
            parents.forEach((parent) => {
                const closeButton = parent.querySelector($closeClass);
                if (!closeButton) return false;
                parent.classList.add('active');
                closeButton.addEventListener('click', () => {
                    parent.classList.remove('active');
                })
            })
        })
    })
};

const programCourse = () => {
    const parent = document.querySelectorAll('.program-themes__item');

    if(parent.length == 0) return false;

    parent.forEach(el => {
        const text = el.querySelector('.about');
        const circle = el.querySelector('.circle');
        const arrow = el.querySelector('.arrow');
        if(!arrow) return false;

        el.addEventListener('click', () => {
            el.classList.toggle('active');
            circle.classList.toggle('active');
            arrow.classList.toggle('active');
            text.classList.toggle('active');
        })
    })
}

const navAccount = () => {

    const parent = document.querySelector('.account');
    if(!parent) return false;

    const menu = parent.querySelector('.menu');
    const button = parent.querySelector('.name');
    const accountWrapper = parent.querySelector('.account-wrapper');
    const arrow = parent.querySelector('.arrow');

    accountWrapper.addEventListener('click', () => {
        button.style.cssText=`user-select: none;`;
        menu.classList.toggle('active');
        arrow.classList.toggle('active');
    })

}

const numberAnimation = (elems) => {

    let elements = elems;
    // Параметры анимации
    const time = 1000;
    const step = 1;

    function outNum(elements) {
        let e = document.querySelectorAll(elements);
        e.forEach((item) => {
            // Числа
            let number = +item.textContent;
            let n = 0;
            let t = Math.round(time/(number/step));
            let interval = setInterval(() => {
                    n = n + step;
                    if (n === number) {
                        clearInterval(interval);
                    }
                    item.innerHTML = n;
                }, t);
        })
    }

    // Вызываем функцию
    outNum(elements);

}

// Изменение цвета текста option (при наведении opacity: 1)

const optionPlaceholder = (select) => {

    // Находим select
    const selectItems = document.querySelectorAll(select);

    // Проверяем существует ли данный select
    selectItems ? selectItems : false;

    // Перебор всех select
    selectItems.forEach((selectItem) => {

        // Вешаем событие change на select
        selectItem.addEventListener('change', () => {

            // Меняем цвет option при изменении значения option
            selectItem.style = 'color: #1D1D39 !important;';

        })
    })

}

// Перетягивание элементов (drag & drop)

// const dragAndDrop = (dragableImg, dragTextItem, buttonItem, inputItem, dragIconItem, contentInfo) => {

//     // Выбор всех необходимых элементов
//     const dropArea = document.querySelector(dragableImg);

//     const dragText = dropArea.querySelector(dragTextItem);
//     const button = dropArea.querySelector(buttonItem);
//     const input = dropArea.querySelector(inputItem);
//     const dragIcon = dropArea.querySelector(dragIconItem);

//     // Это глобальная переменная, и мы будем использовать ее внутри нескольких функций
//     let file;

//     // Если пользователь нажмет на кнопку, тогда ввод также нажмет
//     button.addEventListener('click', () => {
//         input.click();
//     })


//     input.addEventListener("change", (event) => {

//         // Получение файла выбранного пользователем и [0] означает то, что если пользователь выберет несколько файлов, то мы выберем только первый
//         file = event.target.files[0];

//         dropArea.classList.add("active");

//         // Вызываем функция
//         showFile();

//     });

//     // Если пользователь перетаскивает файл поверх DropArea
//     dropArea.addEventListener("dragover", (event) => {

//         // Предотвращение поведения по умолчанию
//         event.preventDefault();

//         dropArea.classList.add("active");

//         dragText.textContent = "Отпустите, чтобы загрузить файл";

//     });

//     // Если пользователь выведет за область перетаскиваемый файл из DropArea

//     dropArea.addEventListener("dragleave", () => {

//         dropArea.classList.remove("active");

//         dragText.textContent = "Перетащите сюда баннер";

//     });

//     // Если пользователь сбросит файл на DropArea

//     dropArea.addEventListener("drop", (event) => {

//         // Предотвращение поведения по умолчанию
//         event.preventDefault();

//         // Получение файла выбора пользователя и [0] это означает, что если пользователь выберет несколько файлов, мы выберем только первый
//         file = event.dataTransfer.files[0];

//         // Вызов функции
//         showFile();

//     });

//     function showFile() {

//         // Получение выбранного типа файла
//         let fileType = file.type;

//         // Добавление некоторых допустимых расширений изображений в массив
//         let validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];

//         // Если выбранный пользователем файл является изображением
//         if(validExtensions.includes(fileType)) {

//             // создание нового объекта FileReader
//             let fileReader = new FileReader();

//             fileReader.addEventListener('load', () => {

//                 // передача исходного файла пользователя в переменную fileURL
//                 let fileURL = fileReader.result;

//                 // создание тега img и передача выбранного пользователем источника файла внутри атрибута src
//                 let imgTag = `<img class="drag-img-styles" src="${fileURL}" alt="image">`;

//                 // добавление этого созданного тега img внутри контейнера dropArea
//                 const contentInfoItem = document.querySelector(contentInfo);
//                 contentInfoItem.innerHTML = imgTag;
//                 // dropArea.innerHTML = imgTag;

//             });

//             fileReader.readAsDataURL(file);

//         } else {

//             dragText.classList.add('active');
//             dragIcon.classList.add('active');
//             dropArea.classList.remove('active');
//             dragText.textContent = "Неверный формат файла!";

//         }
//     }

// }

const dragAndDrop = (dragableImg, dragTextItem, buttonItem, inputItem, dragIconItem, contentInfo) => {

    // Выбор всех необходимых элементов
    const dropArea = document.querySelectorAll(dragableImg);

    dropArea.forEach((dropArea) => {
        const dragText = dropArea.querySelector(dragTextItem);
        const button = dropArea.querySelector(buttonItem);
        const input = dropArea.querySelector(inputItem);
        const dragIcon = dropArea.querySelector(dragIconItem);
        const contentInfoItem = dropArea.querySelector(contentInfo);

        // Это глобальная переменная, и мы будем использовать ее внутри нескольких функций
        let file;

        // Если пользователь нажмет на кнопку, тогда ввод также нажмет
        button.addEventListener('click', () => {
            input.click();
        })


        input.addEventListener("change", (event) => {

            // Получение файла выбранного пользователем и [0] означает то, что если пользователь выберет несколько файлов, то мы выберем только первый
            file = event.target.files[0];
            dropArea.classList.add("active");

            // Вызываем функция
            showFile();

        });

        // Если пользователь перетаскивает файл поверх DropArea
        dropArea.addEventListener("dragover", (event) => {

            // Предотвращение поведения по умолчанию
            event.preventDefault();

            dropArea.classList.add("active");

            dragText.textContent = "Отпустите, чтобы загрузить файл";

        });

        // Если пользователь выведет за область перетаскиваемый файл из DropArea

        dropArea.addEventListener("dragleave", () => {

            dropArea.classList.remove("active");

            dragText.textContent = "Перетащите сюда баннер";

        });

        // Если пользователь сбросит файл на DropArea

        dropArea.addEventListener("drop", (event) => {

            // Предотвращение поведения по умолчанию
            event.preventDefault();

            // Получение файла выбора пользователя и [0] это означает, что если пользователь выберет несколько файлов, мы выберем только первый
            file = event.dataTransfer.file[0];

            // Вызов функции
            showFile();

        });

        function showFile() {

            // Получение выбранного типа файла
            let fileType = file.type;

            // Добавление некоторых допустимых расширений изображений в массив
            let validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];

            // Если выбранный пользователем файл является изображением
            if(validExtensions.includes(fileType)) {

                // создание нового объекта FileReader
                let fileReader = new FileReader();

                fileReader.addEventListener('load', () => {

                    // передача исходного файла пользователя в переменную fileURL
                    let fileURL = fileReader.result;

                    // создание тега img и передача выбранного пользователем источника файла внутри атрибута src
                    let imgTag = `<img class="drag-img-styles" src="${fileURL}" alt="image">`;

                    // добавление этого созданного тега img внутри контейнера dropArea
                    contentInfoItem.innerHTML = imgTag;
                    // dropArea.innerHTML = imgTag;

                });

                fileReader.readAsDataURL(file);

            } else {

                dragText.classList.add('active');
                dragIcon.classList.add('active');
                dropArea.classList.remove('active');
                dragText.textContent = "Неверный формат файла!";

            }
        }
    })

}

const dragAndDropMulti = (dragableImg, dragTextItem, buttonItem, inputItem, dragIconItem, contentInfoItem, contentFileItem, typeText) => {

    // Выбор всех необходимых элементов
    const dropArea = document.querySelectorAll(dragableImg);

    dropArea.forEach((dropArea) => {
        const dragText = dropArea.querySelector(dragTextItem);
        const button = dropArea.querySelector(buttonItem);
        const input = dropArea.querySelector(inputItem);
        const dragIcon = dropArea.querySelector(dragIconItem);
        const contentInfo = dropArea.querySelector(contentInfoItem);
        const contentFile = dropArea.querySelector(contentFileItem)

        // Это глобальная переменная, и мы будем использовать ее внутри нескольких функций
        let files;

        // Если пользователь нажмет на кнопку, тогда ввод также нажмет
        button.addEventListener('click', () => {
            input.click();
        })


        input.addEventListener("change", (event) => {

            // Получение файла выбранного пользователем и [0] означает то, что если пользователь выберет несколько файлов, то мы выберем только первый
            // file = event.target.files[0];

            files = event.target.files;

            dropArea.classList.add("active");

            // Вызываем функция
            showFile();

        });

        // Если пользователь перетаскивает файл поверх DropArea
        dropArea.addEventListener("dragover", (event) => {

            // Предотвращение поведения по умолчанию
            event.preventDefault();

            dropArea.classList.add("active");

            dragText.textContent = "Отпустите, чтобы загрузить файл";

        });

        // Если пользователь выведет за область перетаскиваемый файл из DropArea

        dropArea.addEventListener("dragleave", () => {

            dropArea.classList.remove("active");

            dragText.textContent = "Перетащите сюда баннер";

        });

        // Если пользователь сбросит файл на DropArea

        dropArea.addEventListener("drop", (event) => {

            // Предотвращение поведения по умолчанию
            event.preventDefault();

            // Получение файла выбора пользователя и [0] это означает, что если пользователь выберет несколько файлов, мы выберем только первый
            files = event.dataTransfer.files;

            // Вызов функции
            showFile();

        });

        function showFile() {
            if(files.length > 5) {
                dragText.classList.add('active');
                dragIcon.classList.add('active');
                dropArea.classList.remove('active');
                dragText.textContent = "Максимум 5 файлов!";
            } else {
                for (file of files) {
                    // Получение выбранного типа файла
                    let fileType = file.type;
                    let validExtensions;

                    if(typeText == 'files') {
                        // Добавление некоторых допустимых расширений файлов в массив
                        validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/pdf',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                        ];
                    } else if(typeText == 'videos') {
                        // Добавление некоторых допустимых расширений файлов в массив
                        validExtensions = ['video/ogg', 'video/mp4', 'video/webm'];
                    }

                    // Если выбранный пользователем файл является изображением
                    if(validExtensions.includes(fileType)) {

                        // создание нового объекта FileReader
                        let fileReader = new FileReader();

                        fileReader.addEventListener('load', () => {

                            // передача исходного файла пользователя в переменную fileURL
                            let fileURL = fileReader.result;

                            let image = document.createElement("img");
                            image.classList.add('drag-img-styles');
                            if(fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
                                fileType === 'application/pdf' ||
                                fileType === 'application/doc' ||
                                fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            {
                                image.src = '../../assets/img/document.svg';
                                image.alt = 'document';
                            } else {
                                image.src = fileURL;
                                image.alt = 'image';
                            }

                            contentInfo.innerHTML = "";

                            contentFile.appendChild(image);

                            // создание тега img и передача выбранного пользователем источника файла внутри атрибута src
                            // let imgTag = `<img class="drag-img-styles" src="${fileURL}" alt="image">`;

                            // добавление этого созданного тега img внутри контейнера dropArea
                            // contentInfo.innerHTML = imgTag;
                            // dropArea.innerHTML = imgTag;

                        });

                        fileReader.readAsDataURL(file);

                    } else {

                        dragText.classList.add('active');
                        dragIcon.classList.add('active');
                        dropArea.classList.remove('active');
                        dragText.textContent = "Неверный формат файла!";

                    }
                }
            }
        }
    })

}

// Маска для ввода телефона

const telMask = (telClass) => {

    const forEach = ( list, callback ) => {
        Array.prototype.forEach.call( list, callback );
    }

    forEach( document.querySelectorAll(telClass), (input) => {

        let keyCode;

        function mask(event) {
            event.keyCode && (keyCode = event.keyCode);
            let pos = this.selectionStart;
            if (pos < 3) event.preventDefault();
            let matrix = "+7 (___) ___ ____",
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = this.value.replace(/\D/g, ""),
                new_value = matrix.replace(/[_\d]/g, function(a) {
                    return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            let reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }

        input.addEventListener("input", mask, false);
        input.addEventListener("focus", mask, false);
        input.addEventListener("blur", mask, false);
        input.addEventListener("keydown", mask, false)
     });
}

const elAnim = () => {

    // Изначально убираем opacity для работы с turbolinks

    // Отслеживаем перезагрузку сайта
    if (window.performance) {

        // Создаем функцию для автоматизации поиска классов
        const getList = (item) => {

            // Возвращаем анимацию
            let headersAnimation = document.querySelectorAll(item);

            headersAnimation.forEach((headerAnimation) => {

                headerAnimation.classList.add('none');

                // Добавление класса
                const onEntry = (entry) => {
                    entry.forEach(change => {
                        if (change.isIntersecting) {
                            change.target.classList.add('element-show');
                        } else {
                            // change.target.classList.remove('element-show');
                        }
                    });
                }

                // Создание класса для отслкживания изменений
                let options = { threshold: [0.5] };
                let observer = new IntersectionObserver(onEntry, options);
                let elements = document.querySelectorAll('.element-animation');

                // Отслкживание изменений
                elements.forEach(elm => {
                    observer.observe(elm);
                });

            })
        }

        getList('.header-animation');
        getList('.text-animation');
        getList('.opacity-anim');
        getList('.opacity-items-anim');
        getList('.img-anim');

    }

}

const smoothScroll = () => {

    SmoothScroll({
        // Время скролла 400 = 0.4 секунды
        animationTime    : 800,
        // Размер шага в пикселях
        stepSize         : 75,

        // Дополнительные настройки:

        // Ускорение
        accelerationDelta : 30,
        // Максимальное ускорение
        accelerationMax   : 2,

        // Поддержка клавиатуры
        keyboardSupport   : true,
        // Шаг скролла стрелками на клавиатуре в пикселях
        arrowScroll       : 50,

        // Pulse (less tweakable)
        // ratio of "tail" to "acceleration"
        pulseAlgorithm   : true,
        pulseScale       : 4,
        pulseNormalize   : 1,

        // Поддержка тачпада
        touchpadSupport   : true,
    })

}

// Preloader

const preloader = () => {
    let preloader = document.getElementById('preloader');
    if(preloader) {
        let body = document.querySelector('body');
        body.classList.add('active');
        preloader.classList.add('active');
        window.addEventListener('load', () => {
            preloader.classList.remove('active');
            body.classList.remove('active');
        })
    }
}

// Плавный скролл до якоря

const anchorSmoothScroll = ($anchor) => {

    const parent = document.querySelectorAll($anchor);

    if(!parent) return false;

    const getElementHeight = (el) => {

        let value = document.querySelector(el).offsetHeight;

        return (!value) ? 0 : value

    }

    parent.forEach((link) => {

        link.addEventListener('click', function (e) {

            e.preventDefault();

            const href = this.getAttribute('href').substring(1);

            const scrollTarget = document.getElementById(href);

            const topOffset = getElementHeight('');

            const elementPosition = scrollTarget.getBoundingClientRect().top;

            const offsetPosition = elementPosition -  topOffset;

            window.scrollBy({
                top: offsetPosition,
                behavior: 'smooth',
            });

        });

    });

}

const preViewImage = (openItem, outputItem, fileItem) => {
    let open = document.querySelector(openItem);
    if(!open) return false;
    open.addEventListener('click', () => {
        let file = document.querySelector(fileItem);
        file.addEventListener('change', (event) => {
            let output = document.querySelector(outputItem);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.addEventListener('load', () => {
                URL.revokeObjectURL(output.src)
            })
        })
    })
}

const inputAdd = (addColumn, addInput, addColumnChild) => {

    const column = document.querySelector(addColumn);
    if(!column) return false;
    const input = column.querySelector(addInput);
    if(!input) return false;
    const addItemChildClass = column.querySelector(addColumnChild);
    if(!addItemChildClass) return false;

    if(!column || !input || !addItemChildClass) return false;

    let i = 0;

    const add = (column, addColumnChild) => {

        addColumnChild = addColumnChild.split('.').join('');

        // Генерируем элемент
        const element = document.createElement('div');
        element.classList = addColumnChild;
        element.innerHTML =
            `
                <input type="text" name="inputs[`+i+`][video_path]" class="add-course-form__input"
                       placeholder="Введите ссылку на видео">
                <button type="button" class="remove">Удалить</button>
            `
        ;
        column.appendChild(element);
    }

    input.addEventListener('click', () => {
        i++;
        add(column, addColumnChild);
    })

    document.addEventListener('DOMNodeInserted', () => {
        const items = column.querySelectorAll(addColumnChild);
        for (let item of items) {
            const removeInput = item.querySelector('.remove');
            if(!removeInput) {
                continue;
            }
            removeInput.addEventListener('click', () => {
                item.remove();
            })
        }
    })


}

// Надо писать turbo:load

document.addEventListener("turbo:load", function() {
    navAccount('.hover-open', '.ava-img');
    smoothScroll();
    numberAnimation('.admin-panel-content-info-item__title');
    telMask('.tel');
    burger();
    programCourse();
    // accordion('.accordion__list', '.accordion__item', '.accordion__button', '.accordion__content', '.add-course-form-img__img');
    optionPlaceholder('.add-course-form__select');
    preViewImage('.ava-img-label', '.ava-img', '.ava-input-file');
    dragAndDrop('.dragable-img', '.add-course-form-img-content-name__text', '.drag-img', '.add-course-form-img__img', '.add-course-form-img-content__svg', '.add-course-form-img-content__name');
    dragAndDropMulti('.dragable-img-multi', '.add-course-form-img-content-name__text', '.drag-img', '.add-course-form-img__img', '.add-course-form-img-content__svg', '.add-course-form-img-content__name', '.add-course-form-img-content__files', 'files');
    dragAndDropMulti('.dragable-img-multi-videos', '.add-course-form-img-content-name__text', '.drag-img', '.add-course-form-img__img', '.add-course-form-img-content__svg', '.add-course-form-img-content__name', '.add-course-form-img-content__files', 'videos');
    inputAdd('.add-video-column', '.add-video-paths', '.video__input-column');
    Livewire.onPageExpired((response, message) => {})
    modal('.guest-subscribe-course-modal-button', '.modal__close', '.guest-course-subscribe-modal')
    modal('.subscribe-course-error-modal-button', '.modal__close', '.course-subscribe-error-modal')
})

const init = () => {
    elAnim();
    preloader();
    anchorSmoothScroll('a.anchor');
}

document.addEventListener('DOMContentLoaded', init)
