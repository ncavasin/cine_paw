document.addEventListener('DOMContentLoaded', () => {
    paw.loadScript('MainMenu', '/js/components/FetchApi.js', () => {
        const selSeat = new SelSeat()
    })
})

class SelSeat {
    loading = true
    ticketsCount = 0
    occuped = []
    selected = []
    targetCountDown = new Date(new Date().getTime() + 5*60000) // dentro de 5 minutos
    intervalId = -1

    constructor() {
        const mainElm = document.querySelector('main')
        const loader = paw.newElement('div', '', {class: 'loader-container'})
        loader.appendChild(paw.newElement('div', '', {class: 'loader'}))
        mainElm.appendChild(loader)
        this.subscribeSeatClick()
        FetchApi.get(window.location.origin+'/room_info', {}, r => {
            this.locateOccuped(r.occuped)
            this.locateTickets(r.ticketsCount)
            const tContainer = document.querySelector('.tickets-container')
            const contButton = paw.newElement('button', 'Continuar', {class: 'main_button'})
            contButton.addEventListener('click', _ => {
                FetchApi.post(window.location.origin+'/set_seats', {selected: this.selected}, r => {
                   if (r.status >= 200 && r.status < 300) window.location.href = window.location.origin + '/confirm_payment'
                })
            })
            tContainer.appendChild(contButton)
            mainElm.removeChild(loader) // no se ve, revisar estilo
        })
        // creo la cuenta regresiva
        this.intervalId = setInterval(this.updateCountdown, 1000)
    }
    
    updateCountdown = () => {
        const now = new Date()
        const count = this.targetCountDown - now
        const s = Math.floor((count % 60000) / 1000)
        const m = Math.floor((count % (60000*60)) / 60000)
        const cron = document.querySelector('.cron')
        if (!cron) {
            const container = document.querySelector('.cron-container')
            container.appendChild(paw.newElement('p', `${m}:${s < 10? '0'+s : s}`, {class: 'cron'}))
        } else cron.textContent = `${m}:${s < 10? '0'+s : s}`
        if (s <= 0 && m <= 0){
            clearInterval(this.intervalId)
            const content = document.querySelector('main > section')
            const main = document.querySelector('main')
            main.removeChild(content)
            main.appendChild(paw.newElement('p', 'Tiempo limite excedido'))
            main.appendChild(paw.newElement('a', 'Inicio', {class: 'home-link', href: '/',}))
        }
    }

    onSeatClick = seat => {
        if (!seat.classList.contains('occuped')){
            var deletedSeat = this.selected.shift()
            deletedSeat = document.querySelector(`#${deletedSeat}`)
            deletedSeat.classList.remove('selected')
            this.selected.push(seat.id)
            seat.classList.add('selected')
        }
    }

    subscribeSeatClick = () => {
        document.querySelectorAll('.butaca').forEach(e => {
            e.addEventListener('click', e => this.onSeatClick(e.target))
        })
    }

    locateOccuped = occuped => {
        this.occuped = occuped
        occuped.forEach(seatId => {
            const seat = document.querySelector(`#${seatId}`)
            seat.classList.add('occuped')
        })
    }

    locateTickets = ticketsCount => {
        this.ticketsCount = ticketsCount
        let assigned = 0
        const seatList = document.querySelectorAll('.butaca')
        /* seatList = seatList.sort((a,b) => {
            if (a.id > b.id) return 1
            else return -1
        }) */
        console.log(seatList)
        for (var i = 0; i < seatList.length && assigned < ticketsCount; i++) {
            if (this.occuped.indexOf(seatList[i].id) === -1) { // Si este asiento no esta en la lista de ocupados entonces.. 
                assigned++
                seatList[i].classList.add('selected')
                this.selected.push(seatList[i].id)
            }
        }
    }
}