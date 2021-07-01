// Add media query to be responsive
let min_width = getComputedStyle(document.documentElement).getPropertyValue(
    "--min-width"
);
const mqIsDesktop = window.matchMedia("(max-width: 479px)");

mqIsDesktop.addEventListener("change", (e) => {
    if (e.matches) {
        console.log("SUBMENU::MOBILE");
        ul.classList.remove("main_menu_abierto");
        ul.classList.remove("main_menu_cerrado");
    }
});

// Global var
let ul;

class SubMenu {
    constructor(pContainer) {
        // Find second element of "nav ul li"
        let container = document.querySelectorAll(pContainer).item(1);

        // Create drop-down button
        let button = paw.newElement("button", "▼");
        button.classList.add("btn");

        // Create sub-menu list and items
        ul = paw.newElement("ul", "");
        let li = paw.newElement("li", "");

        // Append fake anchors
        for (var i = 0; i < 4; i++) {
            let a = paw.newElement("a", "Servicio #" + (i + 1), {
                href: "#",
                target: "_self",
            });
            a.classList.add("sub_menu_list_item");
            li.appendChild(a);
        }

        // Connect them
        ul.appendChild(li);
        ul.classList.add("sub_menu_list");
        container.appendChild(ul);
        container.appendChild(button);

        // Css is loaded dynamically in the main menu
        container.classList.add("sub_menu_head");

        // Handle events
        button.addEventListener("click", () => {
            if (ul.style.display === "inherit") {
                ul.style.display = "none";
                button.innerHTML = "▼";
            } else {
                ul.style.display = "inherit";
                button.innerHTML = "▲";
            }
        });
    }
}
