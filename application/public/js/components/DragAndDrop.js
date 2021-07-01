// After loading, initiate script and keep listening for window resize
/* document.addEventListener('DOMContentLoaded', (e) => {
    new DragAndDrop('label_orden');
});
 */
// Globals
let element
let parent
let legend
let fileInput

// Back to the roots
function undoAll() {
	try {
		if (element.classList.contains('drop_zone')) {
			element.classList.remove('drop_zone')
		}
	} catch (ex) {
		console.log(ex)
	}
}

function clean() {
	try {
		element.classList.remove('drag_enter')
		element.classList.remove('drag_leave')
		element.classList.remove('drop_container')
		element.classList.add('label_orden')
		element.classList.add('drop_zone')

		let ftc = document.querySelector('#files-text-container')
        ftc.innerHTML = ''
			
	} catch (ex) {
		console.log(ex)
	}
}

function handleResize() {
	// Add media query to be responsive
	const min_width = getComputedStyle(document.documentElement).getPropertyValue('--min-width')
	const mqIsDesktop = window.matchMedia('(min-width:' + min_width + ')')
	mqIsDesktop.addEventListener('change', e => {
		if (!e.matches) {
			console.log('DRAG_DROP::MOBILE')
			undoAll()
		}
	})
}

// Validate input is '.pdf' (backend really checks this later)
function handleFiles(files, callback) {
	let filesTextContainer = document.querySelector('#files-text-container')
	// Si no existe el contenedor, lo creo, si existe lo limpio
	if (filesTextContainer) filesTextContainer.innerHTML = ''
	else filesTextContainer = paw.newElement('div', '', { id: 'files-text-container' })
	// To validate extension
	let validExtension = /^[a-z0-9_()\-\[\]]+\.pdf$/i

	validExtension = '.pdf'

	for (var i = 0, len = files.length; i < len; i++) {
		let p = paw.newElement('p', files[i].name, { class: 'dropped_file' })
		filesTextContainer.appendChild(p)

		console.log('INPUTFILE', files[i]['name'])

		// Handle invalid extension
		// if(! validExtension.exec(files[i]['name'])){
		if (!files[i].name.endsWith(validExtension)) {
			alert('Solo se reciben archivos .pdf')
			clean()
			return
		}
	}
	element.appendChild(filesTextContainer)
	let inputFile = document.getElementById('orden_medica')
	inputFile.files = files
	callback(inputFile)
}

function handleDrop(e, callback) {
	let files = e.dataTransfer.files
	if (files.length !== 1) {
		element.classList.remove('drag_enter')
		element.classList.add('drag_leave')
		alert('Multiples archivos no estan permitidos')
	} else {
		try {
			element.classList.remove('drag_enter')
			element.classList.remove('drag_leave')
			element.classList.remove('label_orden')
			element.classList.add('drop_container')
		} catch (ex) {
			console.log(ex)
		}
		handleFiles(files, callback)
	}
}

class DragAndDrop {
	constructor(elementId, changeCallback) {
		// Load css
		let css = paw.newElement('link', '', {
			rel: 'stylesheet',
			href: 'assets/css/drag_drop.css'
		})
		document.head.appendChild(css)

		// Get the element
		element = document.getElementById(elementId)

		// Add all classes
		element.classList.add('drop_zone')
		element.classList.add('label_orden')


		// Get limpiar button
		let button = document.querySelector('input[type="reset"]')
		button.addEventListener('click', () => {
			try {
				clean()
			} catch (ex) {
				console.log(ex)
			}
		})

		// Add resize support
		handleResize()

		// Handle events
		element.addEventListener('dragenter', e => {
			e.preventDefault()
			try {
				element.classList.remove('drag_leave')
				element.classList.add('drag_enter')
			} catch (ex) {
				console.log(ex)
			}
			console.log('DRAGENTER')
		})
		element.addEventListener('dragleave', e => {
			e.preventDefault()
			try {
				element.classList.remove('drag_enter')
				element.classList.add('drag_leave')
			} catch (ex) {
				console.log(ex)
			}
			console.log('DRAGLEAVE')
		})
		element.addEventListener('dragover', e => {
			e.preventDefault()
			try {
				element.classList.remove('drag_leave')
				element.classList.add('drag_enter')
			} catch (ex) {
				console.log(ex)
			}
			console.log('DRAGOVER')
		})
		element.addEventListener('drop', e => {
			e.preventDefault()
			console.log('DROP')
			handleDrop(e, changeCallback)
		})

		const hiddenInput = document.querySelector('#orden_medica')
		if (hiddenInput) {
			hiddenInput.addEventListener('change', ({ target }) => {
				changeCallback(target)
				element.classList.remove('drag_enter')
				element.classList.remove('drag_leave')
				element.classList.remove('label_orden')
				element.classList.add('drop_container')
				handleFiles(target.files, changeCallback)
			})
		}
	}
}
