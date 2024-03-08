const sidebar = document.getElementById("sidebar");
const toggleButton = document.getElementById("toggleSidebar");
const closeButton = document.getElementById("closeSidebarMobile");
const openButton = document.getElementById("openSidebarMobile");

toggleButton.addEventListener("click", toggleSidebar);
closeButton.addEventListener("click", closeSidebarMobile);
openButton.addEventListener("click", openSidebarMobile);

let isOpen;
initSidebar();

//close sidebar in all screen sizes
function closeAll() {
    sidebar.classList.remove("w-full", "md:w-48");
    sidebar.classList.add("w-0");
}

//open sidebar in large screen size
function openLarge() {
    sidebar.classList.remove("w-full", "w-0");
    sidebar.classList.add("md:w-48");
}

//close sidebar with mobile button screen size
function closeSidebarMobile() {
    isOpen = true;
    localStorage.setItem("sidebarIsOpen", isOpen);
    closeAll();
}

//open sidebar with mobile button screen size
function openSidebarMobile() {
    isOpen = false;
    localStorage.setItem("sidebarIsOpen", isOpen);
    sidebar.classList.remove("w-0");
    sidebar.classList.add("w-full", "md:w-48");
}

//open and close sidebar
function toggleSidebar() {
    isOpen = !isOpen;
    localStorage.setItem("sidebarIsOpen", isOpen);
    if (isOpen) {
        sidebar.classList.remove("w-0");
        sidebar.classList.add("md:w-48");
    } else {
        closeAll();
    }
}

// Initialize sidebar state based on screen size
function initSidebar() {
    isOpen = localStorage.getItem("sidebarIsOpen") === "true";
    if (isOpen) {
        if (window.innerWidth <= 768) {
            closeAll();
        } else if (window.innerWidth <= 1024) {
            sidebar.classList.remove("w-full");
            sidebar.classList.add("md:w-48", "w-0");
        } else {
            openLarge();
        }
    } else {
        closeAll();
    }
    sidebar.classList.add("transition-all", "duration-300");
}

// update sidebar state based on screen size with resize event
function updateSidebar() {
    if (isOpen) {
        if (window.innerWidth <= 1024) {
            closeAll();
        } else {
            openLarge();
        }
    } else {
        closeAll();
    }
}
window.addEventListener("resize", updateSidebar);
