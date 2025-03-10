/********************* Menu Js **********************/

//  Window scroll sticky class add
function windowScroll() {

    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    if (
        document.body.scrollTop >= 50 ||
        document.documentElement.scrollTop >= 50
    ) {
        navbar.classList.add("shadow", "nav-sticky");
    } else {
        navbar.classList.remove("shadow", "nav-sticky");
    }
}

function handleScrollEvent(ev) {
    ev.preventDefault();
    windowScroll();
}

//menu active & scrollspy
function handleScrollSpy() {
    var sections = document.querySelectorAll('.section');
    var scrollPos = document.documentElement.scrollTop || document.body.scrollTop;

    sections.forEach(section => {
        if ((section.offsetTop - 105) <= scrollPos) {
            var id = section.id;
            if (id) {
                let activeElement = document.querySelector('#navbar .navbar-nav .active');
                console.log(activeElement, 55555555555)
                if (activeElement) activeElement.classList.remove('active');

                let newActive = document.querySelector(`#navbar .navbar-nav .nav-link[href*='${id}']`);
                if (newActive) newActive.parentNode.classList.add('active');
            }
        }
    });
}

function initActiveMenu() {
    var navigationMenu = document.getElementById("navigation-menu");
    if (!navigationMenu) return;

    var currentPath = location.pathname === "/" ? "index.html" : location.pathname.substring(1);
    currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
    // console.log(currentPath, 44444)
    if (currentPath) {
        var a = navigationMenu.querySelector(`li a[href='${currentPath}']`);
        if (a) {
            a.classList.add("active");
            var parentCollapseDiv = a.closest(".dropdown-menu");
            if (parentCollapseDiv) {
                var parentElement = parentCollapseDiv.parentElement;
                if (parentElement && parentElement.classList.contains('dropdown')) {
                    parentElement.children[0].classList.add("active");
                }
            }
        }
    }
}

// navbar toggler
function initNavbarToggler() {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const toggler = navbar.querySelector(".navbar-toggler");
    if (!toggler) return;

    toggler.addEventListener("click", function () {
        var getAttr = this.getAttribute("data-collapse-toggle");
        var targetElement = document.getElementById(getAttr);
        if (targetElement) {
            targetElement.classList.toggle("hidden");
        }
    });
}

function handleResizeEvent() {
    const collapseMenu = document.getElementById('navbar-collapse');
    if (collapseMenu) {
        collapseMenu.classList.add("hidden");
    }
}

// Инициализация всех функций
function initNavbar() {
    window.addEventListener('scroll', handleScrollEvent);
    window.addEventListener('scroll', handleScrollSpy);
    window.addEventListener('resize', handleResizeEvent);


    initActiveMenu();
    initNavbarToggler();
}

export { initNavbar };
