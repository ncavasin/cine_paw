class App{

    constructor(){
        // Load functionality
        document.addEventListener('DOMContentLoaded', () => { 
            paw.loadScript('MainMenu', '/js/components/MainMenu.js', () => {
                let mainMenu = new MainMenu("nav");
            })
        });
    }

}

let app = new App();