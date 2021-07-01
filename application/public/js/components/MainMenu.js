// After loading, keep listening for window resize 
document.addEventListener('DOMContentLoaded', (e) => {
    
    // Add media query to be responsive
    let min_width = getComputedStyle(document.documentElement).getPropertyValue(
        "--min-width"
    );
    // const mqIsDesktop = window.matchMedia('(min-width:'+min_width-1+')');
    
});

class MainMenu {

    constructor(pContainer) {

        // Find received element
        let container = pContainer.tagName ? pContainer : document.querySelector(pContainer);

        // Create burguer button
        let button = paw.newElement(
            "button",
            "☰",
            { class: 'hamburguesa'}
        );
        
        let ul = document.querySelector("nav ul");

        // Add functionality
        button.addEventListener("click", (event) => {
            if (ul.classList.contains('main_menu')){
                ul.classList.add('main_menu_cerrado');
                ul.classList.remove('main_menu');
            }else{
                ul.classList.add('main_menu');
                ul.classList.remove('main_menu_cerrado');
            }
        });

        const mqIsDesktop = window.matchMedia('(min-width: 481px)');
        mqIsDesktop.addEventListener("change", (e) => {
            if (e.matches) {
                ul.classList.add('main_menu');
                ul.classList.remove('main_menu_cerrado');
            }
            else{
                console.log('MAINMENU::MOBILE');
                // undoAll();
            }
        });

        // Append to father
        container.appendChild(button);
    }
}

