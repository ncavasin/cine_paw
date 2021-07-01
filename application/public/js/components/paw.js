class paw{

    static newElement(tag, content = '', attributes = {}, events = {}){
        let element = document.createElement(tag);

        // Load each attribute to the created element
        // e.g.: src = 'URL' class='className'
        for(const atr in attributes){
            element.setAttribute(atr, attributes[atr]);
        }
        
        // If content is NOT an HTML Element itself
        if (! content.tagName){
            // Create a textNode 
            content = document.createTextNode(content);
        }

        // Generic event listener
        for(var e in events){
            element.addEventListener(e, () => { eval(events[e]) });
        }
        
        element.appendChild(content);
        return element;
    }
    
    // Create and insert a script to DOM's head
    static loadScript(pName, url, callback = null){
        let script = document.querySelector('script#' + pName);

        if(! script){
            // Create a new script
            script = this.newElement('script', '', {name:pName, src: url});

            if(callback){
                // Add received callback as functionality AFTER dom's loaded
                script.addEventListener('load', callback);
            }
            
            // Insert script to dom's head
            document.head.appendChild(script);
        }
        return script;
    }
}