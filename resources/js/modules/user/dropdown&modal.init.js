export function initDropdowns() {
    const dropdownElems = document.querySelectorAll('.dropdown, .dropup, .dropstart, .dropend');

    function dropdownEvent(item) {
        const toggleBtn = item.querySelector(".dropdown-toggle");
        const dropdownMenu = item.querySelector(".dropdown-menu");

        if (!toggleBtn || !dropdownMenu) return;

        toggleBtn.addEventListener("click", (event) => {
            event.stopPropagation();

            // Закрываем все другие dropdown-меню перед открытием текущего
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                if (menu !== dropdownMenu) {
                    menu.classList.add("hidden");
                    menu.style.display = "none"; // Скрываем явно
                }
            });

            // Тогглим меню
            if (dropdownMenu.classList.contains("hidden")) {
                dropdownMenu.classList.remove("hidden");
                dropdownMenu.style.display = "block"; // Показываем
            } else {
                dropdownMenu.classList.add("hidden");
                dropdownMenu.style.display = "none"; // Скрываем
            }
        });
    }

    dropdownElems.forEach(dropdownEvent);

    // Закрытие при клике вне dropdown
    document.addEventListener("click", () => {
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            menu.classList.add("hidden");
            menu.style.display = "none";
        });
    });
}
export function initModals() {
    let isModalShow = false;

    document.querySelectorAll('[data-tw-toggle="modal"]').forEach((item) => {
        item.addEventListener("click", function () {
            const target = this.getAttribute('data-tw-target').substr(1);
            const modalWindow = document.getElementById(target);

            if (modalWindow.classList.contains("hidden")) {
                modalWindow.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                modalWindow.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
            isModalShow = item.getAttribute('data-tw-backdrop') === 'static';
        });
    });

    document.querySelectorAll('[data-tw-dismiss="modal"]').forEach((subElem) => {
        subElem.addEventListener("click", function () {
            const modalWindow = subElem.closest(".modal");
            modalWindow.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });

    document.querySelectorAll('.modal').forEach((elem) => {
        elem.querySelectorAll('.modal-overlay').forEach((subItem) => {
            subItem.addEventListener("click", function () {
                if (!isModalShow) {
                    elem.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });

        document.addEventListener("keydown", function (event) {
            if (!isModalShow && event.key === "Escape") {
                elem.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    });
}
