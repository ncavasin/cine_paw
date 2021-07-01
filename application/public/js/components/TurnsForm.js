/* La siguiente clase tiene como finalidad resolver el punto 3 del TP4:

Se pide implementar en el formulario de turnos la funcionalidad que permita, al pedir una cita,
se pregunte con qué médico se solicita el turno y se arme un widget tipo agenda con los
turnos disponibles para ese profesional para la semana habilitada para el pedido de turnos.
Se debe contemplar que el sistema solo permite solicitar turnos durante los 7 días corridos a
partir de hoy. De tal manera que el usuario pueda elegir cual es de su conveniencia
simplemente haciendo un click sobre la casilla que representa el turno. Para poder generar
esta funcionalidad se contará con la información necesaria en un JSON con la siguiente estructura:
{
    "especialistas": [{
        "matricula": "string",
        "nombre": "string",
        "apellido": "string",
        "diasQueAtiende": ["string","string","string","string"],
        "horarioInicio": {
            "horas": number,
            "minutos": number
        },
        "horarioFinalizacion": {
            "horas": number,
            "minutos": number
        },
        "duracionTurno": number,
        "turnosTomados": [
            {
            "dia": "string",
            "horas": number,
            "minutos": number
            }, … , ….
    ]s
    }, {...}, {...}]
} */

document.addEventListener('DOMContentLoaded', () => {
	let turns = new TurnsForm('#form-turnos', '#especialidad', '#especialista')
})

