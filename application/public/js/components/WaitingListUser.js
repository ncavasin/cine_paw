document.addEventListener('DOMContentLoaded', () => {
	let wlu = new WaitingListUser()
})

// Variables para emular
let hora = 9
let minuto = 0
let duracionTurno = 20
let miHora = 9
let miMinuto = 40
// funcion para emular fetch al backend
const fakeFetch = (url, params, callBack) => {
	const esMiTurno = miHora === hora && miMinuto === minuto
	const estimado = (miHora - hora) * 60 + (miMinuto - minuto)
	const response = {
		data: {
			actual: { esMiTurno, hora, minuto },
			miTurno: { hora: miHora, minuto: miMinuto },
			estimado: { hora: Math.trunc(estimado / 60), minuto: estimado % 60 }
		}
	}
	console.log(response.data)
	minuto = minuto + duracionTurno
	if (minuto >= 60) {
		hora = hora + 1
		minuto = minuto - 60
	}
	callBack(response)
}

class WaitingListUser {
	intervalId = -1

	constructor() {
		// Crear titulo
		let mainTitle = document.querySelector('main h2')
		mainTitle.textContent = 'Lista de espera'
		let main = document.querySelector('main')
        let permissionButton = paw.newElement('button', 'Habilitar alarma', {class: 'main_button'})
        permissionButton.addEventListener('click', _ => { permissionButton.setAttribute('disabled', true)})
		main.appendChild(permissionButton)
		let turnsSection = paw.newElement('section', '', { class: 'turnos' })
		main.appendChild(turnsSection)
		// Consulto por primera vez
		this.consultarListaDeEspera(turnsSection)
		// Crear intervalo que consulte cada 10 segundos el estado
		this.intervalId = setInterval(() => this.consultarListaDeEspera(turnsSection), 10000)
	}

	cancelarTurno = parent => {
        clearInterval(this.intervalId)
		parent.innerHTML = ''
        // En este punto deberia enviar al backend que no asistio al turno y esperar 200 ok
		parent.appendChild(paw.newElement('p', 'Turno cancelado', { class: 'turno-cancelado' }))
	}
    
    aceptarTurno = parent => {
        clearInterval(this.intervalId)
        parent.innerHTML = ''
        // En este punto deberia enviar al backend que se acepto el turno y esperar 200 ok
        parent.appendChild(paw.newElement('p', 'Turno confirmado, por favor golpee antes de entrar', {class: 'turno-aceptado'}))
    }
    
    noAsistio = parent => {
        clearInterval(this.intervalId)
        parent.innerHTML = ''
        // En este punto deberia enviar al backend que no asistio y esperar 200 ok
        parent.appendChild(paw.newElement('p', 'No asististe al turno', {class: 'turno-cancelado'}))

    }

	miTurno = (data, parent) => {
		// Limpio el contenedor
		parent.innerHTML = ''
        let permissionButton = document.querySelector('main>button')
        permissionButton.setAttribute('disabled', true)
        // Creo la alarma
        const audio = paw.newElement('audio', '', {id: "turn-alert", src: "/sounds/turn-alert.mp3", preload: "auto", autoplay: true})
        parent.appendChild(audio)
		let miTurno = paw.newElement('article', '', { class: 'tarjeta-turno confirmar' })
		miTurno.appendChild(paw.newElement('h2', `¡Llegó tu turno!`))
        miTurno.appendChild(paw.newElement('p', 'Usted tiene 2 minutos para confimar asistencia, de lo contrario se tomará que no asistió automaticamente'))
		let cancelButton = paw.newElement('button', 'Cancelar', { class: 'main_button cancel-button' })
		cancelButton.addEventListener('click', _ => this.cancelarTurno(parent))
		let acceptButton = paw.newElement('button', 'Aceptar', { class: 'main_button accept-button' })
		acceptButton.addEventListener('click', _ => this.aceptarTurno(parent))
		miTurno.appendChild(cancelButton)
		miTurno.appendChild(acceptButton)
		parent.appendChild(miTurno)
		clearInterval(this.intervalId)
        // 30 segundos a modo de muestra pero deberian ser 2 minutos, tambien deberia haber un contador que muestre tiempo restante
        this.intervalId = setTimeout(()=>this.noAsistio(parent), 120000) 
        // Hago sonal la alarma
        audio.play()
        navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
        if (navigator.vibrate) navigator.vibrate([500, 200, 500, 200, 500])
	}

	esperar = (data, parent) => {
		// Limpio  el contenedor
		parent.innerHTML = ''
		// Crear turno actual que esta siendo atendido
		let turnoActual = paw.newElement('article', '', { class: 'tarjeta-turno' })
		turnoActual.appendChild(paw.newElement('h3', 'Turno actual'))
		turnoActual.appendChild(
			paw.newElement(
				'p',
				`${data.actual.hora < 10 ? '0' + data.actual.hora : data.actual.hora}:${data.actual.minuto < 10
					? '0' + data.actual.minuto
					: data.actual.minuto}`
			)
		)
		parent.appendChild(turnoActual)
		// Crear mi turno
		let miTurno = paw.newElement('article', '', { class: 'tarjeta-turno' })
		miTurno.appendChild(paw.newElement('h3', 'Mi turno'))
		miTurno.appendChild(
			paw.newElement(
				'p',
				`${data.miTurno.hora < 10 ? '0' + data.miTurno.hora : data.miTurno.hora}:${data.miTurno.minuto < 10
					? '0' + data.miTurno.minuto
					: data.miTurno.minuto}`
			)
		)
		parent.appendChild(miTurno)
		// Crear texto de tiempo estimado
		parent.appendChild(
			paw.newElement(
				'p',
				`La espera estimada es de ${data.estimado.hora < 10
					? '0' + data.estimado.hora
					: data.estimado.hora}:${data.estimado.minuto < 10
					? '0' + data.estimado.minuto
					: data.estimado.minuto} hs`,
                {class: 'estimado'}
			)
		)
	}

	consultarListaDeEspera = parent => {
		fakeFetch('fakeUrl', { fake: 'param' }, r => {
			if (r.data.actual.esMiTurno) this.miTurno(r.data, parent)
			else this.esperar(r.data, parent)
		})
	}
}
