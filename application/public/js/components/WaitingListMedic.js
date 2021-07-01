document.addEventListener('DOMContentLoaded', () => {
	let wlm = new WaitingListMedic()
})

// Variables para emular

// funcion para emular fetch al backend
const fakeFetch = (url, params, callBack) => {
	const response = {
		data: [
			{
				nombre: 'Paciente',
				apellido: 'Uno',
				fecha: '2021-06-21',
				hora: 9,
				minuto: 20
			},
			{
				nombre: 'Paciente',
				apellido: 'Dos',
				fecha: '2021-06-21',
				hora: 9,
				minuto: 40
			},
			{
				nombre: 'Paciente',
				apellido: 'Tres',
				fecha: '2021-06-21',
				hora: 10,
				minuto: 0
			},
			{
				nombre: 'Paciente',
				apellido: 'Cuatro',
				fecha: '2021-06-21',
				hora: 10,
				minuto: 20
			}
		]
	}
	callBack(response)
}

class WaitingListMedic {
	// Guardo la data del fetch para despues usarla en el boton de siguiente
	data = []

	constructor() {
		// Crear titulo
		let mainTitle = document.querySelector('main h2')
		mainTitle.textContent = 'Turno actual'
		mainTitle.classList.add('turno-actual-title')
		let main = document.querySelector('main')
		main.appendChild(paw.newElement('h2', 'Lista de pacientes', { class: 'title-order' }))
		let turnsSection = paw.newElement('section', '', { class: 'turnos' })
		let siguienteButton = paw.newElement('button', 'Siguiente turno', {
			class: 'main_button siguiente-button'
		})
		siguienteButton.addEventListener('click', _ => {
			this.siguiente(turnsSection)
		})
		main.appendChild(siguienteButton)

		main.appendChild(turnsSection)
		// Consulto por primera vez
		this.consultarListaDeEspera(turnsSection)
		// Crear intervalo que consulte cada 10 segundos el estado
	}

	siguiente = dataParent => {
		const turno = this.data[0]
		if (!turno) return 0 // Corto la ejecucion si no hay turno siguiente (esto no deberia pasar por el disabled)
		let card = document.querySelector('.turno-actual')
		let parent = document.querySelector('main')
		if (!card) card = paw.newElement('article', '', { class: 'tarjeta-turno turno-actual actual' })
		else card.innerHTML = ''
		card.appendChild(paw.newElement('h3', `Esperando confirmación del paciente`, { class: 'turno-pendiente' }))
		card.appendChild(paw.newElement('p', `${turno.nombre} ${turno.apellido}`))
		card.appendChild(
			paw.newElement(
				'p',
				`Turno: ${turno.hora > 9 ? turno.hora : '0' + turno.hora}:${turno.minuto > 9
					? turno.minuto
					: '0' + turno.minuto} hs`
			)
		)
		parent.appendChild(card)
		// Para poder enterarme que el paciente aceptó el turno tendria que conectarme por websocket al backend y esperar que me avise
		// La siguiente funcion EMULA el funcionamiento del websocket y la respuesta
		setTimeout(data => {
			let pendienteText = document.querySelector('.turno-pendiente')
			if (true || data.confirmado) {
				// Simulo que este parametro viene en true
				pendienteText.classList.remove('turno-pendiente')
				pendienteText.classList.add('turno-aceptado')
				pendienteText.textContent = 'Turno aceptado'
			} else if (data.cancelado) pendienteText.textContent = 'Turno cancelado por el paciente'
			else if (data.noAsistio) pendienteText.textContent = 'El paciente no asistió'
		}, 15000)
        this.data.shift() // Elimino el turno que ahora pasa a ser el actual
        this.renderData(dataParent)
	}

	renderData = parent => {
		parent.innerHTML = ''
        let siguienteButton = document.querySelector('.siguiente-button')
        if (!this.data.length) {
            parent.appendChild(paw.newElement('p', 'No hay turnos por el momento'))
            siguienteButton.setAttribute('disabled', true)
        } else siguienteButton.removeAttribute('disabled')
		this.data.forEach(turno => {
			let card = paw.newElement('article', '', { class: 'tarjeta-turno turno-siguiente' })
			card.appendChild(paw.newElement('h3', `${turno.nombre} ${turno.apellido}`))
			card.appendChild(
				paw.newElement(
					'p',
					`Turno: ${turno.hora > 9 ? turno.hora : '0' + turno.hora}:${turno.minuto > 9
						? turno.minuto
						: '0' + turno.minuto} hs`
				)
			)
			parent.appendChild(card)
		})
	}

	consultarListaDeEspera = parent => {
		fakeFetch('fakeUrl', { fake: 'param' }, r => {
			this.data = r.data
			this.renderData(parent)
		})
	}
}