class TurnsForm {
	// TODO agregar loader que indiquie que el formulario esta cargandose
	constructor(container, especialidad, especialista) {
		const urlBase = window.location.origin
		let css = paw.newElement('link', '', { rel: 'stylesheet', href: 'assets/css/form_turnos.css' })
		document.head.appendChild(css)
		let containerElement = document.querySelector(container)
		let especialidadElement = document.querySelector(especialidad)
		let especialistaElement = document.querySelector(especialista)
		if (especialidadElement && especialistaElement) {
			// crear el hidden input para guardar el horario seleccionado asi va en el post del formulario
			let hiddenDate = paw.newElement('input', '', {
				name: 'fecha',
				value: '',
				id: 'fecha',
				type: 'hidden',
				autocomplete: 'off'
			})
			let hiddenHour = paw.newElement('input', '', {
				name: 'hora',
				value: '',
				id: 'hora',
				type: 'hidden',
				autocomplete: 'off'
			})
			// verifico los 3 hidden inputs ya que el form no los puede validar al estar ocultos (pincha al hacer foco)
			// crear metodo para limpiar los hidden cuando sea necesario
			const cleanHiddenInputs = () => {
				hiddenDate.value = ''
				hiddenHour.value = ''
			}
			containerElement.appendChild(hiddenDate)
			containerElement.appendChild(hiddenHour)
			// crear boton para ver turnos disponibles
			let turnsButton = paw.newElement('input', '', {
				disabled: true,
				class: 'main_button',
				type: 'button',
				value: 'Turnos disponibles',
				id: 'get-turns-button'
			})
			// busco las especialidades y especialistas disponibles en la base de datos
			this.createDatalist(especialistaElement, urlBase + '/especialistas', {}, 'especialista-lista')
			this.createDatalist(especialidadElement, urlBase + '/especialidades', {}, 'especialidad-lista')
			// me subscribo al evento onchange de los input para cambiar las opciones, cuando el otro input cambia
			especialidadElement.addEventListener('change', e =>
				this.createDatalist(
					especialistaElement,
					urlBase + '/especialistas',
					{ especialidad: e.target.value },
					'especialista-lista'
				)
			)
			especialistaElement.addEventListener('change', e => {
				// Si cambia el input me fijo si tiene algun valor seleccionado, si es asi, habilito el boton para consultar turnos disponibles
				if (e.target.value) turnsButton.removeAttribute('disabled')
				else turnsButton.setAttribute('disabled', true)
			})

			// agregar onclick al boton para traer datos del especialista y los horarios que atiende
			turnsButton.addEventListener('click', e => {
				e.preventDefault()
				cleanHiddenInputs()
				FetchApi.get(urlBase + '/turnos_disponibles', { especialista: especialistaElement.value }, r => {
					let fieldsetElement = document.querySelector('#fieldset-cards')
					if (fieldsetElement) fieldsetElement.innerHTML = ''
					else
						fieldsetElement = paw.newElement('fieldset', '', {
							id: 'fieldset-cards'
						})
					// ! en la realidad no va a venir un arreglo, sino que va a ser un solo especialista con sus horarios por eso esta filtrado
					r.data.forEach(
						e =>
							e.nombre == 'Tekito'
								? fieldsetElement.appendChild(this.createTurnCard(e, hiddenDate, hiddenHour))
								: null
					)
					containerElement.appendChild(fieldsetElement)
					// me fijo si ya se creo el fieldset con los botones
					let fieldsetButtons = document.querySelector('#fieldset-buttons')
					if (fieldsetButtons) {
						// si no se creo lo creo y tambien creo / recupero los botones para agregar todo al dom
						let resetButton = document.querySelector('#reset')
						let submitButton = document.querySelector('#submit')
						if (!submitButton)
							submitButton = paw.newElement('input', 'Reservar', {
								id: 'submit',
								type: 'submit',
								form: 'form-turnos',
								name: 'submit',
								value: 'Reservar',
								class: 'main_button',
								disabled: true // disabled por defecto hasta que se llenen los campos necesarios para poder submitear
							})
                        submitButton.addEventListener('click', e => {
                            let input = document.querySelector('#orden_medica')
                            if (input.files.length !== 1) {
                                e.preventDefault()
                                alert('Por favor seleccione solo un archivo')
                            } else if (!input.files[0].name.endsWith('.pdf')) {
                                e.preventDefault()
                                alert('Solo se aceptan archivos .pdf')
                            }
                        })
						// me subscribo al boton de limpiar para limpiar tambien los hidden inputs (no se si lo hace automaticamente o no)
						resetButton.addEventListener('click', e => {
							turnsButton.setAttribute('disabled', true)
							submitButton.setAttribute('disabled', true)
							cleanHiddenInputs()
							fieldsetElement.innerHTML = ''
						})
						fieldsetButtons.appendChild(submitButton)
						containerElement.appendChild(fieldsetButtons)
					}
				})
			})
			// creo una funcion para el callback del change del drag n drop
			const onInputChange = target => {
				console.log(target.files)
				if (hiddenDate.value && hiddenHour.value && target.files.length) {
					const submitButton = document.querySelector('#submit')
					if (submitButton) submitButton.removeAttribute('disabled')
				}
			}
			// creo el drag and drop
			new DragAndDrop('label_orden', onInputChange)
			containerElement.appendChild(turnsButton)
		} else console.error('Error al generar formulario, elementos HTML no encontrados')
	}

	createDatalist = (parent, targetUrl, params, datalistId) => {
		FetchApi.get(targetUrl, params, r => {
			// creo el datalist de especialistas si no existe y lo linkeo
			let datalistElement = document.querySelector('#' + datalistId)
			if (
				!datalistElement // Si no existe lo creo
			)
				datalistElement = paw.newElement('datalist', '', { id: datalistId }) // Si existe elimino el contenido
			else datalistElement.innerHTML = ''
			// creo las opciones
			let isSelectedValid = false
			r.forEach(item => {
				let optionElement = paw.newElement('option', '', { value: item.nombre }) // ver como poner el id para hacer el get de items mas facil
				datalistElement.appendChild(optionElement)
				isSelectedValid = isSelectedValid || item.nombre === parent.value
			})
			// agrego el datalist al DOM
			parent.appendChild(datalistElement)
			if (!isSelectedValid) parent.value = ''
		})
	}

