let searchIcon = document.querySelector(".search-icon-flex");
let searchForm = document.querySelector(".search-form");
let svg1 =
    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.333 12.667A5.333 5.333 0 1 0 7.333 2a5.333 5.333 0 0 0 0 10.667ZM14 14l-2.9-2.9" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>';

let svg2 =
    '<svg fill="#000" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>';
let isSvg1 = true;
if (searchIcon) {
    // Check if searchIcon exists before adding event listener
    searchIcon.addEventListener("click", function () {
        searchIcon.innerHTML = isSvg1 ? svg2 : svg1;
        isSvg1 = !isSvg1;
        if (searchForm) {
            // Check if searchForm exists before toggling class
            searchForm.classList.toggle("search-bar-show");
        }
    });
}
window.addEventListener("scroll", function () {
    const tableOfContents = document.querySelector(".tableofcontent");
    if (tableOfContents) {
        if (window.scrollY > 800) {
            tableOfContents.style.display = "block";
        } else {
            tableOfContents.style.display = "none";
        }
    }
});
// Ensure header is defined correctly
const headers = document.querySelector("header");

if (headers) {
    function handleScroll() {
        if (window.scrollY > 80) {
            headers.classList.add("sticky-top");
        } else {
            headers.classList.remove("sticky-top");
        }
    }
}

// Add an event listener to the window object to call handleScroll on scroll
window.addEventListener("scroll", handleScroll);

function closePopHeadOnClickOutside(event) {
    if (!pophead.contains(event.target) && event.target !== popup) {
        pophead.classList.remove("open");
        mainContent.classList.remove("overlay"); // Remove overlay class from main content
        bodyOverlay.remove();
        document.removeEventListener("click", closePopHeadOnClickOutside);
    }
}
function toggleButtons() {
    const toggleBtn = document.querySelector(".toggle-slide-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    const headerUl = document.querySelector("nav ul");
    if (toggleBtn && cancelBtn && headerUl) {
        // Check if elements exist before performing actions
        headerUl.classList.toggle("show-ul");
        toggleBtn.style.display = toggleBtn.style.display === "none" ? "flex" : "none";
        cancelBtn.style.display = cancelBtn.style.display === "flex" ? "none" : "flex";
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const tocHeader = document.querySelector(".toc-header");
    const tableOfContent = document.querySelector(".tableofcontent");
    const arrow = document.querySelector(".arrow");

    if (tocHeader) {
        tocHeader.addEventListener("click", function () {
            tableOfContent.classList.toggle("hidden");
            if (tableOfContent.classList.contains("hidden")) {
                arrow.style.transform = "rotate(180deg)";
            } else {
                arrow.style.transform = "rotate(0deg)";
            }
        });
    }
});
const dropdowns = document.querySelectorAll(".dropdown");

function toggleDropdown(e) {
    const svgicon = e.target;
    const parentOfTarget = svgicon.parentNode; // li
    dropdowns.forEach((dropdown) => {
        if (dropdown !== parentOfTarget && !dropdown.contains(parentOfTarget)) {
            dropdown.classList.remove("show-dropdown");
        }
    });
    if (parentOfTarget) {
        parentOfTarget.classList.toggle("show-dropdown");
    }
}
dropdowns.forEach((dropdown) => {
    const svg = dropdown.querySelector("svg");
    if (svg) {
        // Check if svg exists before adding event listener
        svg.addEventListener("click", toggleDropdown);
    }
});
// Add a click event listener to the document to close dropdowns when clicking outside
document.addEventListener("click", (e) => {
    if (![...dropdowns].some((dropdown) => dropdown.contains(e.target))) {
        dropdowns.forEach((dropdown) => {
            dropdown.classList.remove("show-dropdown");
        });
    }
});
const detailsElements = document.querySelectorAll("details");
const summaryElements = document.querySelectorAll("summary");

summaryElements.forEach((summary, index) => {
    summary.addEventListener("click", () => {
        // Close other open details elements and remove 'active' class
        detailsElements.forEach((details, i) => {
            if (i !== index) {
                details.removeAttribute("open");
                details.classList.remove("active");
            }
        });

        // Toggle 'active' class on the corresponding details element
        const correspondingDetails = detailsElements[index];
        if (correspondingDetails.hasAttribute("open")) {
            correspondingDetails.classList.remove("active");
        } else {
            correspondingDetails.classList.add("active");
        }
    });
});

let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    let progressValue = document.getElementById("progress-value");
    let pos = document.documentElement.scrollTop;
    let calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let scrollValue = Math.round((pos * 100) / calcHeight);
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }
    scrollProgress.addEventListener("click", () => {
        document.documentElement.scrollTop = 0;
    });
    scrollProgress.style.background = `conic-gradient(#ff7800 ${scrollValue}%, #c7c7c7 ${scrollValue}%)`;
};
window.onscroll = calcScrollValue;
window.onload = calcScrollValue;
const tableOfContentItems = document.querySelectorAll(".tableofcontent ul li a");
tableOfContentItems.forEach((link) => {
    link.addEventListener("click", scrollToSection);
});
document.addEventListener("DOMContentLoaded", function () {
    // Initially hide all tab contents except for the "All" category
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        if (tabcontent[i].id !== "All") {
            tabcontent[i].style.display = "none";
        }
    }
});

function openCity(evt, jobs) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Hide all tab content
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("actives"); // Remove "active" class from all buttons
        tablinks[i].style.backgroundColor = ""; // Reset background color
        tablinks[i].style.color = ""; // Reset text color
    }
    document.getElementById(jobs).style.display = "block"; // Display the selected tab content
    evt.currentTarget.classList.add("actives"); // Add "active" class to the clicked button
}

function scrollToSection(event) {
    event.preventDefault();
    const targetId = this.getAttribute("href").substring(1);
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
        const offset = targetElement.offsetTop - 100;
        const top = offset > 0 ? offset : 0;
        window.scrollTo({
            top: top,
            behavior: "smooth",
        });
    }
}
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            const targetId = entry.target.getAttribute("id");
            const link = document.querySelector(`.tableofcontent ul li a[href="#${targetId}"]`);
            if (entry.isIntersecting) {
                link?.parentElement.classList.add("active-li");
            } else {
                link?.parentElement.classList.remove("active-li");
            }
        });
    },
    {
        threshold: 0.5,
    }
);
document.querySelectorAll("h2, h3, h4, h5, h6").forEach((element) => {
    observer.observe(element);
});

// Copy to Clipboad
const copyBtns = document.querySelectorAll(".copyboard");

if (copyBtns) {
    copyBtns.forEach((copyBtn) => {
        copyBtn.addEventListener("click", function () {
            const copyTexts = copyBtn.parentNode.querySelectorAll(".copy-text");

            if (copyTexts.length > 0) {
                let combinedText = "";
                copyTexts.forEach((copyText) => {
                    combinedText += copyText.innerHTML + "\n";
                });

                navigator.clipboard
                    .writeText(combinedText.trim())
                    copyBtn.classList.add("active");

                // Remove the active class after a delay
                setTimeout(function () {
                    copyBtn.classList.remove("active");
                }, 1000);
            }
        });
    });
}