	createTurnCard = (especialista, hiddenDate, hiddenHour) => {
		const days = { Domingo: 0, Lunes: 1, Martes: 2, Miercoles: 3, Jueves: 4, Viernes: 5, sabado: 6 }
		let article = paw.newElement('article', '', {
			class: 'especialista-turnos'
		})
		article.appendChild(
			paw.newElement('h3', especialista.nombre + ' ' + especialista.apellido, { class: 'header-card' })
		)
		// genero los dias proximos en los que atiende y los agrego a una lista
		let ulFechas = paw.newElement('ul', '', { class: 'ul-fechas' })
		especialista.diasQueAtiende.forEach(dia => {
			let date = new Date()
			date.setDate(date.getDate() + (7 + days[dia] - date.getDay()) % 7) // ? CUIDADO !! si tiene mal el horario de la PC esto funcionara bien ??? validar en backend
			let m = new Intl.DateTimeFormat('es', { month: 'long' }).format(date)
			let d = new Intl.DateTimeFormat('es', { day: '2-digit' }).format(date)
			let li = paw.newElement('li', `${d} ${m}`, { id: date.getTime() }) // guardo del id para relacionar luego el id de la ul correspondiente de horarios

			// genero todos los horarios que estan disponibles y relaciono la ul a la fecha correspondiente mediante el id
			let ulHorarios = paw.newElement('ul', '', { class: 'closed', liId: date.getTime() })
			const ocupados = especialista.turnosTomados.filter(e => e.dia === date.toISOString().slice(0, 10)) // TODO filtrar por ocupados

			// genero todos los turnos disponibles
			let minutoOverflow = false
			for (let hora = especialista.horarioInicio.horas; hora < especialista.horarioFinalizacion.horas; hora++)
				// utilizar variable ultimaRonda para avisar al siguiente for que tenga en cuenta si el horario en que termina de atender no es en punto
				for (
					let minuto = minutoOverflow || especialista.horarioInicio.minutos;
					minuto < 60; // TODO ver si termina el horario en y 30 por ej
					minuto = minuto + especialista.duracionTurno
				) {
					let liHora = paw.newElement('li', `${hora}:${minuto > 9 ? minuto : `0${minuto}`}`)
					liHora.addEventListener('click', e => {
						// limpio los li que podrian estar seleccionados (deberia traer solo uno)
						const selecteds = document.querySelectorAll('.selected')
						selecteds.forEach(e => e.classList.remove('selected'))
						e.target.classList.add('selected') // agrego clase de seleccionado
						hiddenHour.value = e.target.innerText || e.target.textContent // guardo el valor del horario seleccionado
						// guardo el valor del dia seleccionado
						hiddenDate.value = date.getTime() // TODO ver como mandar formato final al backend cuando integremos con persistencia
						// ! si se cambia la forma en la que se guarda la fecha en el input se debe cambiar la forma en la que se genera el id del ulHorarios al mismo formato
						// me fijo si hay una orden medica cargada asi habilito el boton de submit
						let fileInput = document.querySelector('#orden_medica')
						if (fileInput.files.length) document.querySelector('#submit').removeAttribute('disabled')
					})
					ulHorarios.appendChild(liHora)
					//calcular minuto overflow por la duracion del turno para no emepzar siempre de 0
					if (minuto + especialista.duracionTurno > 60)
						minutoOverflow = minuto + especialista.duracionTurno - 60
				}
			// li.appendChild(ulHorarios)
			ulFechas.appendChild(li)
			let sublista = paw.newElement('li', ulHorarios, { class: 'sublista' })
			ulFechas.appendChild(ulHorarios)
			// agrego el evento click para mostar / ocultar horarios de una fecha
			li.addEventListener('click', e => {
				const horarios = document.querySelectorAll('ul.open')
				for (let i = 0; i < horarios.length; i++)
					if (horarios[i].getAttribute('liId') !== hiddenDate.value) {
						console.log(horarios[i].getAttribute('liId'))
						horarios[i].classList.add('closed')
						horarios[i].classList.remove('open')
					}
				ulHorarios.classList.remove('closed')
				ulHorarios.classList.add('open')
				let liOpened = document.querySelectorAll('li.open')
				if (liOpened)
					liOpened.forEach(item => {
						if (item.id !== hiddenDate.value) item.classList.remove('open')
					})
				e.target.classList.add('open')
			})
		})
		article.appendChild(ulFechas)
		return article
	}
}
